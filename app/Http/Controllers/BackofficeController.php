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

    private function deleteOldFile(?string $path): void
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

    public function programEdit($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $program    = Program::with('category')->findOrFail($id);
        $categories = ProgramCategory::where('is_active', 1)->orderBy('display_order')->get();
        return view('backoffice.program-edit', [
            'user'       => session('backoffice_user'),
            'program'    => $program,
            'categories' => $categories,
        ]);
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
        $data = $request->only([
            'title', 'description', 'duration', 'country_badge', 'category_id',
            'thumbnail_url', 'brochure_url', 'tuition_fee',
            'curriculum', 'requirements', 'facilities',
            'display_order',
        ]);
        $data['is_active']   = $request->input('is_active') ? 1 : 0;
        $data['is_featured'] = $request->input('is_featured') ? 1 : 0;

        // Regenerate slug if title changed
        if (!empty($data['title']) && $data['title'] !== $program->title) {
            $data['slug'] = Str::slug($data['title']);
        }

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
            'file' => 'required|image|mimes:jpeg,png,gif,webp,svg,jpg|max:5120',
        ]);
        $file = $request->file('file');
        $allowedFolders = ['uploads', 'uploads/hero', 'uploads/dokumen', 'uploads/layanan', 'uploads/beranda', 'uploads/berita', 'uploads/galeri', 'uploads/galeri/foto', 'uploads/galeri/video', 'uploads/program', 'uploads/testimoni', 'uploads/partner', 'uploads/branding', 'uploads/pendaftaran', 'uploads/pendaftaran/bukti'];
        $dir = $request->input('folder', 'uploads');
        if (!str_starts_with($dir, 'uploads')) {
            $dir = 'uploads/' . trim($dir, '/');
        }
        if (!in_array($dir, $allowedFolders)) {
            $dir = 'uploads';
        }
        $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $this->moveUploadedFile($file, $dir, $name);
        return response()->json(['url' => '/' . $dir . '/' . $name]);
    }

    public function uploadVideo(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;
        $request->validate([
            'file' => 'required|file|mimes:mp4,webm|max:40960',
        ]);
        $file = $request->file('file');
        $allowedFolders = ['uploads', 'uploads/hero', 'uploads/beranda', 'uploads/berita', 'uploads/galeri', 'uploads/galeri/foto', 'uploads/galeri/video', 'uploads/program', 'uploads/testimoni', 'uploads/partner', 'uploads/branding', 'uploads/pendaftaran', 'uploads/pendaftaran/bukti'];
        $dir = $request->input('folder', 'uploads');
        if (!in_array($dir, $allowedFolders)) {
            return response()->json(['error' => 'Folder tidak valid.'], 422);
        }
        $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $this->moveUploadedFile($file, $dir, $name);
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
            $this->moveUploadedFile($file, 'uploads/galeri', $name);
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
        } elseif ($request->filled('logo_url')) {
            $validated['logo_url'] = $request->input('logo_url');
        }

        $p = Partner::create($validated);
        $this->logActivity('create', 'partners', $p->id, null, $p->toArray());

        if ($request->wantsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->isJson()) {
            return response()->json(['success' => true, 'id' => $p->id, 'partner' => $p]);
        }
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
        return response()->json(['success' => true, 'partner' => $p]);
    }

    public function partnerDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $p = Partner::findOrFail($id);
        $this->logActivity('delete', 'partners', $id, $p->toArray());
        $p->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════ PENGAJUAN LAYANAN (BEASISWA & DOKUMEN) ══════════════ */

    public function layanan(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;

        $tipe   = $request->get('tipe', 'semua');
        $status = $request->get('status', 'semua');
        $search = $request->get('search', '');

        $beasiswaKeys = ['beasiswa', 'beasiswa-prestasi', 'beasiswa-stt', 'beasiswa-khusus'];
        $dokumenKeys  = ['layanan-dokumen'];

        $query = Registration::query();

        if ($tipe === 'beasiswa') {
            $query->where('category_key', '!=', 'layanan-dokumen')
                  ->where(function($q) {
                      $q->where('category_key', 'like', '%beasiswa%')
                        ->orWhere('special_request', 'like', '%Tipe: PENGAJUAN BEASISWA%');
                  });
        } elseif ($tipe === 'dokumen') {
            $query->where(function($q) {
                $q->where('category_key', 'layanan-dokumen')
                  ->orWhere('special_request', 'like', '%Tipe: PENGAJUAN LAYANAN DOKUMEN%');
            });
        } else {
            $query->where(function ($q) {
                $q->where('category_key', 'like', '%beasiswa%')
                  ->orWhere('category_key', 'layanan-dokumen')
                  ->orWhere('special_request', 'like', '%PENGAJUAN%');
            });
        }

        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        if ($search) {
            $s = addcslashes($search, '%_');
            $query->where(function ($q) use ($s) {
                $q->where('full_name', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%")
                  ->orWhere('program_title', 'like', "%$s%");
            });
        }

        $items = $query->orderBy('created_at', 'desc')->get();

        $stats = [
            'total'     => Registration::where(function($q) { $q->where('category_key', 'like', '%beasiswa%')->orWhere('category_key', 'layanan-dokumen')->orWhere('special_request', 'like', '%PENGAJUAN%'); })->count(),
            'pending'   => Registration::where(function($q) { $q->where('category_key', 'like', '%beasiswa%')->orWhere('category_key', 'layanan-dokumen')->orWhere('special_request', 'like', '%PENGAJUAN%'); })->where('status', 'pending')->count(),
            'accepted'  => Registration::where(function($q) { $q->where('category_key', 'like', '%beasiswa%')->orWhere('category_key', 'layanan-dokumen')->orWhere('special_request', 'like', '%PENGAJUAN%'); })->where('status', 'accepted')->count(),
            'beasiswa'  => Registration::where('category_key', '!=', 'layanan-dokumen')->where(function($q) { $q->where('category_key', 'like', '%beasiswa%')->orWhere('special_request', 'like', '%Tipe: PENGAJUAN BEASISWA%'); })->count(),
            'dokumen'   => Registration::where(function($q) { $q->where('category_key', 'layanan-dokumen')->orWhere('special_request', 'like', '%Tipe: PENGAJUAN LAYANAN DOKUMEN%'); })->count(),
        ];

        return view('backoffice.layanan', compact('items', 'stats', 'tipe', 'status', 'search'));
    }

    public function layananDetail($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $item = Registration::findOrFail($id);
        return view('backoffice.layanan-detail', compact('item'));
    }

    public function layananUpdateStatus(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $item = Registration::findOrFail($id);
        $old  = $item->toArray();

        $statusMap = [
            'Baru'      => 'pending',
            'Diproses'  => 'verified',
            'Diterima'  => 'accepted',
            'Ditolak'   => 'rejected',
            'pending'   => 'pending',
            'verified'  => 'verified',
            'accepted'  => 'accepted',
            'rejected'  => 'rejected',
        ];

        $rawStatus = $request->input('status', 'pending');
        $dbStatus  = $statusMap[$rawStatus] ?? 'pending';

        $item->update([
            'status' => $dbStatus,
            'notes'  => $request->input('notes', $item->notes),
        ]);

        $this->logActivity('update', 'registrations', $id, $old, $item->fresh()->toArray());
        return response()->json(['success' => true, 'status' => $dbStatus]);
    }

    public function layananUpdateReply(Request $request, $id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $item = Registration::findOrFail($id);
        $old  = $item->toArray();

        $item->update([
            'admin_reply' => $request->input('admin_reply'),
            'notes'       => $request->input('notes', $item->notes),
            'replied_at'  => now(),
        ]);

        $this->logActivity('update', 'registrations', $id, $old, $item->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function layananDestroy($id)
    {
        if ($redirect = $this->guard()) return $redirect;
        $item = Registration::findOrFail($id);
        $this->logActivity('delete', 'registrations', $id, $item->toArray());
        $item->delete();
        return response()->json(['success' => true]);
    }

    public function layananSettings()
    {
        if ($redirect = $this->guard()) return $redirect;

        $section = HomepageSection::where('section_key', 'layanan_form_settings')->first();
        $content = $section ? (is_array($section->section_content) ? $section->section_content : json_decode($section->section_content ?? '[]', true) ?? []) : [];

        $defaultSettings = [
            'header_title'    => 'Formulir Pengajuan Beasiswa & Dokumen',
            'header_subtitle' => 'Pilih Jenis Pengajuan & Daftarkan Diri Anda secara Online di DHS',
            'badge_text'      => 'PENGAJUAN ONLINE DHS',
            'notice_text'     => 'Unggah berkas kelengkapan Anda ke Google Drive dan cantumkan link publik pada formulir di bawah. Tim DHS akan segera memproses pengajuan Anda.',
            'beasiswa_options' => [
                ['key' => 'Beasiswa Prestasi', 'name' => 'Beasiswa Prestasi', 'desc' => 'Keringanan Biaya Pendidikan s/d 50%', 'is_active' => true],
                ['key' => 'Beasiswa STT / Desa', 'name' => 'Beasiswa STT / Desa', 'desc' => 'Utusan Sekaa Teruna & Desa Adat Bali', 'is_active' => true],
                ['key' => 'Beasiswa Khusus', 'name' => 'Beasiswa Khusus', 'desc' => 'Keluarga Kurang Mampu / KIP', 'is_active' => true],
            ],
            'dokumen_options' => [
                ['key' => 'Passport', 'name' => 'Passport (Paspor 48 Hal / Pelaut)', 'issuer' => 'Ditjen Imigrasi & Dephub RI', 'duration' => '7 – 14 hari kerja', 'is_active' => true],
                ['key' => 'BST', 'name' => 'BST (Basic Safety Training)', 'issuer' => 'STCW 2010 / Dephub RI', 'duration' => '5 – 7 hari pelatihan', 'is_active' => true],
                ['key' => 'SDSD', 'name' => 'SDSD (Security Duties on Ships)', 'issuer' => 'ISPS Code & STCW VI/6', 'duration' => '2 – 3 hari pelatihan', 'is_active' => true],
                ['key' => 'CCM', 'name' => 'CCM (Crowd Control Management)', 'issuer' => 'STCW V/2 (Passenger Ships)', 'duration' => '2 – 3 hari pelatihan', 'is_active' => true],
                ['key' => 'SSAT', 'name' => 'SSAT (Ship Security Awareness)', 'issuer' => 'STCW VI/6', 'duration' => '1 – 2 hari pelatihan', 'is_active' => true],
                ['key' => 'PSCRB', 'name' => 'PSCRB (Proficiency in Survival Craft)', 'issuer' => 'STCW VI/2', 'duration' => '3 – 5 hari pelatihan', 'is_active' => true],
                ['key' => 'C1/D Visa', 'name' => 'C1/D VISA (US Seaman Visa)', 'issuer' => 'US Embassy Jakarta & Surabaya', 'duration' => '3 – 6 minggu', 'is_active' => true],
                ['key' => 'Surat Keterangan Alumni', 'name' => 'Surat Keterangan Alumni / Lulus', 'issuer' => 'Akademik DHS', 'duration' => '1 – 3 hari kerja', 'is_active' => true],
                ['key' => 'Transkrip Nilai', 'name' => 'Transkrip Nilai Akademik', 'issuer' => 'Akademik DHS', 'duration' => '1 – 3 hari kerja', 'is_active' => true],
                ['key' => 'Surat Rekomendasi Kerja', 'name' => 'Surat Rekomendasi Kerja / Magang', 'issuer' => 'Admisi & Placement DHS', 'duration' => '1 – 3 hari kerja', 'is_active' => true],
                ['key' => 'Legalisir Dokumen', 'name' => 'Legalisir Dokumen DHS', 'issuer' => 'Akademik DHS', 'duration' => '1 – 2 hari kerja', 'is_active' => true],
            ],
            'helpdesk_wa'    => '+62 81 246 319966',
            'helpdesk_email' => 'sahabat@dhs.or.id',
            'helpdesk_hours' => 'Senin - Sabtu: 08:00 - 17:00 WITA',
        ];

        $settings = array_merge($defaultSettings, $content);
        return view('backoffice.layanan-settings', compact('settings'));
    }

    public function layananSettingsUpdate(Request $request)
    {
        if ($redirect = $this->guard()) return $redirect;

        $content = $request->input('settings', []);
        
        $section = HomepageSection::where('section_key', 'layanan_form_settings')->first();
        if ($section) {
            $old = $section->toArray();
            $section->update([
                'section_title'   => 'Editor Form Layanan Beasiswa & Dokumen',
                'section_content' => $content,
                'is_active'       => 1,
            ]);
            $this->logActivity('update', 'homepage_sections', $section->id, $old, $section->fresh()->toArray());
        } else {
            $newSection = HomepageSection::create([
                'section_key'     => 'layanan_form_settings',
                'section_title'   => 'Editor Form Layanan Beasiswa & Dokumen',
                'section_content' => $content,
                'display_order'   => 15,
                'is_active'       => 1,
            ]);
            $this->logActivity('create', 'homepage_sections', $newSection->id, null, $newSection->toArray());
        }

        return response()->json(['success' => true, 'message' => 'Pengaturan isian formulir berhasil disimpan.']);
    }

    /* ═══════════════ CMS DOKUMEN SERTIFIKASI ══════════════ */

    private function getDokumenCatalogDefaults()
    {
        return [
            'passport' => [
                'title'       => 'Passport (Paspor 48 Hal & Buku Pelaut)',
                'slug'        => 'passport',
                'icon'        => 'card_travel',
                'color'       => '#1A3A5C',
                'badge'       => 'Imigrasi & Dephub RI',
                'category'    => 'Dokumen Perjalanan & Identitas Pelaut',
                'peruntukan'  => 'Kru Kapal Pesiar, Pekerja Hotel Luar Negeri & Pelaut Internasional',
                'waktu'       => '7 – 14 hari kerja',
                'biaya'       => 'Pendampingan Resmi DHS',
                'hero_image'  => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600',
                'description' => 'Paspor adalah dokumen perjalanan resmi yang diterbitkan oleh Ditjen Imigrasi Kemenkumham RI, sedangkan Buku Pelaut (Seaman Book) diterbitkan oleh Ditjen Perhubungan Laut Kemenhub RI.',
                'key_features'=> ['Pemeriksaan & Verifikasi Dokumen 1x24 Jam', 'Bantuan Pengisian Aplikasi M-Paspor & Seaman Book', 'Jadwal Perekaman Biometrik & Wawancara Terpandu', 'Jaminan Dokumen Asli & Resmi Ditjen Imigrasi'],
                'syarat'      => ['KTP / NIK asli yang masih berlaku', 'Kartu Keluarga (KK) terbaru + fotokopi', 'Akta Kelahiran / Ijazah Terakhir / Surat Nikah', 'Pas foto terbaru (background putih & pakaian berkerah)', 'Surat Rekomendasi Kerja / Magang dari DHS (jika diperlukan)', 'Bukti pembayaran PNBP resmi imigrasi / Dephub'],
                'proses'      => ['Konsultasi berkas awal bersama tim admisi DHS', 'Pengecekan kelengkapan & validasi data pemohon', 'Registrasi akun M-Paspor / Portal Seaman Book Kemenhub', 'Penjadwalan antrean biometrik & wawancara di Kantor Imigrasi / KSOP', 'Perekaman foto, sidik jari, dan verifikasi wawancara', 'Penerbitan paspor / buku pelaut & penyerahan ke pemohon'],
                'faq'         => [['q' => 'Berapa lama masa berlaku Paspor RI?', 'a' => 'Paspor RI diterbitkan dengan masa berlaku 10 tahun bagi warga negara Indonesia dewasa.'], ['q' => 'Apakah DHS bisa mendampingi jika paspor hilang atau rusak?', 'a' => 'Ya, tim admisi DHS dapat membantu proses penggantian paspor rusak/hilang dengan pendampingan BAP.']]
            ],
            'bst' => [
                'title'       => 'BST (Basic Safety Training)',
                'slug'        => 'bst',
                'icon'        => 'anchor',
                'color'       => '#0F4C75',
                'badge'       => 'Wajib STCW 2010',
                'category'    => 'Sertifikasi Keselamatan Laut',
                'peruntukan'  => 'Awak Kapal Pesiar, Merchant Navy & Pelaut Pemula',
                'waktu'       => '5 – 7 hari pelatihan',
                'biaya'       => 'Pendampingan Resmi DHS',
                'hero_image'  => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600',
                'description' => 'Basic Safety Training (BST) adalah sertifikasi wajib berdasarkan amandemen STCW 2010 yang wajib dimiliki oleh seluruh kru kapal pesiar tanpa terkecuali.',
                'key_features'=> ['Kurikulum Standar IMO / STCW 2010', 'Praktik Basah (Kolam Renang & Fire House)', 'Sertifikat Garuda / Dephub Resmi & Terverifikasi online', 'Penjadwalan Pelatihan Cepat & Fleksibel'],
                'syarat'      => ['KTP / NIK yang masih berlaku', 'Ijazah SMA / SMK / Sederajat atau Ijazah DHS', 'Pas foto 3x4 & 4x6 (background merah, kemeja putih polos)', 'Surat Keterangan Sehat & Bebas Buta Warna dari Dokter', 'Biaya registrasi & sertifikasi diklat maritim'],
                'proses'      => ['Pendaftaran & penyerahan kelengkapan berkas di DHS', 'Penetapan jadwal gelombang pelatihan diklat maritim', 'Mengikuti sesi teori keselamatan di kelas terakreditasi', 'Praktik lapangan (evakuasi laut, pemadam kebakaran, P3K)', 'Uji evaluasi & penilaian kompetensi keselamatan laut', 'Penerbitan sertifikat BST resmi dari Perhubungan Laut'],
                'faq'         => [['q' => 'Berapa lama masa berlaku sertifikat BST?', 'a' => 'Sertifikat BST berlaku selama 5 tahun dan dapat diperbarui melalui revalidasi diklat.'], ['q' => 'Apakah belum bisa berenang tetap bisa ikut BST?', 'a' => 'Bisa. Instruktur diklat akan melatih pengunaan Life Jacket (pelampung) dan teknik dasar bertahan di air secara aman.']]
            ],
            'sdsd' => [
                'title'       => 'SDSD (Security Duties on Ships)',
                'slug'        => 'sdsd',
                'icon'        => 'security',
                'color'       => '#1B4F72',
                'badge'       => 'ISPS Code & STCW VI/6',
                'category'    => 'Sertifikasi Keamanan Kapal',
                'peruntukan'  => 'Kru Kapal Pesiar dengan Tugas Keamanan Spesifik',
                'waktu'       => '2 – 3 hari pelatihan',
                'biaya'       => 'Pendampingan Resmi DHS',
                'hero_image'  => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600',
                'description' => 'Security Duties on Ships (SDSD) adalah sertifikasi kompetensi keamanan maritim sesuai regulasi STCW VI/6 dan standar ISPS Code.',
                'key_features'=> ['Simulasi Ancaman & Prosedur ISPS Code', 'Sertifikasi Resmi Kementerian Perhubungan RI', 'Syarat Utama Kontrak Kerja Kapal Pesiar Mewah', 'Materi Pelatihan Berstandar Komersial Internasional'],
                'syarat'      => ['Sertifikat BST aktif / fotokopi pengurusan', 'KTP / Passport & Ijazah terakhir', 'Pas foto terbaru (3x4 cm background merah)', 'Buku Pelaut (jika sudah memiliki)', 'Biaya pelatihan & pendaftaran'],
                'proses'      => ['Verifikasi dokumen kelayakan & registrasi peserta', 'Pengenalan regulasi ISPS Code & penilaian risiko keamanan', 'Studi kasus mitigasi konflik & pemeriksaan akses kapal', 'Ujian kompetensi tertulis & praktik peran keamanan', 'Penerbitan sertifikat SDSD resmi dari Perhubungan Laut'],
                'faq'         => [['q' => 'Apa bedanya SDSD dengan SSAT?', 'a' => 'SSAT diperuntukkan bagi seluruh kru umum (kesadaran dasar), sedangkan SDSD mencakup tugas dan peran keamanan fisik khusus di kapal.']]
            ],
            'ccm' => [
                'title'       => 'CCM (Crowd & Crisis Management)',
                'slug'        => 'ccm',
                'icon'        => 'groups',
                'color'       => '#154360',
                'badge'       => 'STCW V/2 (Passenger Ships)',
                'category'    => 'Manajemen Penumpang & Darurat',
                'peruntukan'  => 'Staf F&B, Housekeeping, Guest Service & Kru Kapal Pesiar',
                'waktu'       => '2 – 3 hari pelatihan',
                'biaya'       => 'Pendampingan Resmi DHS',
                'hero_image'  => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600',
                'description' => 'Crowd and Crisis Management (CCM) adalah sertifikasi wajib bagi seluruh staf yang bekerja di kapal penumpang / kapal pesiar berkapasitas besar.',
                'key_features'=> ['Simulasi Manajemen Kerumunan Massal', 'Teknik Komunikasi Kritis & Penanganan Kepanikan', 'Akreditasi Diklat Pelayaran Resmi', 'Persyaratan Mutlak Agen Kapal Pesiar Global'],
                'syarat'      => ['Sertifikat BST aktif', 'KTP / Passport (fotokopi)', 'Pas foto terbaru 3x4 cm background merah', 'Biaya administrasi & sertifikasi diklat'],
                'proses'      => ['Pendaftaran & konfirmasi jadwal kelas CCM', 'Pembekalan teori psikologi massa & prosedur krisis kapal', 'Simulasi pengarahan muster station & evakuasi sekoci', 'Evaluasi penanganan krisis & penugasan tim', 'Penerbitan sertifikat CCM resmi'],
                'faq'         => [['q' => 'Apakah semua departemen di kapal pesiar wajib punya CCM?', 'a' => 'Ya, seluruh departemen layanan (F&B, Housekeeping, Entertainment, Front Office) wajib memegang sertifikat CCM.']]
            ],
            'ssat' => [
                'title'       => 'SSAT (Ship Security Awareness Training)',
                'slug'        => 'ssat',
                'icon'        => 'verified_user',
                'color'       => '#1A5276',
                'badge'       => 'STCW VI/6 (Security Awareness)',
                'category'    => 'Kesadaran Keamanan Kapal',
                'peruntukan'  => 'Seluruh Kru & Pekerja Kapal Laut',
                'waktu'       => '1 – 2 hari pelatihan',
                'biaya'       => 'Pendampingan Resmi DHS',
                'hero_image'  => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600',
                'description' => 'Ship Security Awareness Training (SSAT) melatih setiap kru kapal untuk memiliki kewaspadaan terhadap potensi ancaman keamanan di pelabuhan dan laut lepas.',
                'key_features'=> ['Pemahaman Dasar Prosedur Keamanan Kapal', 'Pelatihan Cepat 1-2 Hari', 'Sertifikat Resmi Terdaftar On-line', 'Biaya Sangat Terjangkau'],
                'syarat'      => ['KTP / Passport yang masih berlaku', 'Ijazah / Identitas Resmi Pemohon', 'Pas foto 3x4 cm background merah', 'Biaya pelatihan SSAT'],
                'proses'      => ['Registrasi peserta di portal DHS', 'Mengikuti pembekalan teori keamanan maritim', 'Ujian evaluasi pemahaman keamanan', 'Penerbitan sertifikat SSAT resmi'],
                'faq'         => [['q' => 'Apakah SSAT perlu diperbarui secara berkala?', 'a' => 'Sertifikat SSAT berlaku seumur hidup selama regulasi STCW tidak mengalami perubahan mendasar.']]
            ],
            'pscrb' => [
                'title'       => 'PSCRB (Survival Craft & Rescue Boats)',
                'slug'        => 'pscrb',
                'icon'        => 'sailing',
                'color'       => '#1B4F72',
                'badge'       => 'STCW VI/2 (Advanced Lifeboat)',
                'category'    => 'Penyelamatan & Operasi Sekoci',
                'peruntukan'  => 'Senior Kru, Supervisor & Petugas Operasi Sekoci',
                'waktu'       => '3 – 5 hari pelatihan',
                'biaya'       => 'Pendampingan Resmi DHS',
                'hero_image'  => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600',
                'description' => 'Proficiency in Survival Craft and Rescue Boats (PSCRB) adalah sertifikasi tingkat lanjut yang melatih kru untuk mengambil alih komando sekoci penyelamat.',
                'key_features'=> ['Praktik Penurunan & Peluncuran Sekoci Penyelamat', 'Pelatihan Komando & Kepemimpinan Tim Evakuasi', 'Peralatan Simulator & Fasilitas Laut Standar IMO', 'Sertifikasi Tingkat Lanjut Terkreditasi'],
                'syarat'      => ['Sertifikat BST aktif', 'Pengalaman atau rekomendasi medis sehat fisik & mental', 'KTP / Passport & Pas foto 3x4 background merah', 'Biaya diklat PSCRB'],
                'proses'      => ['Pendaftaran & verifikasi syarat kelayakan diklat', 'Pemberian materi struktur sekoci & metode peluncuran', 'Praktik lapangan pengoperasian mesin & alat keselamatan sekoci', 'Uji komando evakuasi darurat di air', 'Penerbitan sertifikat PSCRB resmi'],
                'faq'         => [['q' => 'Siapa yang membutuhkan sertifikat PSCRB?', 'a' => 'Senior kru, coxswain, deck department, serta posisi dengan tugas spesifik memimpin kapal penyelamat.']]
            ],
            'c1d-visa' => [
                'title'       => 'C1/D VISA (US Seaman & Transit Visa)',
                'slug'        => 'c1d-visa',
                'icon'        => 'badge',
                'color'       => '#1A3A5C',
                'badge'       => 'US Embassy Jakarta & Surabaya',
                'category'    => 'Visa Kerja & Transit Amerika Serikat',
                'peruntukan'  => 'Kru Kapal Pesiar Rute Karibia, Amerika & Internasional',
                'waktu'       => '3 – 6 minggu (termasuk jadwal wawancara)',
                'biaya'       => 'Pendampingan Khusus DHS',
                'hero_image'  => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600',
                'description' => 'Visa C1/D adalah kombinasi visa transit (C-1) dan visa anggota kru (D) yang diwajibkan oleh Pemerintah Amerika Serikat bagi seluruh pelaut dan kru kapal pesiar.',
                'key_features'=> ['Pengisian Formulir DS-160 Tanpa Kesalahan', 'Pembayaran MRV Fee & Penjadwalan Antrean Cepat', 'Simulasi Wawancara (Mock Interview) Bahasa Inggris', 'Pendampingan Kelengkapan Berkas & Contract Letter'],
                'syarat'      => ['Paspor RI aktif dengan masa berlaku minimal 8 bulan', 'Surat Jaminan / Letter of Employment (LoE) dari Agen Kapal', 'Sertifikat STCW lengkap (BST, SDSD, CCM, dll.)', 'Pas Foto Visa Amerika (5x5 cm background putih polos)', 'Formulir DS-160 & Bukti Pembayaran MRV Fee', 'Rekening Koran / Bukti Keuangan & Dokumen Identitas'],
                'proses'      => ['Review berkas & kontrak kerja kapal pesiar bersama DHS', 'Pengisian formulir DS-160 online secara presisi', 'Pembayaran biaya visa MRV & pembuat akun ustraveldocs', 'Penjadwalan tanggal wawancara di Kedutaan/Konsulat AS', 'Sesi briefing & simulasi wawancara langsung bersama Tim DHS', 'Pelaksanaan wawancara & pengambilan paspor ter-stempel visa'],
                'faq'         => [['q' => 'Berapa lama masa berlaku Visa C1/D Amerika?', 'a' => 'Visa C1/D umumnya diberikan dengan masa berlaku hingga 5 (lima) tahun dengan multiple entry.'], ['q' => 'Bagaimana jika belum memiliki Letter of Employment (LoE)?', 'a' => 'Wawancara Visa C1/D memerlukan LoE resmi. Tim DHS akan membantu memastikan jadwal visa disesuaikan dengan proses rekrutmen agen Anda.']]
            ],
        ];
    }

    public function dokumenSertifikasiIndex()
    {
        if ($redirect = $this->guard()) return $redirect;

        $defaults = $this->getDokumenCatalogDefaults();
        $documents = [];

        foreach ($defaults as $type => $def) {
            $sectionKey = 'dokumen_sertifikasi_' . $type;
            $sec = HomepageSection::where('section_key', $sectionKey)->first();
            $content = $sec ? (is_array($sec->section_content) ? $sec->section_content : json_decode($sec->section_content ?? '[]', true) ?? []) : [];
            $doc = array_replace_recursive($def, $content);
            $doc['updated_at'] = $sec ? \Carbon\Carbon::parse($sec->updated_at)->format('d M Y H:i') : 'Standar Default';
            $documents[$type] = $doc;
        }

        return view('backoffice.dokumen-sertifikasi-index', compact('documents'));
    }

    public function dokumenSertifikasiEdit($type)
    {
        if ($redirect = $this->guard()) return $redirect;

        $defaults = $this->getDokumenCatalogDefaults();
        if (!array_key_exists($type, $defaults)) {
            abort(404);
        }

        $def = $defaults[$type];
        $sectionKey = 'dokumen_sertifikasi_' . $type;
        $sec = HomepageSection::where('section_key', $sectionKey)->first();
        $content = $sec ? (is_array($sec->section_content) ? $sec->section_content : json_decode($sec->section_content ?? '[]', true) ?? []) : [];
        $doc = array_replace_recursive($def, $content);

        return view('backoffice.dokumen-sertifikasi-edit', compact('doc', 'type'));
    }

    public function dokumenSertifikasiUpdate(Request $request, $type)
    {
        if ($redirect = $this->guard()) return $redirect;

        $defaults = $this->getDokumenCatalogDefaults();
        if (!array_key_exists($type, $defaults)) {
            return response()->json(['success' => false, 'message' => 'Tipe dokumen tidak valid.'], 404);
        }

        $data = $request->input('doc', []);
        $sectionKey = 'dokumen_sertifikasi_' . $type;

        $section = HomepageSection::where('section_key', $sectionKey)->first();
        if ($section) {
            $old = $section->toArray();
            $section->update([
                'section_title'   => 'CMS Halaman ' . ($data['title'] ?? $type),
                'section_content' => $data,
                'is_active'       => 1,
            ]);
            $this->logActivity('update', 'homepage_sections', $section->id, $old, $section->fresh()->toArray());
        } else {
            $newSection = HomepageSection::create([
                'section_key'     => $sectionKey,
                'section_title'   => 'CMS Halaman ' . ($data['title'] ?? $type),
                'section_content' => $data,
                'display_order'   => 20,
                'is_active'       => 1,
            ]);
            $this->logActivity('create', 'homepage_sections', $newSection->id, null, $newSection->toArray());
        }

        return response()->json(['success' => true, 'message' => 'Halaman Dokumen Sertifikasi berhasil diperbarui!']);
    }

    /*
    |--------------------------------------------------------------------------
    | PROGRAM DETAIL CMS METHODS (Full page content editor like Dokumen Sertifikasi)
    |--------------------------------------------------------------------------
    */
    public function getProgramDetailDefaults($slug)
    {
        $program = Program::with('category')->where('slug', $slug)->first();
        if (!$program) {
            $program = Program::with('category')->first();
        }

        $title = $program ? $program->title : 'Program 1 Tahun + Ausbildung Jerman';
        $category = $program && $program->category ? $program->category->category_name : 'Program Internasional';
        $country = $program ? ($program->country_badge ?: 'JERMAN') : 'JERMAN';
        $duration = $program ? ($program->duration ?: '2 Tahun') : '2 Tahun';
        $heroImage = $program && $program->thumbnail_url ? $program->thumbnail_url : 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600';
        $desc = $program && $program->description ? $program->description : 'Program pendidikan vokasi siap kerja yang memadukan teori industri pariwisata terkini dengan praktik intensif (70% Praktik & 30% Teori). Peserta didik dibimbing langsung oleh instruktur berpengalaman dari hotel berbintang dan kapal pesiar.';

        return [
            'slug'                  => $slug,
            'title'                 => $title,
            'category'              => $category,
            'country_badge'         => $country,
            'duration'              => $duration,
            'sertifikasi'           => 'Resmi DHS & Industri',
            'status_akreditasi'     => 'Terakreditasi',
            'hero_image'            => $heroImage,
            'cta_text'              => 'Daftar Program Ini Online',
            'tuition_fee'           => $program ? ($program->tuition_fee ?: '') : '',
            'brochure_url'          => $program ? ($program->brochure_url ?: '') : '',

            // Card 1: Deskripsi & Profil
            'desc_title'            => 'Deskripsi & Profil Program',
            'desc_subtitle'         => 'Gambaran umum kurikulum dan fokus pembelajaran.',
            'description'           => $desc,
            'desc_p2'               => 'Melalui kurikulum berbasis kompetensi yang disesuaikan dengan kebutuhan pasar kerja global, lulusan program ini dipersiapkan untuk langsung diserap oleh jaringan hotel berbintang, restoran internasional, serta perusahaan kapal pesiar terkemuka di dalam dan luar negeri.',

            // Card 2: 4 Box Aktivitas & Kegiatan Pembelajaran
            'activities_title'      => 'Aktivitas & Kegiatan Pembelajaran',
            'activities_subtitle'   => 'Rincian kegiatan praktik dan pelatihan selama masa studi.',
            'activities'            => [
                [
                    'icon'  => 'science',
                    'color' => '#4f46e5',
                    'title' => '70% Praktik Laboratorium',
                    'desc'  => 'Simulasi kerja di Kitchen Lab, Bar & Restaurant, Mockup Hotel Room, dan Front Office Counter.'
                ],
                [
                    'icon'  => 'flight_takeoff',
                    'color' => '#d97706',
                    'title' => 'On the Job Training (OJT)',
                    'desc'  => 'Praktik kerja lapangan selama 6 bulan di hotel bintang 4 & 5 Bali, Jakarta, atau kapal pesiar internasional.'
                ],
                [
                    'icon'  => 'translate',
                    'color' => '#059669',
                    'title' => 'English for Hospitality',
                    'desc'  => 'Pembekalan intensif percakapan Bahasa Inggris maritim dan perhotelan untuk persiapan wawancara kerja.'
                ],
                [
                    'icon'  => 'record_voice_over',
                    'color' => '#c53030',
                    'title' => 'Mockup Interview & Mentoring',
                    'desc'  => 'Bimbingan khusus pembuatan CV internasional dan simulasi wawancara bersama praktisi senior.'
                ]
            ],

            // Card 3: 5 Benefit & Keuntungan
            'benefits_title'        => 'Manfaat & Benefit yang Didapatkan',
            'benefits_subtitle'     => 'Keunggulan dan fasilitas eksklusif bagi setiap peserta program.',
            'benefits'              => [
                [
                    'title' => 'Sertifikat Resmi Terakreditasi & Garuda Dephub',
                    'desc'  => 'Memperoleh Ijazah Vokasi DHS dan Sertifikat Kompetensi resmi yang diakui secara nasional maupun industri maritim & perhotelan global.'
                ],
                [
                    'title' => 'Penyaluran Kerja & Kerjasama 50+ Hotel Bintang 5',
                    'desc'  => 'Jaminan pendampingan karir sampai bekerja melalui jaringan kemitraan DHS di Bali, nasional, dan internasional.'
                ],
                [
                    'title' => 'Fasilitas Lab Lengkap Tanpa Biaya Tersembunyi',
                    'desc'  => 'Seluruh bahan masakan, peralatan bar, dan sarana laboratorium disiapkan kampus tanpa ada pungutan biaya tambahan selama praktik.'
                ],
                [
                    'title' => 'Bimbingan Praktisi Aktif Perhotelan & Kapal Pesiar',
                    'desc'  => 'Diajar langsung oleh Ex-Executive Chef, Head Bartender, dan General Manager yang masih aktif berkarir di industri hospitality.'
                ],
                [
                    'title' => 'Akses Beasiswa Keringanan Biaya s/d 50%',
                    'desc'  => 'Berhak mengklaim Beasiswa Prestasi, Beasiswa STT/Desa, atau Beasiswa Khusus DHS bagi peserta didik berprestasi dan kurang mampu.'
                ]
            ],

            // Card 4: Kurikulum
            'curriculum_title'      => 'Materi & Kurikulum Pelatihan',
            'curriculum_subtitle'   => 'Modul keahlian yang dipelajari selama masa studi.',
            'curriculum'            => $program && $program->curriculum ? $program->curriculum : "• Pengantar Industri Pariwisata & Perhotelan Modern\n• Operasional Dapur Profesional (Food Production & Culinary Art)\n• Food & Beverage Service & Mixology Bar\n• Housekeeping & Room Management Standar Internasional\n• Front Office Operation & Reservation System\n• Bahasa Asing Khusus Maritim & Hospitality (English & Deutsch)\n• On the Job Training (OJT) 6 Bulan di Hotel Bintang 5 / Kapal Pesiar",

            // Card 5: Persyaratan
            'requirements_title'    => 'Persyaratan Pendaftaran',
            'requirements_subtitle' => 'Kelengkapan administrasi dan kriteria calon peserta.',
            'requirements'          => [
                'Pria / Wanita, usia minimal 17 tahun.',
                'Lulusan SMA / SMK / MA / Paket C sederajat.',
                'Sehat jasmani dan rohani serta bebas narkoba.',
                'Memiliki motivasi tinggi untuk berkarir di industri pariwisata & kapal pesiar.',
                'Menyerahkan fotokopi KTP, KK, Akta Kelahiran, Ijazah & Pas Foto terbaru.'
            ],

            // Card 6: Fasilitas
            'facilities_title'      => 'Fasilitas & Sarana Pendukung',
            'facilities_subtitle'   => 'Sarana laboratorium dan fasilitas praktik yang disediakan.',
            'facilities'            => $program && $program->facilities ? $program->facilities : "• Kitchen Laboratory lengkap berstandar hotel bintang 5\n• Bar & Restaurant Praktek Modern\n• Mock-up Hotel Suite Room & Front Office System\n• Free Seragam Praktek, Modul Pembelajaran & Bahan Lab",

            // Sidebar & Helpdesk
            'sidebar_gelombang'     => 'Pendaftaran Gelombang Baru',
            'sidebar_kuota'         => 'Kuota terbatas untuk setiap gelombang pelatihan.',
            'sidebar_phone'         => '(0361) 222-123',
            'sidebar_wa'            => '+62 81 246 319966',
            'sidebar_helpdesk_title'=> 'Butuh Info Lebih Lanjut?',
            'sidebar_helpdesk_sub'  => 'Tim Admisi DHS Siap Membantu',
            'sidebar_helpdesk_desc' => 'Konsultasikan jadwal kelas, rincian biaya pendidikan, dan opsi beasiswa melalui sekretariat DHS.'
        ];
    }

    public function programDetailIndex()
    {
        if ($redirect = $this->guard()) return $redirect;

        $programs = Program::with('category')->where('is_active', 1)->orderBy('category_id')->orderBy('display_order')->get();
        return view('backoffice.program-detail-index', compact('programs'));
    }

    public function programDetailEdit($slug)
    {
        if ($redirect = $this->guard()) return $redirect;

        $program = Program::with('category')->where('slug', $slug)->first();
        if (!$program) {
            abort(404);
        }

        $def = $this->getProgramDetailDefaults($slug);
        $sectionKey = 'program_detail_' . $slug;
        $sec = HomepageSection::where('section_key', $sectionKey)->first();
        $content = $sec ? (is_array($sec->section_content) ? $sec->section_content : json_decode($sec->section_content ?? '[]', true) ?? []) : [];
        $doc = array_replace_recursive($def, $content);

        $categories = ProgramCategory::where('is_active', 1)->orderBy('display_order')->get();

        return view('backoffice.program-detail-edit', compact('doc', 'slug', 'program', 'categories'));
    }

    public function programDetailUpdate(Request $request, $slug)
    {
        if ($redirect = $this->guard()) return $redirect;

        $program = Program::where('slug', $slug)->first();
        $data = $request->input('doc', []);
        $sectionKey = 'program_detail_' . $slug;

        $section = HomepageSection::where('section_key', $sectionKey)->first();
        if ($section) {
            $old = $section->toArray();
            $section->update([
                'section_title'   => 'CMS Detail Halaman ' . ($data['title'] ?? $slug),
                'section_content' => $data,
                'is_active'       => 1,
            ]);
            $this->logActivity('update', 'homepage_sections', $section->id, $old, $section->fresh()->toArray());
        } else {
            $newSection = HomepageSection::create([
                'section_key'     => $sectionKey,
                'section_title'   => 'CMS Detail Halaman ' . ($data['title'] ?? $slug),
                'section_content' => $data,
                'display_order'   => 30,
                'is_active'       => 1,
            ]);
            $this->logActivity('create', 'homepage_sections', $newSection->id, null, $newSection->toArray());
        }

        // Sync base attributes with the Program model if it exists
        if ($program) {
            $programUpdates = [];
            if (!empty($data['title'])) $programUpdates['title'] = $data['title'];
            if (!empty($data['description'])) $programUpdates['description'] = $data['description'];
            if (!empty($data['duration'])) $programUpdates['duration'] = $data['duration'];
            if (!empty($data['country_badge'])) $programUpdates['country_badge'] = $data['country_badge'];
            if (isset($data['hero_image'])) $programUpdates['thumbnail_url'] = $data['hero_image'];
            if (isset($data['tuition_fee'])) $programUpdates['tuition_fee'] = $data['tuition_fee'];
            if (isset($data['brochure_url'])) $programUpdates['brochure_url'] = $data['brochure_url'];
            if (isset($data['curriculum'])) $programUpdates['curriculum'] = is_array($data['curriculum']) ? implode("\n", $data['curriculum']) : $data['curriculum'];
            if (isset($data['facilities'])) $programUpdates['facilities'] = is_array($data['facilities']) ? implode("\n", $data['facilities']) : $data['facilities'];
            if (isset($data['requirements']) && is_array($data['requirements'])) $programUpdates['requirements'] = implode("\n", $data['requirements']);

            if (!empty($programUpdates)) {
                $program->update($programUpdates);
            }
        }

        return response()->json(['success' => true, 'message' => 'Konten Halaman Program berhasil disimpan!']);
    }
}




