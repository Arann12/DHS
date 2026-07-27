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
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BackofficeController extends Controller
{
    /* ── Guard: redirect if not logged in ─────────────────── */
    private function guard()
    {
        if (!session('backoffice_user')) abort(redirect('/backoffice'));
    }

    private function logActivity(string $action, string $table = null, int $recordId = null, array $old = null, array $new = null)
    {
        $u = session('backoffice_user');
        ActivityLog::create([
            'user_id'    => $u['id'] ?? null,
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

    /* ═══════════════════ DASHBOARD ═══════════════════════════ */
    public function dashboard()
    {
        $this->guard();
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
        $this->guard();
        $sections = HomepageSection::orderBy('display_order')->get()->keyBy('section_key');
        return view('backoffice.beranda', ['user' => session('backoffice_user'), 'sections' => $sections]);
    }

    public function berandaUpdate(Request $request)
    {
        $this->guard();
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
                $newContent = array_merge($existingContent ?: [], $contentData);

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
        $this->guard();
        $settings = BrandingSetting::all()->keyBy('setting_key');
        return view('backoffice.branding', ['user' => session('backoffice_user'), 'settings' => $settings]);
    }

    public function brandingUpdate(Request $request)
    {
        $this->guard();
        foreach ($request->input('settings', []) as $key => $value) {
            BrandingSetting::where('setting_key', $key)->update(['setting_value' => $value]);
        }
        // Handle logo upload
        if ($request->hasFile('logo_primary')) {
            $file = $request->file('logo_primary');
            $name = 'logo_' . time() . '.' . $file->extension();
            $file->move(public_path('image'), $name);
            BrandingSetting::where('setting_key', 'logo_primary')->update(['setting_value' => '/image/' . $name]);
        }
        $this->logActivity('update', 'branding_settings');
        return back()->with('success', 'Pengaturan branding berhasil diperbarui.');
    }

    /* ═══════════════════ COLOR PALETTE ═════════════════════════ */
    public function colorPalette()
    {
        $this->guard();
        $colors = BrandingSetting::where('setting_group', 'colors')
            ->orderBy('setting_key')
            ->get()
            ->keyBy('setting_key');
        return view('backoffice.color-palette', ['user' => session('backoffice_user'), 'colors' => $colors]);
    }

    public function colorPaletteUpdate(Request $request)
    {
        $this->guard();
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

    /* ═══════════════════ STATISTIK ════════════════════════════ */
    public function statistik()
    {
        $this->guard();
        $stats = Statistic::orderBy('display_order')->get();
        return view('backoffice.statistik', ['user' => session('backoffice_user'), 'stats' => $stats]);
    }

    public function statistikStore(Request $request)
    {
        $this->guard();
        $validated = $request->validate([
            'stat_key'   => 'required|string|max:100|unique:statistics,stat_key',
            'stat_value' => 'required|string|max:255',
            'stat_label' => 'required|string|max:255',
            'stat_icon'  => 'nullable|string|max:100',
        ]);
        $stat = Statistic::create($validated);
        $this->logActivity('create', 'statistics', $stat->id, null, $stat->toArray());
        return back()->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function statistikUpdate(Request $request, $id)
    {
        $this->guard();
        $stat = Statistic::findOrFail($id);
        $old = $stat->toArray();
        $stat->update($request->only(['stat_value', 'stat_label', 'stat_icon', 'is_active']));
        $this->logActivity('update', 'statistics', $id, $old, $stat->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function statistikDestroy($id)
    {
        $this->guard();
        $stat = Statistic::findOrFail($id);
        $this->logActivity('delete', 'statistics', $id, $stat->toArray());
        $stat->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ PROGRAM ══════════════════════════════ */
    public function program()
    {
        $this->guard();
        $programs   = Program::with('category')->orderBy('category_id')->orderBy('display_order')->get();
        $categories = ProgramCategory::where('is_active', 1)->orderBy('display_order')->get();
        return view('backoffice.program', ['user' => session('backoffice_user'), 'programs' => $programs, 'categories' => $categories]);
    }

    public function programStore(Request $request)
    {
        $this->guard();
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
        $validated['is_active']   = $request->has('is_active') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/programs'), $name);
            $validated['thumbnail_url'] = '/uploads/programs/' . $name;
        } elseif ($request->filled('thumbnail_url')) {
            // Support URL paste
            $validated['thumbnail_url'] = $request->input('thumbnail_url');
        }

        $program = Program::create($validated);
        $this->logActivity('create', 'programs', $program->id, null, $program->toArray());
        return back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function programUpdate(Request $request, $id)
    {
        $this->guard();
        $program = Program::findOrFail($id);
        $old = $program->toArray();
        $data = $request->only(['title', 'description', 'duration', 'country_badge', 'category_id']);
        $data['is_active']   = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/programs'), $name);
            $data['thumbnail_url'] = '/uploads/programs/' . $name;
        } elseif ($request->filled('thumbnail_url')) {
            // Support URL paste
            $data['thumbnail_url'] = $request->input('thumbnail_url');
        }

        $program->update($data);
        $this->logActivity('update', 'programs', $id, $old, $program->fresh()->toArray());
        return back()->with('success', 'Program berhasil diperbarui.');
    }

    public function programDestroy($id)
    {
        $this->guard();
        $program = Program::findOrFail($id);
        $this->logActivity('delete', 'programs', $id, $program->toArray());
        $program->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ BERITA ═══════════════════════════════ */
    public function berita()
    {
        $this->guard();
        $articles = NewsArticle::with('author')->orderBy('created_at', 'desc')->get();
        return view('backoffice.berita', ['user' => session('backoffice_user'), 'articles' => $articles]);
    }

    public function beritaStore(Request $request)
    {
        $this->guard();
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string',
            'excerpt'  => 'nullable|string',
            'content'  => 'nullable|string',
            'status'   => 'required|in:draft,dipublikasikan,archived',
        ]);
        $validated['slug']        = Str::slug($validated['title']) . '-' . time();
        $validated['author_id']   = session('backoffice_user')['id'];
        $validated['published_at'] = $validated['status'] === 'dipublikasikan' ? now() : null;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $name);
            $validated['thumbnail_url'] = '/uploads/news/' . $name;
        } elseif ($request->filled('thumbnail_url')) {
            // Support URL paste
            $validated['thumbnail_url'] = $request->input('thumbnail_url');
        }

        $article = NewsArticle::create($validated);
        $this->logActivity('create', 'news_articles', $article->id, null, $article->toArray());
        return back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function beritaUpdate(Request $request, $id)
    {
        $this->guard();
        $article = NewsArticle::findOrFail($id);
        $old = $article->toArray();
        $data = $request->only(['title', 'category', 'excerpt', 'content', 'status']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        if (isset($data['status']) && $data['status'] === 'dipublikasikan' && !$article->published_at) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $name);
            $data['thumbnail_url'] = '/uploads/news/' . $name;
        } elseif ($request->filled('thumbnail_url')) {
            // Support URL paste
            $data['thumbnail_url'] = $request->input('thumbnail_url');
        }
        $article->update($data);
        $this->logActivity('update', 'news_articles', $id, $old, $article->fresh()->toArray());
        return back()->with('success', 'Berita berhasil diperbarui.');
    }

    public function beritaDestroy($id)
    {
        $this->guard();
        $article = NewsArticle::findOrFail($id);
        $this->logActivity('delete', 'news_articles', $id, $article->toArray());
        $article->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ GALERI ═══════════════════════════════ */
    public function galeri()
    {
        $this->guard();
        $galleries = Gallery::orderBy('display_order')->get();
        return view('backoffice.galeri', ['user' => session('backoffice_user'), 'galleries' => $galleries]);
    }

    public function galeriStore(Request $request)
    {
        $this->guard();
        
        $imageUrl = null;
        
        if ($request->hasFile('image')) {
            // Upload file
            $request->validate(['image' => 'required|file|mimes:jpg,jpeg,png,webp|max:5120']);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/gallery'), $name);
            $imageUrl = '/uploads/gallery/' . $name;
        } elseif ($request->filled('image_url')) {
            // Use URL
            $request->validate(['image_url' => 'required|url']);
            $imageUrl = $request->input('image_url');
        } else {
            return back()->withErrors(['image' => 'Silakan upload file atau paste URL gambar.']);
        }

        $gallery = Gallery::create([
            'title'         => $request->input('title', ''),
            'description'   => $request->input('description', ''),
            'image_url'     => $imageUrl,
            'alt_text'      => $request->input('alt_text', ''),
            'category'      => $request->input('category', 'umum'),
            'display_order' => Gallery::count() + 1,
            'is_active'     => 1,
        ]);
        $this->logActivity('create', 'galleries', $gallery->id, null, $gallery->toArray());
        return back()->with('success', 'Foto berhasil diunggah.');
    }

    public function galeriUpdate(Request $request, $id)
    {
        $this->guard();
        $gallery = Gallery::findOrFail($id);
        $old = $gallery->toArray();
        $gallery->update($request->only(['title', 'alt_text', 'category', 'is_active', 'display_order']));
        $this->logActivity('update', 'galleries', $id, $old, $gallery->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function galeriDestroy($id)
    {
        $this->guard();
        $gallery = Gallery::findOrFail($id);
        $this->logActivity('delete', 'galleries', $id, $gallery->toArray());
        $gallery->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ TESTIMONI ═════════════════════════════ */
    public function testimoni()
    {
        $this->guard();
        $testimonials = Testimonial::orderBy('display_order')->get();
        return view('backoffice.testimoni', ['user' => session('backoffice_user'), 'testimonials' => $testimonials]);
    }

    public function testimoniStore(Request $request)
    {
        $this->guard();
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company'  => 'nullable|string|max:255',
            'quote'    => 'required|string',
            'rating'   => 'nullable|integer|min:1|max:5',
        ]);
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials'), $name);
            $validated['photo_url'] = '/uploads/testimonials/' . $name;
        } elseif ($request->filled('photo_url')) {
            $validated['photo_url'] = $request->input('photo_url');
        }
        
        $validated['is_featured']  = $request->has('is_featured') ? 1 : 0;
        $validated['is_active']    = 1;
        $validated['display_order'] = Testimonial::count() + 1;
        $t = Testimonial::create($validated);
        $this->logActivity('create', 'testimonials', $t->id, null, $t->toArray());
        return back()->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function testimoniUpdate(Request $request, $id)
    {
        $this->guard();
        $t = Testimonial::findOrFail($id);
        $old = $t->toArray();
        $data = $request->only(['name', 'position', 'company', 'quote', 'rating', 'is_active']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials'), $name);
            $data['photo_url'] = '/uploads/testimonials/' . $name;
        } elseif ($request->filled('photo_url')) {
            $data['photo_url'] = $request->input('photo_url');
        }
        
        $t->update($data);
        $this->logActivity('update', 'testimonials', $id, $old, $t->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function testimoniDestroy($id)
    {
        $this->guard();
        $t = Testimonial::findOrFail($id);
        $this->logActivity('delete', 'testimonials', $id, $t->toArray());
        $t->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ FAQ ══════════════════════════════════ */
    public function faq()
    {
        $this->guard();
        $faqs = Faq::orderBy('category')->orderBy('display_order')->get();
        return view('backoffice.faq', ['user' => session('backoffice_user'), 'faqs' => $faqs]);
    }

    public function faqStore(Request $request)
    {
        $this->guard();
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
            'category' => 'required|string',
        ]);
        $validated['display_order'] = Faq::count() + 1;
        $f = Faq::create($validated);
        $this->logActivity('create', 'faqs', $f->id, null, $f->toArray());
        return back()->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function faqUpdate(Request $request, $id)
    {
        $this->guard();
        $f = Faq::findOrFail($id);
        $old = $f->toArray();
        $f->update($request->only(['question', 'answer', 'category', 'is_active']));
        $this->logActivity('update', 'faqs', $id, $old, $f->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function faqDestroy($id)
    {
        $this->guard();
        $f = Faq::findOrFail($id);
        $this->logActivity('delete', 'faqs', $id, $f->toArray());
        $f->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ ADMISI ════════════════════════════════ */
    public function admisi()
    {
        $this->guard();
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
        $this->guard();
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
        $this->guard();
        $admission = Admission::findOrFail($id);
        $old = $admission->toArray();
        $admission->update($request->only(['status', 'notes', 'graduation_date']));
        $this->logActivity('update', 'admissions', $id, $old, $admission->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ PENDAFTAR ═════════════════════════════ */
    public function pendaftar()
    {
        $this->guard();
        $pendaftarList = Registration::orderBy('created_at', 'desc')->get();
        return view('backoffice.pendaftar', ['user' => session('backoffice_user'), 'pendaftarList' => $pendaftarList]);
    }

    public function pendaftarExportExcel()
    {
        $this->guard();
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
                $infoSources = is_array($reg->info_sources) 
                    ? implode(', ', $reg->info_sources) 
                    : (is_string($reg->info_sources) ? implode(', ', json_decode($reg->info_sources, true) ?? []) : '-');
                
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
        $this->guard();
        $statusMap = [
            'Baru' => 'pending', 'Diproses' => 'verified',
            'Diterima' => 'accepted', 'Ditolak' => 'rejected',
        ];
        $reg = Registration::findOrFail($request->input('id'));
        $reg->update(['status' => $statusMap[$request->input('status')] ?? 'pending']);
        $this->logActivity('update', 'registrations', $reg->id);
        return response()->json(['success' => true]);
    }

    public function pendaftarDestroy(Request $request)
    {
        $this->guard();
        $reg = Registration::findOrFail($request->input('id'));
        $this->logActivity('delete', 'registrations', $reg->id, $reg->toArray());
        $reg->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ NAVIGASI ══════════════════════════════ */
    public function navigasi()
    {
        $this->guard();
        $menus = NavigationMenu::whereNull('parent_id')->with('children')->orderBy('display_order')->get();
        return view('backoffice.navigasi', ['user' => session('backoffice_user'), 'menus' => $menus]);
    }

    public function navigasiStore(Request $request)
    {
        $this->guard();
        $validated = $request->validate([
            'menu_label' => 'required|string|max:255',
            'menu_url'   => 'nullable|string|max:500',
            'menu_type'  => 'required|in:header,footer,both',
        ]);
        $validated['display_order'] = NavigationMenu::count() + 1;
        $m = NavigationMenu::create($validated);
        $this->logActivity('create', 'navigation_menus', $m->id, null, $m->toArray());
        return back()->with('success', 'Menu navigasi berhasil ditambahkan.');
    }

    public function navigasiUpdate(Request $request, $id)
    {
        $this->guard();
        $m = NavigationMenu::findOrFail($id);
        $old = $m->toArray();
        $m->update($request->only(['menu_label', 'menu_url', 'menu_type', 'is_active', 'display_order']));
        $this->logActivity('update', 'navigation_menus', $id, $old, $m->fresh()->toArray());
        return response()->json(['success' => true]);
    }

    public function navigasiDestroy($id)
    {
        $this->guard();
        $m = NavigationMenu::findOrFail($id);
        $this->logActivity('delete', 'navigation_menus', $id, $m->toArray());
        $m->delete();
        return response()->json(['success' => true]);
    }

    /* ═══════════════════ FOOTER SETTINGS ══════════════════════ */
    public function footer()
    {
        $this->guard();
        $settings = FooterSetting::all()->keyBy('setting_key');
        return view('backoffice.footer', ['user' => session('backoffice_user'), 'settings' => $settings]);
    }

    public function footerUpdate(Request $request)
    {
        $this->guard();
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
        $this->guard();
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backoffice.users', ['user' => session('backoffice_user'), 'users' => $users]);
    }

    public function usersStore(Request $request)
    {
        $this->guard();
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:super_admin,admin,editor',
        ]);
        $validated['password']  = Hash::make($validated['password']);
        $validated['is_active'] = 1;
        $u = User::create($validated);
        $this->logActivity('create', 'users', $u->id, null, ['name' => $u->name, 'email' => $u->email, 'role' => $u->role]);
        return back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function usersUpdate(Request $request, $id)
    {
        $this->guard();
        $u = User::findOrFail($id);
        $old = $u->only(['name', 'email', 'role', 'is_active']);
        $data = $request->only(['name', 'email', 'role']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $u->update($data);
        $this->logActivity('update', 'users', $id, $old, $u->fresh()->only(['name', 'email', 'role', 'is_active']));
        return response()->json(['success' => true]);
    }

    public function usersDestroy($id)
    {
        $this->guard();
        $currentUserId = session('backoffice_user')['id'];
        if ($id == $currentUserId) {
            return response()->json(['error' => 'Tidak bisa menghapus akun yang sedang login.'], 403);
        }
        $u = User::findOrFail($id);
        $this->logActivity('delete', 'users', $id, $u->only(['name', 'email', 'role']));
        $u->delete();
        return response()->json(['success' => true]);
    }
}
