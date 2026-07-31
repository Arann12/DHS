<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NewsArticle;
use App\Models\ProgramCategory;
use App\Models\Program;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Partner;
use App\Models\Statistic;
use App\Models\HomepageSection;
use App\Models\BrandingSetting;
use App\Models\FooterSetting;
use App\Models\NavigationMenu;
use App\Models\Registration;
use App\Models\Admission;
use App\Models\AboutPage;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BackofficeController extends Controller
{
    /* ── Guard: redirect if not logged in ─────────────────── */
    private function guard()
    {
        if (!session('backoffice_user')) {
            return redirect('/backoffice');
        }
    }

    private function logActivity(string $action, string $table = null, int $recordId = null, array $old = null, array $new = null)
    {
        $u = session('backoffice_user');
        ActivityLog::create([
            'user_id'    => $u ? $u['id'] : null,
            'action'     => $action,
            'table_name' => $table,
            'record_id'  => $recordId,
            'old_data'   => $old,
            'new_data'   => $new,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }

    private function deleteOldFile(string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }

    private function moveUploadedFile($file, string $dir, string $name): void
    {
        $dest = public_path($dir);
        if (!is_dir($dest)) {
            \Illuminate\Support\Facades\File::makeDirectory($dest, 0755, true);
        }
        $file->move($dest, $name);
    }

    /* ═══════════════════ DASHBOARD ═══════════════════════════ */
    public function dashboard()
    {
        if ($redirect = $this->guard()) return $redirect;
        
        $stats = [
            'berita'     => NewsArticle::count(),
            'program'    => Program::count(),
            'testimoni'  => Testimonial::count(),
            'users'      => User::count(),
            'pendaftar'  => Registration::count(),
            'partner'    => Partner::count(),
        ];
        $recentBerita = NewsArticle::orderBy('created_at', 'desc')->take(5)->get();
        $recentPendaftar = Registration::orderBy('created_at', 'desc')->take(5)->get();
        $activities = ActivityLog::with('user')->orderBy('created_at', 'desc')->take(10)->get();

        return view('backoffice.dashboard', compact('stats', 'recentBerita', 'recentPendaftar', 'activities'));
    }

    /* ═══════════════════ BERANDA CMS ══════════════════════════ */
    public function beranda()
    {
        if ($redirect = $this->guard()) return $redirect;
        
        $sections = HomepageSection::orderBy('display_order')->get()->keyBy('section_key');
        $stats = \App\Models\Statistic::orderBy('display_order')->get();
        return view('backoffice.beranda', ['user' => session('backoffice_user'), 'sections' => $sections, 'stats' => $stats]);
    }

    public function berandaUpdate(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;

        $request->validate(['sections' => 'required|array']);
        foreach ($request->input('sections', []) as $key => $data) {
            $section = HomepageSection::where('section_key', $key)->first();
            
            $contentData = $data['content'] ?? [];
            foreach ($contentData as $ck => $cv) {
                if (is_string($cv) && (str_starts_with($cv, '[') || str_starts_with($cv, '{'))) {
                    $decoded = json_decode($cv, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $contentData[$ck] = $decoded;
                    }
                }
            }

            if ($section) {
                $old = $section->toArray();
                $existingContent = is_array($section->section_content)
                    ? $section->section_content
                    : json_decode($section->section_content ?? '[]', true);
                $newContent = array_replace_recursive($existingContent ?: [], $contentData);

                $section->update([
                    'section_title'   => $data['title'] ?? $section->section_title,
                    'section_content' => $newContent,
                    'is_active'       => 1,
                ]);
                $this->logActivity('update', 'homepage_sections', $section->id, $old, $section->fresh()->toArray());
            } else {
                $newSection = HomepageSection::create([
                    'section_key'     => $key,
                    'section_title'   => $data['title'] ?? ucfirst($key),
                    'section_content' => $contentData,
                    'display_order'   => 10,
                    'is_active'       => 1,
                ]);
                $this->logActivity('create', 'homepage_sections', $newSection->id, null, $newSection->toArray());
            }
        }
        return response()->json(['success' => true, 'message' => 'Konten beranda berhasil diperbarui.']);
    }

    /* ═══════════════════ BRANDING ═════════════════════════════ */
    public function branding()
    {
        if ($redirect = $this->guard()) return $redirect;
        $settings = BrandingSetting::all()->keyBy('setting_key');
        return view('backoffice.branding', ['user' => session('backoffice_user'), 'settings' => $settings]);
    }

    public function brandingUpdate(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        
        // Validate file uploads if present
        $request->validate([
            'logo_primary' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'logo_favicon' => 'nullable|file|mimes:png,jpg,jpeg,svg,ico|max:2048',
        ]);
        
        // Update all settings (colors, fonts, etc) using updateOrCreate for safety
        foreach ($request->input('settings', []) as $key => $value) {
            if (!is_string($key)) continue;
            BrandingSetting::updateOrCreate(
                ['setting_key' => $key],
                [
                    'setting_value' => $value,
                    'setting_type' => str_starts_with($key, 'color_') ? 'color' : 'text',
                    'setting_group' => str_starts_with($key, 'color_') ? 'colors' : 
                                      (str_starts_with($key, 'font_') ? 'typography' : 'general')
                ]
            );
        }
        
        // Handle logo primary upload
        if ($request->hasFile('logo_primary')) {
            $oldLogo = BrandingSetting::where('setting_key', 'logo_primary')->value('setting_value');
            $this->deleteOldFile($oldLogo);
            $file = $request->file('logo_primary');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/branding', $name);

            BrandingSetting::updateOrCreate(
                ['setting_key' => 'logo_primary'],
                [
                    'setting_value' => '/uploads/branding/' . $name,
                    'setting_type' => 'file',
                    'setting_group' => 'logo'
                ]
            );
        }

        // Handle favicon upload
        if ($request->hasFile('logo_favicon')) {
            $oldFavicon = BrandingSetting::where('setting_key', 'logo_favicon')->value('setting_value');
            $this->deleteOldFile($oldFavicon);
            $file = $request->file('logo_favicon');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/branding', $name);

            BrandingSetting::updateOrCreate(
                ['setting_key' => 'logo_favicon'],
                [
                    'setting_value' => '/uploads/branding/' . $name,
                    'setting_type' => 'file',
                    'setting_group' => 'logo'
                ]
            );
        }
        
        $this->logActivity('update', 'branding_settings', null, null, $request->input('settings'));
        return back()->with('success', 'Pengaturan branding berhasil diperbarui.');
    }

    /* ═══════════════════ COLOR PALETTE ═════════════════════════ */
    public function colorPalette()
    {
        if ($redirect = $this->guard()) return $redirect;
        $colors = BrandingSetting::where('setting_group', 'colors')
            ->orderBy('setting_key')
            ->get()
            ->keyBy('setting_key');
        return view('backoffice.color-palette', ['user' => session('backoffice_user'), 'colors' => $colors]);
    }

    public function colorPaletteUpdate(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'colors.*.setting_key' => 'required|string',
            'colors.*.setting_value' => 'required|string|regex:/^#[A-Fa-f0-9]{6}$/',
        ]);

        foreach ($request->input('colors', []) as $color) {
            BrandingSetting::updateOrCreate(
                ['setting_key' => $color['setting_key']],
                [
                    'setting_value' => $color['setting_value'],
                    'setting_type' => 'color',
                    'setting_group' => 'colors'
                ]
            );
        }

        $this->logActivity('update', 'branding_settings', null, null, $request->input('colors'));
        return back()->with('success', 'Palet warna website berhasil diperbarui!');
    }


    public function statistikStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'stat_key'   => 'required|string|max:100|unique:statistics,stat_key',
            'stat_value' => 'required|string|max:255',
            'stat_label' => 'required|string|max:255',
            'stat_icon'  => 'nullable|string|max:100',
        ]);
        $stat = Statistic::create($validated);
        $this->logActivity('create', 'statistics', $stat->id, null, $stat->toArray());
        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json(['success' => true, 'message' => 'Statistik berhasil ditambahkan.']);
        }
        return back()->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function statistikUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $request->validate([
            'stat_value' => 'sometimes|string|max:255',
            'stat_label' => 'sometimes|string|max:255',
            'stat_icon'  => 'sometimes|string|max:100',
            'is_active'  => 'sometimes|boolean',
        ]);
        $stat = Statistic::findOrFail($id);
        $old = $stat->toArray();
        $stat->update($request->only(['stat_value', 'stat_label', 'stat_icon', 'is_active']));
        $this->logActivity('update', 'statistics', $id, $old, $stat->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function statistikDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $stat = Statistic::findOrFail($id);
        $this->logActivity('delete', 'statistics', $id, $stat->toArray());
        $stat->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ ABOUT US CMS ════════════════════════════ */
    public function aboutUs()
    {
        if ($redirect = $this->guard()) return $redirect;
        $sections = AboutPage::orderBy('display_order')->get()->keyBy('section_key');
        return view('backoffice.statistik', ['user' => session('backoffice_user'), 'sections' => $sections, 'stats' => \App\Models\Statistic::orderBy('display_order')->get()]);
    }

    public function aboutUsUpdate(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;

        $request->validate(['sections' => 'required|array']);
        foreach ($request->input('sections', []) as $key => $data) {
            $section = AboutPage::where('section_key', $key)->first();
            $contentData = $data['content'] ?? [];
            // Decode HTML entities to prevent double-encoding (e.g. &amp;amp; -> &amp;)
            array_walk_recursive($contentData, function (&$v) {
                if (is_string($v)) $v = html_entity_decode($v, ENT_QUOTES, 'UTF-8');
            });

            if ($section) {
                $old = $section->toArray();
                $existingContent = is_array($section->section_content)
                    ? $section->section_content
                    : json_decode($section->section_content ?? '[]', true);
                // Replace instead of merge — prevents array duplication on indexed arrays
                $newContent = array_replace_recursive($existingContent ?: [], $contentData);
                $section->update([
                    'section_title'   => $data['title'] ?? $section->section_title,
                    'section_content' => $newContent,
                    'is_active'       => 1,
                ]);
                $this->logActivity('update', 'about_pages', $section->id, $old, $section->fresh()->toArray());
            } else {
                $newSection = AboutPage::create([
                    'section_key'     => $key,
                    'section_title'   => $data['title'] ?? ucfirst($key),
                    'section_content' => $contentData,
                    'display_order'   => 10,
                    'is_active'       => 1,
                ]);
                $this->logActivity('create', 'about_pages', $newSection->id, null, $newSection->toArray());
            }
        }
        return response()->json(['success' => true, 'message' => 'Konten halaman About Us berhasil diperbarui.']);
    }

    /* ═══════════════════ PROGRAM ══════════════════════════════ */
    public function program()
    {
        if ($redirect = $this->guard()) return $redirect;
        $programs   = Program::with('category')->orderBy('category_id')->orderBy('display_order')->get();
        $categories = ProgramCategory::with('programs')->where('is_active', 1)->orderBy('display_order')->get();
        return view('backoffice.program', ['user' => session('backoffice_user'), 'programs' => $programs, 'categories' => $categories]);
    }

    public function programStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'category_id'   => 'required|exists:program_categories,id',
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'duration'      => 'nullable|string|max:100',
            'country_badge' => 'nullable|string|max:100',
            'is_active'     => 'nullable',
            'is_featured'   => 'nullable',
        ]);
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['is_active']   = $request->boolean('is_active', true) ? 1 : 0;
        $validated['is_featured'] = $request->boolean('is_featured') ? 1 : 0;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/program', $name);
            $validated['thumbnail_url'] = '/uploads/program/' . $name;
        } elseif ($request->filled('thumbnail_url')) {
            // Support URL paste
            $request->validate(['thumbnail_url' => 'nullable|url|max:500']);
            $validated['thumbnail_url'] = $request->input('thumbnail_url');
        }

        $program = Program::create($validated);
        $this->logActivity('create', 'programs', $program->id, null, $program->toArray());

        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json(['success' => true, 'id' => $program->id, 'message' => 'Program berhasil ditambahkan.']);
        }
        return back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function programUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $program = Program::findOrFail($id);
        $old = $program->toArray();
        $data = $request->only(['title', 'description', 'duration', 'country_badge', 'category_id', 'thumbnail_url']);
        $data['is_active']   = $request->input('is_active') ? 1 : 0;
        $data['is_featured'] = $request->input('is_featured') ? 1 : 0;

        if ($request->hasFile('thumbnail')) {
            $this->deleteOldFile($program->thumbnail_url);
            $file = $request->file('thumbnail');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/program', $name);
            $data['thumbnail_url'] = '/uploads/program/' . $name;
        }

        $program->update(array_filter($data, fn($v) => $v !== null));
        $this->logActivity('update', 'programs', $id, $old, $program->fresh()->toArray());

        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json(['success' => true, 'message' => 'Program berhasil diperbarui.']);
        }
        return back()->with('success', 'Program berhasil diperbarui.');
    }

    public function programDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $program = Program::findOrFail($id);
        $this->logActivity('delete', 'programs', $id, $program->toArray());
        $program->delete();
        return response()->json(['success' => true]);
    }

    public function programCategoryUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'category_name'        => 'sometimes|string|max:255',
            'subtitle'             => 'nullable|string',
            'description'          => 'nullable|string',
            'career_opportunities' => 'nullable|string',
        ]);
        $cat = ProgramCategory::findOrFail($id);
        $old = $cat->toArray();
        $cat->update($validated);
        $this->logActivity('update', 'program_categories', $id, $old, $cat->fresh()->toArray());

        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function uploadImage(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,gif,webp|max:5120',
        ]);
        $file = $request->file('file');
        $allowedFolders = ['uploads', 'uploads/berita', 'uploads/galeri', 'uploads/program', 'uploads/testimoni', 'uploads/partner', 'uploads/branding'];
        $dir = $request->input('folder', 'uploads');
        if (!in_array($dir, $allowedFolders)) {
            return response()->json(['error' => 'Folder tidak valid.'], 422);
        }
        $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($dir), $name);
        return response()->json(['url' => '/' . $dir . '/' . $name]);
    }

    /* ═══════════════════ BERITA ═══════════════════════════════ */
    public function berita()
    {
        if ($redirect = $this->guard()) return $redirect;
        $articles = NewsArticle::with('author')->orderBy('created_at', 'desc')->get();
        return view('backoffice.berita', ['user' => session('backoffice_user'), 'articles' => $articles]);
    }

    public function beritaStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|in:prestasi,akademik,kegiatan,admisi,alumni,umum,partnership,kampus,keberlanjutan',
            'excerpt'   => 'nullable|string',
            'content'   => 'nullable|string',
            'status'    => 'required|in:draft,dipublikasikan,archived',
            'thumbnail' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);
        $validated['slug']        = Str::slug($validated['title']) . '-' . time();
        $validated['author_id']   = session('backoffice_user')['id'] ?? null;
        $validated['published_at'] = $validated['status'] === 'dipublikasikan' ? now() : null;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        // Sanitize HTML content — allow safe tags only
        if (isset($validated['content'])) {
            $allowed = '<p><br><h1><h2><h3><h4><h5><h6><strong><b><em><i><u><ul><ol><li><a><img><blockquote><pre><code><table><thead><tbody><tr><th><td><div><span>';
            $validated['content'] = strip_tags($validated['content'], $allowed);
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/berita', $name);
            $validated['thumbnail_url'] = '/uploads/berita/' . $name;
        } elseif ($request->filled('thumbnail_url')) {
            $request->validate(['thumbnail_url' => 'nullable|url|max:500']);
            $validated['thumbnail_url'] = $request->input('thumbnail_url');
        }

        $article = NewsArticle::create($validated);
        $this->logActivity('create', 'news_articles', $article->id, null, $article->toArray());
        return back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function beritaUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $article = NewsArticle::findOrFail($id);
        $old = $article->toArray();
        $data = $request->only(['title', 'category', 'excerpt', 'content', 'status']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        // Sanitize HTML content — allow safe tags only
        if (isset($data['content'])) {
            $allowed = '<p><br><h1><h2><h3><h4><h5><h6><strong><b><em><i><u><ul><ol><li><a><img><blockquote><pre><code><table><thead><tbody><tr><th><td><div><span>';
            $data['content'] = strip_tags($data['content'], $allowed);
        }
        if (isset($data['status']) && $data['status'] === 'dipublikasikan' && !$article->published_at) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('thumbnail')) {
            $request->validate(['thumbnail' => 'file|mimes:jpg,jpeg,png,webp|max:5120']);
            $this->deleteOldFile($article->thumbnail_url);
            $file = $request->file('thumbnail');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/berita', $name);
            $data['thumbnail_url'] = '/uploads/berita/' . $name;
        } elseif ($request->filled('thumbnail_url')) {
            $request->validate(['thumbnail_url' => 'nullable|url|max:500']);
            $data['thumbnail_url'] = $request->input('thumbnail_url');
        }
        $article->update($data);
        $this->logActivity('update', 'news_articles', $id, $old, $article->fresh()->toArray());
        return back()->with('success', 'Berita berhasil diperbarui.');
    }

    public function beritaDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $article = NewsArticle::findOrFail($id);
        $this->logActivity('delete', 'news_articles', $id, $article->toArray());
        $article->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ GALERI ═══════════════════════════════ */
    public function galeri()
    {
        if ($redirect = $this->guard()) return $redirect;
        $galleries = Gallery::orderBy('display_order')->get();
        return view('backoffice.galeri', ['user' => session('backoffice_user'), 'galleries' => $galleries]);
    }

    public function galeriStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        
        $imageUrl = null;
        
        if ($request->hasFile('image')) {
            // Upload file
            $request->validate(['image' => 'required|file|mimes:jpg,jpeg,png,webp|max:5120']);
            $file = $request->file('image');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galeri'), $name);
            $imageUrl = '/uploads/galeri/' . $name;
        } elseif ($request->filled('image_url')) {
            // Use URL
            $request->validate(['image_url' => 'required|url']);
            $imageUrl = $request->input('image_url');
        } else {
            return back()->withErrors(['image' => 'Silakan upload file atau paste URL gambar.']);
        }

        $category = $request->input('category', 'umum');
        $validCategories = ['kampus', 'kegiatan', 'fasilitas', 'alumnus', 'partnership', 'umum'];
        if (!in_array($category, $validCategories)) {
            $category = 'umum';
        }

        $gallery = Gallery::create([
            'title'         => $request->input('title', ''),
            'description'   => $request->input('description', ''),
            'image_url'     => $imageUrl,
            'alt_text'      => $request->input('alt_text', ''),
            'category'      => $category,
            'title'         => $request->input('title', ''),
            'description'   => $request->input('description', ''),
            'image_url'     => $imageUrl,
            'alt_text'      => $request->input('alt_text', ''),
            'category'      => $request->input('category', 'umum'),
            'display_order' => (Gallery::max('display_order') ?? 0) + 1,
            'is_active'     => 1,
        ]);
        $this->logActivity('create', 'galleries', $gallery->id, null, $gallery->toArray());
        return back()->with('success', 'Foto berhasil diunggah.');
    }

    public function galeriUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $request->validate([
            'title'         => 'sometimes|string|max:255',
            'alt_text'      => 'nullable|string|max:255',
            'category'      => 'sometimes|in:kampus,kegiatan,fasilitas,alumnus,partnership,umum',
            'is_active'     => 'sometimes|boolean',
            'display_order' => 'sometimes|integer|min:0',
        ]);
        $gallery = Gallery::findOrFail($id);
        $old = $gallery->toArray();
        $gallery->update($request->only(['title', 'alt_text', 'category', 'is_active', 'display_order']));
        $this->logActivity('update', 'galleries', $id, $old, $gallery->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function galeriDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $gallery = Gallery::findOrFail($id);
        $this->logActivity('delete', 'galleries', $id, $gallery->toArray());
        $gallery->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ TESTIMONI ═════════════════════════════ */
    public function testimoni()
    {
        if ($redirect = $this->guard()) return $redirect;
        $testimonials = Testimonial::orderBy('display_order')->get();
        return view('backoffice.testimoni', ['user' => session('backoffice_user'), 'testimonials' => $testimonials]);
    }

    public function testimoniStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company'  => 'nullable|string|max:255',
            'quote'    => 'required|string',
            'rating'   => 'nullable|integer|min:1|max:5',
            'photo'    => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/testimoni', $name);
            $validated['photo_url'] = '/uploads/testimoni/' . $name;
        } elseif ($request->filled('photo_url')) {
            $validated['photo_url'] = $request->input('photo_url');
        }

        $validated['is_featured']  = $request->has('is_featured') ? 1 : 0;
        $validated['is_active']    = 1;
        $validated['display_order'] = (Testimonial::max('display_order') ?? 0) + 1;
        $t = Testimonial::create($validated);
        $this->logActivity('create', 'testimonials', $t->id, null, $t->toArray());
        return back()->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function testimoniUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $t = Testimonial::findOrFail($id);
        $old = $t->toArray();
        $data = $request->only(['name', 'position', 'company', 'quote', 'rating', 'is_active']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('photo')) {
            $request->validate(['photo' => 'file|mimes:jpg,jpeg,png,webp|max:2048']);
            $this->deleteOldFile($t->photo_url);
            $file = $request->file('photo');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/testimoni', $name);
            $data['photo_url'] = '/uploads/testimoni/' . $name;
        } elseif ($request->filled('photo_url')) {
            $data['photo_url'] = $request->input('photo_url');
        }

        $t->update($data);
        $this->logActivity('update', 'testimonials', $id, $old, $t->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function testimoniDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $t = Testimonial::findOrFail($id);
        $this->logActivity('delete', 'testimonials', $id, $t->toArray());
        $t->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ FAQ ══════════════════════════════════ */
    public function faq()
    {
        if ($redirect = $this->guard()) return $redirect;
        $faqs = Faq::orderBy('category')->orderBy('id', 'desc')->get();
        return view('backoffice.faq', ['user' => session('backoffice_user'), 'faqs' => $faqs]);
    }

    public function faqStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
            'category' => 'required|in:akademi,pendaftaran,biaya,kampus,umum,karir',
        ]);
        $validated['display_order'] = (Faq::max('display_order') ?? 0) + 1;
        $f = Faq::create($validated);
        $this->logActivity('create', 'faqs', $f->id, null, $f->toArray());
        return response()->json(['success' => true]);
    }

    public function faqUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $request->validate([
            'question' => 'sometimes|string|max:500',
            'answer'   => 'sometimes|string',
            'category' => 'sometimes|in:akademi,pendaftaran,biaya,kampus,umum,karir',
        ]);
        $f = Faq::findOrFail($id);
        $old = $f->toArray();
        $f->update($request->only(['question', 'answer', 'category', 'is_active']));
        $this->logActivity('update', 'faqs', $id, $old, $f->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function faqDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $f = Faq::findOrFail($id);
        $this->logActivity('delete', 'faqs', $id, $f->toArray());
        $f->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ ADMISI ════════════════════════════════ */
    public function admisi()
    {
        if ($redirect = $this->guard()) return $redirect;
        $admissions = Admission::with('program')->orderBy('admission_year', 'desc')->get();
        $programs   = Program::where('is_active', 1)->get();
        $helpdesk   = FooterSetting::whereIn('setting_key', ['helpdesk_wa', 'helpdesk_email', 'helpdesk_hours'])
            ->pluck('setting_value', 'setting_key')
            ->toArray();

        return view('backoffice.admisi', [
            'user'       => session('backoffice_user'),
            'admissions' => $admissions,
            'programs'   => $programs,
            'helpdesk'   => $helpdesk
        ]);
    }

    public function updateHelpdesk(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $data = $request->validate([
            'helpdesk_wa'    => 'nullable|string|max:100',
            'helpdesk_email' => 'nullable|string|max:100',
            'helpdesk_hours' => 'nullable|string|max:255',
        ]);

        foreach ($data as $key => $val) {
            FooterSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $val, 'setting_group' => 'contact']
            );
        }

        $this->logActivity('update', 'footer_settings');
        return response()->json(['success' => true, 'message' => 'Kontak helpdesk berhasil diperbarui.']);
    }

    public function admisiUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $request->validate([
            'status'          => 'sometimes|in:active,graduated,dropout,transferred,suspended',
            'notes'           => 'nullable|string',
            'graduation_date' => 'nullable|date',
        ]);
        $admission = Admission::findOrFail($id);
        $old = $admission->toArray();
        $admission->update($request->only(['status', 'notes', 'graduation_date']));
        $this->logActivity('update', 'admissions', $id, $old, $admission->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ PENDAFTAR ═════════════════════════════ */
    public function pendaftar()
    {
        if ($redirect = $this->guard()) return $redirect;
        $pendaftarList = Registration::orderBy('created_at', 'desc')->get();
        return view('backoffice.pendaftar', ['user' => session('backoffice_user'), 'pendaftarList' => $pendaftarList]);
    }

    public function pendaftarExportExcel()
    {
        if ($redirect = $this->guard()) return $redirect;
        $registrations = Registration::orderBy('created_at', 'desc')->get();
        
        $filename = 'data_pendaftar_dhs_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];
        
        $callback = function() use ($registrations) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header columns
            fputcsv($file, [
                'ID',
                'Nama Lengkap',
                'No. HP/WA',
                'Email',
                'Kategori Program',
                'Nama Program',
                'Permintaan Khusus',
                'Sumber Informasi',
                'Status',
                'Tanggal Daftar',
                'Bukti Pembayaran Pendaftaran',
                'Bukti Pembayaran Program',
                'Catatan',
                'Dibuat Pada',
                'Diupdate Pada'
            ]);
            
            // Data rows
            foreach ($registrations as $reg) {
                // Model sudah cast info_sources ke array, tidak perlu json_decode lagi
                $infoSources = is_array($reg->info_sources) 
                    ? implode(', ', $reg->info_sources) 
                    : '-';
                
                fputcsv($file, [
                    $reg->id,
                    $reg->full_name,
                    $reg->phone,
                    $reg->email,
                    $reg->category_key ?? '-',
                    $reg->program_title ?? '-',
                    $reg->special_request ?? '-',
                    $infoSources,
                    ucfirst($reg->status),
                    $reg->registration_date,
                    $reg->registration_fee_proof ?? '-',
                    $reg->program_fee_proof ?? '-',
                    $reg->notes ?? '-',
                    $reg->created_at,
                    $reg->updated_at
                ]);
            }
            
            fclose($file);
        };
        
        $this->logActivity('export', 'registrations');
        
        return response()->stream($callback, 200, $headers);
    }

    public function pendaftarUpdateStatus(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;

        $validated = $request->validate([
            'id'     => 'required|integer|min:1',
            'status' => 'required|in:Baru,Diproses,Diterima,Ditolak',
        ]);

        $statusMap = [
            'Baru' => 'pending', 'Diproses' => 'verified',
            'Diterima' => 'accepted', 'Ditolak' => 'rejected',
        ];
        $reg = Registration::findOrFail($validated['id']);
        $reg->update(['status' => $statusMap[$validated['status']]]);
        $this->logActivity('update', 'registrations', $reg->id);
        return response()->json(['success' => true]);
    }

    public function pendaftarDestroy(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate(['id' => 'required|integer|min:1']);
        $reg = Registration::findOrFail($validated['id']);
        $this->logActivity('delete', 'registrations', $reg->id, $reg->toArray());
        $reg->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ NAVIGASI ══════════════════════════════ */
    public function navigasi()
    {
        if ($redirect = $this->guard()) return $redirect;
        
        $menus = NavigationMenu::whereNull('parent_id')->with('children')->orderBy('display_order')->get();
        return view('backoffice.navigasi', ['user' => session('backoffice_user'), 'menus' => $menus]);
    }

    public function navigasiStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'menu_label' => 'required|string|max:255',
            'menu_url'   => 'nullable|string|max:500',
            'menu_type'  => 'required|in:header,footer,both',
        ]);
        $validated['display_order'] = (NavigationMenu::max('display_order') ?? 0) + 1;
        $m = NavigationMenu::create($validated);
        $this->logActivity('create', 'navigation_menus', $m->id, null, $m->toArray());
        return back()->with('success', 'Menu navigasi berhasil ditambahkan.');
    }

    public function navigasiUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $m = NavigationMenu::findOrFail($id);
        $old = $m->toArray();
        $m->update($request->only(['menu_label', 'menu_url', 'menu_type', 'is_active', 'display_order']));
        $this->logActivity('update', 'navigation_menus', $id, $old, $m->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function navigasiDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $m = NavigationMenu::findOrFail($id);
        $this->logActivity('delete', 'navigation_menus', $id, $m->toArray());
        $m->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ FOOTER SETTINGS ══════════════════════ */
    public function footer()
    {
        if ($redirect = $this->guard()) return $redirect;
        $settings = FooterSetting::all()->keyBy('setting_key');
        return view('backoffice.footer', ['user' => session('backoffice_user'), 'settings' => $settings]);
    }

    public function footerUpdate(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        foreach ($request->input('settings', []) as $key => $value) {
            FooterSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }
        $this->logActivity('update', 'footer_settings');
        return back()->with('success', 'Pengaturan footer berhasil diperbarui.');
    }

    /* ═══════════════════ USERS ═════════════════════════════════ */
    public function users()
    {
        if ($redirect = $this->guard()) return $redirect;
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backoffice.users', ['user' => session('backoffice_user'), 'users' => $users]);
    }

    public function usersStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:super_admin,admin,editor',
        ]);
        $u = User::create($validated);
        $u->role = $validated['role'];
        $u->is_active = 1;
        $u->save();
        $this->logActivity('create', 'users', $u->id, null, ['name' => $u->name, 'username' => $u->username, 'email' => $u->email, 'role' => $u->role]);
        return back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function usersUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;

        $validated = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'username' => 'sometimes|string|max:255|unique:users,username,'.$id,
            'email'    => 'sometimes|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',
            'role'     => 'sometimes|in:super_admin,admin,editor',
        ]);

        $u = User::findOrFail($id);
        $old = $u->only(['name', 'username', 'email', 'role', 'is_active']);
        $data = $request->only(['name', 'username', 'email', 'role']);
        // Prevent privilege escalation
        $currentUser = session('backoffice_user');
        if (($currentUser['role'] ?? '') !== 'super_admin') {
            unset($data['role']);
        }
        if (($currentUser['id'] ?? null) == $id) {
            unset($data['role']);
        }
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }
        $u->update($data);
        // Set role and is_active explicitly (not in $fillable)
        if (isset($data['role'])) {
            $u->role = $data['role'];
        }
        $u->is_active = $request->has('is_active') ? 1 : 0;
        $u->save();
        $this->logActivity('update', 'users', $id, $old, $u->fresh()->only(['name', 'username', 'email', 'role', 'is_active']));
        return response()->json(['success' => true]);
    }

    public function usersDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $currentUser = session('backoffice_user');
        $currentUserId = $currentUser ? $currentUser['id'] : null;
        if ($currentUserId && $id == $currentUserId) {
            return response()->json(['success' => false, 'message' => 'Tidak bisa menghapus akun yang sedang login.'], 403);
        }
        $u = User::findOrFail($id);
        $this->logActivity('delete', 'users', $id, $u->only(['name', 'email', 'role']));
        $u->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ PARTNER ══════════════════════════════ */
    public function partner()
    {
        if ($redirect = $this->guard()) return $redirect;
        $partners = Partner::orderBy('display_order')->get();
        return view('backoffice.partner', ['user' => session('backoffice_user'), 'partners' => $partners]);
    }

    public function partnerStore(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'partner_group' => 'required|in:mitra_industri,partnership',
            'type'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'website_url' => 'nullable|string|max:500',
            'country'     => 'nullable|string|max:100',
            'logo_url'    => 'nullable|string',
        ]);
        $validated['is_active']    = $request->has('is_active') ? 1 : 0;
        $validated['is_featured']  = $request->has('is_featured') ? 1 : 0;
        $validated['display_order'] = (Partner::max('display_order') ?? 0) + 1;

        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/partner', $name);
            $validated['logo_url'] = '/uploads/partner/' . $name;
        }

        $p = Partner::create($validated);
        $this->logActivity('create', 'partners', $p->id, null, $p->toArray());
        return back()->with('success', 'Partner berhasil ditambahkan.');
    }

    public function partnerUpdate(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $p = Partner::findOrFail($id);
        $old = $p->toArray();
        $data = $request->only(['name', 'partner_group', 'type', 'description', 'website_url', 'country', 'logo_url', 'display_order']);
        $data['is_active']   = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('logo_file')) {
            $this->deleteOldFile($p->logo_url);
            $file = $request->file('logo_file');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/partner', $name);
            $data['logo_url'] = '/uploads/partner/' . $name;
        } elseif (array_key_exists('logo_url', $data)) {
            $data['logo_url'] = $data['logo_url'] ?: null;
        }

        $p->update($data);
        $this->logActivity('update', 'partners', $id, $old, $p->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function partnerDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $p = Partner::findOrFail($id);
        $this->logActivity('delete', 'partners', $id, $p->toArray());
        $p->delete();
        return response()->json(['success' => true]);
    }
}
