<?php

namespace App\Http\Controllers;

use App\Models\HomepageSection;
use App\Models\NewsArticle;
use App\Models\ProgramCategory;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Statistic;
use App\Models\Gallery;
use App\Models\Faq;
use App\Models\Registration;
use App\Models\FooterSetting;
use App\Models\BrandingSetting;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    /**
     * Shared data for all frontend views.
     */
    private function shared()
    {
        $footerSettings = FooterSetting::pluck('setting_value', 'setting_key')->toArray();
        $branding = BrandingSetting::pluck('setting_value', 'setting_key')->toArray();
        $siteName = $footerSettings['site_name'] ?? 'Denpasar Hotel School';
        $tagline = $footerSettings['tagline'] ?? '"Transforming Into Excellent"';
        $navLogo = $branding['logo_primary'] ?? '/image/LogoDHS.png';

        return compact('footerSettings', 'branding', 'siteName', 'tagline', 'navLogo');
    }

    private function moveUploadedFile($file, string $dir, string $name): void
    {
        $dest = public_path($dir);
        if (!is_dir($dest)) {
            \Illuminate\Support\Facades\File::makeDirectory($dest, 0755, true);
        }
        $file->move($dest, $name);
    }

    public function welcome()
    {
        $sections = HomepageSection::orderBy('display_order')
            ->get()
            ->keyBy('section_key');

        $featuredNews = NewsArticle::where('status', 'dipublikasikan')
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        $featuredPrograms = Program::with('category')
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->orderBy('display_order')
            ->take(6)
            ->get();

        $testimonials = Testimonial::where('is_active', 1)
            ->where('is_featured', 1)
            ->orderBy('display_order')
            ->get();

        $partners = Partner::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $stats = Statistic::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $galleries = Gallery::where('is_active', 1)
            ->orderBy('display_order')
            ->take(8)
            ->get();

        $programCategories = ProgramCategory::with('programs')
            ->where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $shared = $this->shared();

        return view('welcome', array_merge($shared, compact(
            'sections', 'featuredNews', 'featuredPrograms',
            'testimonials', 'partners', 'stats', 'galleries',
            'programCategories'
        )));
    }

    public function tentang()
    {
        $sections = AboutPage::where('is_active', 1)
            ->orderBy('display_order')
            ->get()
            ->keyBy('section_key');

        $stats = Statistic::where('is_active', 1)->orderBy('display_order')->get();

        $galleries = Gallery::where('is_active', 1)
            ->orderBy('display_order')
            ->take(12)
            ->get();

        $partners = Partner::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $shared = $this->shared();

        return view('tentang', array_merge($shared, compact('sections', 'stats', 'galleries', 'partners')));
    }

    public function akademi()
    {
        $categories = ProgramCategory::with('programs')
            ->where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $partners = Partner::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        // Academy hero data from about_pages
        $academyHeroRecord = AboutPage::where('section_key', 'academy_hero')->first();
        $academyHero = $academyHeroRecord
            ? (is_array($academyHeroRecord->section_content) ? $academyHeroRecord->section_content : json_decode($academyHeroRecord->section_content ?? '[]', true) ?? [])
            : [];

        $shared = $this->shared();

        return view('akademi', array_merge($shared, compact('categories', 'partners', 'academyHero')));
    }

    public function detailBerita($slug)
    {
        $article = NewsArticle::where('slug', $slug)
            ->where('status', 'dipublikasikan')
            ->with('author')
            ->firstOrFail();

        // Session-based: only increment once per visitor per article
        $sessionKey = 'viewed_article_' . $article->id;
        if (!session()->has($sessionKey)) {
            $article->increment('views_count');
            session()->put($sessionKey, true);
        }

        $related = NewsArticle::where('status', 'dipublikasikan')
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $shared = $this->shared();

        return view('detail-berita', array_merge($shared, compact('article', 'related')));
    }

    /**
     * AJAX endpoint: return current views_count for an article.
     */
    public function getArticleViews($slug)
    {
        $article = NewsArticle::where('slug', $slug)
            ->select('views_count')
            ->first();

        if (!$article) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json(['views_count' => $article->views_count]);
    }

    public function berita(Request $request)
    {
        $query = NewsArticle::where('status', 'dipublikasikan')
            ->orderBy('published_at', 'desc');

        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        if ($request->filled('q')) {
            $search = addcslashes($request->q, '%_');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('excerpt', 'like', "%$search%");
            });
        }

        $articles = $query->paginate(9);
        $featured = NewsArticle::where('status', 'dipublikasikan')
            ->where('is_featured', 1)
            ->orderBy('published_at', 'desc')
            ->first();

        $shared = $this->shared();

        return view('berita', array_merge($shared, compact('articles', 'featured')));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', 1)
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');

        $shared = $this->shared();

        return view('faq', array_merge($shared, compact('faqs')));
    }

    public function karier()
    {
        $partners = Partner::where('is_active', 1)
            ->orderBy('type')
            ->orderBy('display_order')
            ->get()
            ->groupBy('type');

        $shared = $this->shared();

        return view('karier', array_merge($shared, compact('partners')));
    }

    public function registration()
    {
        $categories = ProgramCategory::with('programs')
            ->where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $helpdesk = FooterSetting::whereIn('setting_key', ['helpdesk_wa', 'helpdesk_email', 'helpdesk_hours'])
            ->pluck('setting_value', 'setting_key')
            ->toArray();

        $shared = $this->shared();

        return view('registration', array_merge($shared, compact('categories', 'helpdesk')));
    }

    public function submitRegistration(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'      => 'required|string|max:255',
            'hp_wa'             => 'required|string|max:50',
            'email'             => 'required|email|max:255',
            'kategori'          => 'required|string',
            'program'           => 'required|string',
            'special_request'   => 'nullable|string',
            'bukti_pendaftaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bukti_program'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sumber_info'       => 'nullable|array',
        ]);

        $buktiPendaftaranPath = null;
        if ($request->hasFile('bukti_pendaftaran')) {
            $file = $request->file('bukti_pendaftaran');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/pendaftaran', $name);
            $buktiPendaftaranPath = '/uploads/pendaftaran/' . $name;
        }

        $buktiProgramPath = null;
        if ($request->hasFile('bukti_program')) {
            $file = $request->file('bukti_program');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $this->moveUploadedFile($file, 'uploads/pendaftaran', $name);
            $buktiProgramPath = '/uploads/pendaftaran/' . $name;
        }

        Registration::create([
            'full_name'              => $validated['nama_lengkap'],
            'phone'                  => $validated['hp_wa'],
            'email'                  => $validated['email'],
            'category_key'           => $validated['kategori'],
            'program_title'          => $validated['program'],
            'special_request'        => $validated['special_request'] ?? null,
            'registration_fee_proof' => $buktiPendaftaranPath,
            'program_fee_proof'      => $buktiProgramPath,
            'info_sources'           => $request->input('sumber_info', []),
            'status'                 => 'pending',
            'registration_date'      => now()->toDateString(),
        ]);

        return back()->with('reg_success', 'Terima kasih ' . $validated['nama_lengkap'] . '! Pendaftaran Anda telah kami terima. Tim admisi DHS akan menghubungi WhatsApp Anda dalam 1x24 jam.');
    }
    public function layanan()
    {
        $categories = ProgramCategory::with('programs')
            ->where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $formSettingsRecord = HomepageSection::where('section_key', 'layanan_form_settings')->first();
        $formSettings = $formSettingsRecord ? (is_array($formSettingsRecord->section_content) ? $formSettingsRecord->section_content : json_decode($formSettingsRecord->section_content ?? '[]', true) ?? []) : [];

        $shared = $this->shared();
        return view('layanan', array_merge($shared, compact('categories', 'formSettings')));
    }

    public function submitLayanan(Request $request)
    {
        $tipe = $request->input('tipe_pengajuan', 'beasiswa');
        $jenisUtama = $request->input('jenis_pengajuan_utama', '');

        if ($tipe === 'beasiswa') {
            $validated = $request->validate([
                'nama_lengkap'   => 'required|string|max:255',
                'hp_wa'          => 'required|string|max:50',
                'email'          => 'required|email|max:255',
                'asal_sekolah'   => 'nullable|string|max:255',
                'kategori'       => 'nullable|string',
                'program'        => 'nullable|string',
                'skema_beasiswa' => 'nullable|string',
                'link_berkas'    => 'required|url|max:1000',
                'motivasi'       => 'nullable|string|max:2000',
                'catatan'        => 'nullable|string|max:2000',
            ]);

            $skema = ($validated['skema_beasiswa'] ?? null) ?: ($jenisUtama ?: 'Beasiswa DHS');
            $programTitle = ($validated['program'] ?? null) ?: $skema;

            $specialRequestLines = array_filter([
                'Tipe: PENGAJUAN BEASISWA',
                'Skema Beasiswa: ' . $skema,
                'Program Studi: ' . $programTitle,
                'Link Berkas (Drive): ' . $validated['link_berkas'],
                !empty($validated['motivasi']) ? 'Motivasi: ' . $validated['motivasi'] : '',
                !empty($validated['catatan']) ? 'Catatan: ' . $validated['catatan'] : '',
                !empty($validated['asal_sekolah']) ? 'Asal Sekolah: ' . $validated['asal_sekolah'] : '',
            ]);

            Registration::create([
                'full_name'         => $validated['nama_lengkap'],
                'phone'             => $validated['hp_wa'],
                'email'             => $validated['email'],
                'category_key'      => ($validated['kategori'] ?? null) ?: 'beasiswa',
                'program_title'     => $programTitle,
                'special_request'   => implode("\n", $specialRequestLines),
                'status'            => 'pending',
                'registration_date' => now()->toDateString(),
            ]);

            return back()->with('reg_success', 'Terima kasih ' . $validated['nama_lengkap'] . '! Pengajuan beasiswa (' . $skema . ') Anda telah diterima. Tim DHS akan mengkonfirmasi berkas Anda via WhatsApp dalam 1x24 jam.');

        } else {
            $validated = $request->validate([
                'nama_lengkap'  => 'required|string|max:255',
                'hp_wa'         => 'required|string|max:50',
                'email'         => 'required|email|max:255',
                'tahun_lulus'   => 'nullable|string|max:20',
                'nomor_induk'   => 'nullable|string|max:100',
                'jenis_dokumen' => 'nullable|string',
                'tujuan'        => 'nullable|string|max:500',
                'link_berkas'   => 'required|url|max:1000',
                'catatan'       => 'nullable|string|max:2000',
            ]);

            $docType = ($validated['jenis_dokumen'] ?? null) ?: ($jenisUtama ?: 'Layanan Dokumen');

            $specialRequestLines = array_filter([
                'Tipe: PENGAJUAN LAYANAN DOKUMEN',
                'Jenis Dokumen: ' . $docType,
                'Tujuan: ' . ($validated['tujuan'] ?? '-'),
                'Link Berkas (Drive): ' . $validated['link_berkas'],
                !empty($validated['catatan']) ? 'Catatan: ' . $validated['catatan'] : '',
                !empty($validated['tahun_lulus']) ? 'Tahun Lulus: ' . $validated['tahun_lulus'] : '',
                !empty($validated['nomor_induk']) ? 'No. Induk: ' . $validated['nomor_induk'] : '',
            ]);

            Registration::create([
                'full_name'         => $validated['nama_lengkap'],
                'phone'             => $validated['hp_wa'],
                'email'             => $validated['email'],
                'category_key'      => 'layanan-dokumen',
                'program_title'     => $docType,
                'special_request'   => implode("\n", $specialRequestLines),
                'status'            => 'pending',
                'registration_date' => now()->toDateString(),
            ]);

            return back()->with('reg_success', 'Terima kasih ' . $validated['nama_lengkap'] . '! Permintaan pengurusan dokumen (' . $docType . ') Anda telah diterima. Tim administrasi DHS akan memproses permintaan Anda.');
        }
    }

    /**
     * Halaman Detail Informasi Layanan Dokumen
     * Route: /dokumen/{type}
     */
    public function detailDokumen(string $type)
    {
        $catalog = [
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
                'description' => 'Paspor adalah dokumen perjalanan resmi yang diterbitkan oleh Ditjen Imigrasi Kemenkumham RI, sedangkan Buku Pelaut (Seaman Book) diterbitkan oleh Ditjen Perhubungan Laut Kemenhub RI. DHS menyediakan pendampingan menyeluruh untuk pengurusan Paspor 48 Halaman dan Buku Pelaut, yang merupakan syarat wajib mutlak untuk bekerja di kapal pesiar internasional maupun jaringan hotel mancanegara.',
                'key_features'=> [
                    'Pemeriksaan & Verifikasi Dokumen 1x24 Jam',
                    'Bantuan Pengisian Aplikasi M-Paspor & Seaman Book',
                    'Jadwal Perekaman Biometrik & Wawancara Terpandu',
                    'Jaminan Dokumen Asli & Resmi Ditjen Imigrasi'
                ],
                'syarat' => [
                    'KTP / NIK asli yang masih berlaku',
                    'Kartu Keluarga (KK) terbaru + fotokopi',
                    'Akta Kelahiran / Ijazah Terakhir / Surat Nikah',
                    'Pas foto terbaru (background putih & pakaian berkerah)',
                    'Surat Rekomendasi Kerja / Magang dari DHS (jika diperlukan)',
                    'Bukti pembayaran PNBP resmi imigrasi / Dephub',
                ],
                'proses' => [
                    'Konsultasi berkas awal bersama tim admisi DHS',
                    'Pengecekan kelengkapan & validasi data pemohon',
                    'Registrasi akun M-Paspor / Portal Seaman Book Kemenhub',
                    'Penjadwalan antrean biometrik & wawancara di Kantor Imigrasi / KSOP',
                    'Perekaman foto, sidik jari, dan verifikasi wawancara',
                    'Penerbitan paspor / buku pelaut & penyerahan ke pemohon',
                ],
                'faq' => [
                    [
                        'q' => 'Berapa lama masa berlaku Paspor RI?',
                        'a' => 'Paspor RI diterbitkan dengan masa berlaku 10 tahun bagi warga negara Indonesia dewasa.'
                    ],
                    [
                        'q' => 'Apakah DHS bisa mendampingi jika paspor hilang atau rusak?',
                        'a' => 'Ya, tim admisi DHS dapat membantu proses penggantian paspor rusak/hilang dengan pendampingan berita acara pemeriksaan (BAP).'
                    ]
                ]
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
                'description' => 'Basic Safety Training (BST) adalah sertifikasi wajib berdasarkan amandemen STCW 2010 yang wajib dimiliki oleh seluruh kru kapal pesiar tanpa terkecuali. Pelatihan ini mencakup 4 elemen utama keselamatan di laut: Personal Survival Techniques (PST), Fire Prevention and Fire Fighting (FPFF), Elementary First Aid (EFA), dan Personal Safety & Social Responsibilities (PSSR). DHS bekerja sama langsung dengan lembaga diklat maritim terakreditasi untuk memastikan peserta lulus secara resmi.',
                'key_features'=> [
                    'Kurikulum Standar IMO / STCW 2010',
                    'Praktik Basah (Kolam Renang & Fire House)',
                    'Sertifikat Garuda / Dephub Resmi & Terverifikasi online',
                    'Penjadwalan Pelatihan Cepat & Fleksibel'
                ],
                'syarat' => [
                    'KTP / NIK yang masih berlaku',
                    'Ijazah SMA / SMK / Sederajat atau Ijazah DHS',
                    'Pas foto 3x4 & 4x6 (background merah, kemeja putih polos)',
                    'Surat Keterangan Sehat & Bebas Buta Warna dari Dokter',
                    'Biaya registrasi & sertifikasi diklat maritim',
                ],
                'proses' => [
                    'Pendaftaran & penyerahan kelengkapan berkas di DHS',
                    'Penetapan jadwal gelombang pelatihan diklat maritim',
                    'Mengikuti sesi teori keselamatan di kelas terakreditasi',
                    'Praktik lapangan (evakuasi laut, pemadam kebakaran, P3K)',
                    'Uji evaluasi & penilaian kompetensi keselamatan laut',
                    'Penerbitan sertifikat BST resmi dari Perhubungan Laut',
                ],
                'faq' => [
                    [
                        'q' => 'Berapa lama masa berlaku sertifikat BST?',
                        'a' => 'Sertifikat BST berlaku selama 5 tahun dan dapat diperbarui melalui revalidasi diklat.'
                    ],
                    [
                        'q' => 'Apakah belum bisa berenang tetap bisa ikut BST?',
                        'a' => 'Bisa. Instruktur diklat akan melatih pengunaan Life Jacket (pelampung) dan teknik dasar bertahan di air secara aman.'
                    ]
                ]
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
                'description' => 'Security Duties on Ships (SDSD) adalah sertifikasi kompetensi keamanan maritim sesuai regulasi STCW VI/6 dan standar ISPS Code. Pelatihan ini melatih peserta untuk mendeteksi ancaman keamanan, merespons gangguan terorisme/perompakan, serta mengoperasikan peralatan keamanan di atas kapal pesiar.',
                'key_features'=> [
                    'Simulasi Ancaman & Prosedur ISPS Code',
                    'Sertifikasi Resmi Kementerian Perhubungan RI',
                    'Syarat Utama Kontrak Kerja Kapal Pesiar Mewah',
                    'Materi Pelatihan Berstandar Komersial Internasional'
                ],
                'syarat' => [
                    'Sertifikat BST aktif / fotokopi pengurusan',
                    'KTP / Passport & Ijazah terakhir',
                    'Pas foto terbaru (3x4 cm background merah)',
                    'Buku Pelaut (jika sudah memiliki)',
                    'Biaya pelatihan & pendaftaran',
                ],
                'proses' => [
                    'Verifikasi dokumen kelayakan & registrasi peserta',
                    'Pengenalan regulasi ISPS Code & penilaian risiko keamanan',
                    'Studi kasus mitigasi konflik & pemeriksaan akses kapal',
                    'Ujian kompetensi tertulis & praktik peran keamanan',
                    'Penerbitan sertifikat SDSD resmi dari Perhubungan Laut',
                ],
                'faq' => [
                    [
                        'q' => 'Apa bedanya SDSD dengan SSAT?',
                        'a' => 'SSAT diperuntukkan bagi seluruh kru umum (kesadaran dasar), sedangkan SDSD mencakup tugas dan peran keamanan fisik khusus di kapal.'
                    ]
                ]
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
                'description' => 'Crowd and Crisis Management (CCM) adalah sertifikasi wajib bagi seluruh staf yang bekerja di kapal penumpang / kapal pesiar berkapasitas besar. Pelatihan ini membekali kru dengan keahlian memimpin evakuasi, mengarahkan ribuan penumpang dalam kondisi darurat, meminimalkan kepanikan, dan berkomunikasi secara efisien di saat krisis.',
                'key_features'=> [
                    'Simulasi Manajemen Kerumunan Massal',
                    'Teknik Komunikasi Kritis & Penanganan Kepanikan',
                    'Akreditasi Diklat Pelayaran Resmi',
                    'Persyaratan Mutlak Agen Kapal Pesiar Global'
                ],
                'syarat' => [
                    'Sertifikat BST aktif',
                    'KTP / Passport (fotokopi)',
                    'Pas foto terbaru 3x4 cm background merah',
                    'Biaya administrasi & sertifikasi diklat',
                ],
                'proses' => [
                    'Pendaftaran & konfirmasi jadwal kelas CCM',
                    'Pembekalan teori psikologi massa & prosedur krisis kapal',
                    'Simulasi pengarahan muster station & evakuasi sekoci',
                    'Evaluasi penanganan krisis & penugasan tim',
                    'Penerbitan sertifikat CCM resmi',
                ],
                'faq' => [
                    [
                        'q' => 'Apakah semua departemen di kapal pesiar wajib punya CCM?',
                        'a' => 'Ya, seluruh departemen layanan (F&B, Housekeeping, Entertainment, Front Office) wajib memegang sertifikat CCM.'
                    ]
                ]
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
                'description' => 'Ship Security Awareness Training (SSAT) melatih setiap kru kapal untuk memiliki kewaspadaan terhadap potensi ancaman keamanan di pelabuhan dan laut lepas. Sertifikat ini menjadi jaminan bahwa seluruh pekerja kapal memahami perannya dalam menjaga keamanan lingkungan kerja.',
                'key_features'=> [
                    'Pemahaman Dasar Prosedur Keamanan Kapal',
                    'Pelatihan Cepat 1-2 Hari',
                    'Sertifikat Resmi Terdaftar On-line',
                    'Biaya Sangat Terjangkau'
                ],
                'syarat' => [
                    'KTP / Passport yang masih berlaku',
                    'Ijazah / Identitas Resmi Pemohon',
                    'Pas foto 3x4 cm background merah',
                    'Biaya pelatihan SSAT',
                ],
                'proses' => [
                    'Registrasi peserta di portal DHS',
                    'Mengikuti pembekalan teori keamanan maritim',
                    'Ujian evaluasi pemahaman keamanan',
                    'Penerbitan sertifikat SSAT resmi',
                ],
                'faq' => [
                    [
                        'q' => 'Apakah SSAT perlu diperbarui secara berkala?',
                        'a' => 'Sertifikat SSAT berlaku seumur hidup selama regulasi STCW tidak mengalami perubahan mendasar.'
                    ]
                ]
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
                'description' => 'Proficiency in Survival Craft and Rescue Boats (PSCRB) adalah sertifikasi tingkat lanjut yang melatih kru untuk mengambil alih komando sekoci penyelamat (lifeboat), launching appliance, dan perahu penyelamat dalam kondisi darurat laut paling ekstrim.',
                'key_features'=> [
                    'Praktik Penurunan & Peluncuran Sekoci Penyelamat',
                    'Pelatihan Komando & Kepemimpinan Tim Evakuasi',
                    'Peralatan Simulator & Fasilitas Laut Standar IMO',
                    'Sertifikasi Tingkat Lanjut Terkreditasi'
                ],
                'syarat' => [
                    'Sertifikat BST aktif',
                    'Pengalaman atau rekomendasi medis sehat fisik & mental',
                    'KTP / Passport & Pas foto 3x4 background merah',
                    'Biaya diklat PSCRB',
                ],
                'proses' => [
                    'Pendaftaran & verifikasi syarat kelayakan diklat',
                    'Pemberian materi struktur sekoci & metode peluncuran',
                    'Praktik lapangan pengoperasian mesin & alat keselamatan sekoci',
                    'Uji komando evakuasi darurat di air',
                    'Penerbitan sertifikat PSCRB resmi',
                ],
                'faq' => [
                    [
                        'q' => 'Siapa yang membutuhkan sertifikat PSCRB?',
                        'a' => 'Senior kru, coxswain, deck department, serta posisi dengan tugas spesifik memimpin kapal penyelamat.'
                    ]
                ]
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
                'description' => 'Visa C1/D adalah kombinasi visa transit (C-1) dan visa anggota kru (D) yang diwajibkan oleh Pemerintah Amerika Serikat bagi seluruh pelaut dan kru kapal pesiar yang akan memasuki wilayah perairan atau transit di pelabuhan AS. Tim DHS menyediakan pendampingan profesional mulai dari pengisian DS-160, pembayaran MRV fee, penjadwalan wawancara, hingga simulasi wawancara tatap muka.',
                'key_features'=> [
                    'Pengisian Formulir DS-160 Tanpa Kesalahan',
                    'Pembayaran MRV Fee & Penjadwalan Antrean Cepat',
                    'Simulasi Wawancara (Mock Interview) Bahasa Inggris',
                    'Pendampingan Kelengkapan Berkas & Contract Letter'
                ],
                'syarat' => [
                    'Paspor RI aktif dengan masa berlaku minimal 8 bulan',
                    'Surat Jaminan / Letter of Employment (LoE) dari Agen Kapal',
                    'Sertifikat STCW lengkap (BST, SDSD, CCM, dll.)',
                    'Pas Foto Visa Amerika (5x5 cm background putih polos)',
                    'Formulir DS-160 & Bukti Pembayaran MRV Fee',
                    'Rekening Koran / Bukti Keuangan & Dokumen Identitas',
                ],
                'proses' => [
                    'Review berkas & kontrak kerja kapal pesiar bersama DHS',
                    'Pengisian formulir DS-160 online secara presisi',
                    'Pembayaran biaya visa MRV & pembuat akun ustraveldocs',
                    'Penjadwalan tanggal wawancara di Kedutaan/Konsulat AS',
                    'Sesi briefing & simulasi wawancara langsung bersama Tim DHS',
                    'Pelaksanaan wawancara & pengambilan paspor ter-stempel visa',
                ],
                'faq' => [
                    [
                        'q' => 'Berapa lama masa berlaku Visa C1/D Amerika?',
                        'a' => 'Visa C1/D umumnya diberikan dengan masa berlaku hingga 5 (lima) tahun dengan multiple entry.'
                    ],
                    [
                        'q' => 'Bagaimana jika belum memiliki Letter of Employment (LoE)?',
                        'a' => 'Wawancara Visa C1/D memerlukan LoE resmi. Tim DHS akan membantu memastikan jadwal visa disesuaikan dengan proses rekrutmen agen Anda.'
                    ]
                ]
            ],
        ];

        $doc  = $catalog[$type];

        // Check if custom CMS data exists in homepage_sections
        $sectionKey = 'dokumen_sertifikasi_' . $type;
        $customDocRecord = HomepageSection::where('section_key', $sectionKey)->first();
        if ($customDocRecord) {
            $customContent = is_array($customDocRecord->section_content)
                ? $customDocRecord->section_content
                : json_decode($customDocRecord->section_content ?? '[]', true);
            if (!empty($customContent)) {
                $doc = array_replace_recursive($doc, $customContent);
            }
        }

        $shared = $this->shared();

        return view('dokumen-detail', array_merge($shared, compact('doc', 'type')));
    }

    /**
     * Halaman Detail Informasi Beasiswa
     * Route: /beasiswa/{type}
     */
    public function detailBeasiswa(string $type)
    {
        $catalog = [
            'beasiswa-prestasi' => [
                'title'       => 'Beasiswa Prestasi',
                'slug'        => 'beasiswa-prestasi',
                'icon'        => 'emoji_events',
                'manfaat'     => 'Keringanan biaya pendidikan hingga 50% untuk seluruh program vokasi DHS selama masa studi.',
                'description' => 'Beasiswa Prestasi DHS diberikan kepada calon peserta didik yang memiliki rekam jejak akademik maupun non-akademik yang luar biasa. Program ini mencerminkan komitmen DHS untuk mendukung generasi muda Bali yang berprestasi agar dapat mengakses pendidikan perhotelan dan pariwisata berkualitas tinggi tanpa hambatan biaya. Penerima beasiswa akan mendapatkan keringanan biaya pendidikan hingga 50% dari biaya normal program yang dipilih.',
                'syarat' => [
                    'Nilai rata-rata rapor / ijazah ≥ 80',
                    'Piagam atau sertifikat prestasi (akademik / non-akademik)',
                    'Lulus tahap seleksi wawancara dengan tim admisi DHS',
                    'Surat keterangan / rekomendasi dari kepala sekolah',
                    'Fotokopi KTP dan Kartu Keluarga',
                    'Pas foto terbaru (3x4 cm)',
                    'Komitmen aktif mengikuti seluruh program studi',
                ],
            ],
            'beasiswa-stt' => [
                'title'       => 'Beasiswa STT / Desa',
                'slug'        => 'beasiswa-stt',
                'icon'        => 'groups',
                'manfaat'     => 'Keringanan biaya pendidikan khusus bagi anggota STT dan utusan resmi desa adat Bali.',
                'description' => 'Beasiswa STT / Utusan Desa Adat adalah program khusus DHS untuk mendukung generasi muda Bali yang aktif dalam kegiatan sosial dan budaya. Program ini ditujukan bagi anggota Sekaa Teruna-Teruni (STT) dan utusan resmi desa adat yang ingin meningkatkan kompetensi di bidang perhotelan dan pariwisata. DHS percaya bahwa kearifan lokal dan profesionalisme global dapat berjalan beriringan.',
                'syarat' => [
                    'Surat rekomendasi resmi dari Bendesa Adat / Pengurus STT',
                    'Aktif sebagai anggota STT / utusan desa adat (dibuktikan KTA)',
                    'Warga Bali berdomisili di Bali (KTP Bali)',
                    'Fotokopi Kartu Keluarga',
                    'Ijazah / SKHUN terakhir',
                    'Pas foto terbaru (3x4 cm)',
                    'Lulus wawancara dengan tim admisi DHS',
                ],
            ],
            'beasiswa-khusus' => [
                'title'       => 'Beasiswa Khusus',
                'slug'        => 'beasiswa-khusus',
                'icon'        => 'workspace_premium',
                'manfaat'     => 'Keringanan biaya pendidikan bagi keluarga kurang mampu dengan komitmen karir tinggi di industri pariwisata.',
                'description' => 'Beasiswa Khusus DHS diperuntukkan bagi calon peserta didik yang berasal dari keluarga dengan keterbatasan ekonomi namun memiliki motivasi dan komitmen kuat untuk berkarir di industri perhotelan dan pariwisata. DHS meyakini bahwa keterbatasan finansial tidak seharusnya menjadi penghalang bagi talenta terbaik untuk berkembang. Seleksi beasiswa ini dilakukan secara langsung oleh Tim DHS melalui wawancara mendalam.',
                'syarat' => [
                    'Surat Keterangan Tidak Mampu (SKTM) dari Desa / Kelurahan',
                    'Kartu Indonesia Pintar (KIP) atau kartu sosial setara (jika ada)',
                    'Esai motivasi (minimal 300 kata) — kenapa ingin berkarir di perhotelan',
                    'Lulus seleksi wawancara khusus oleh Tim DHS',
                    'Fotokopi KTP & Kartu Keluarga',
                    'Ijazah / SKHUN terakhir',
                    'Pas foto terbaru (3x4 cm)',
                ],
            ],
        ];

        if (!array_key_exists($type, $catalog)) {
            abort(404);
        }

        $beasiswa = $catalog[$type];
        $shared = $this->shared();

        return view('beasiswa-detail', array_merge($shared, compact('beasiswa', 'type')));
    }

    /**
     * Halaman Katalo Semua Program Vokasi & Pelatihan DHS
     * Route: /program
     */
    public function programIndex(Request $request)
    {
        $categoryKey = $request->query('category');
        $search = $request->query('q');

        $categories = ProgramCategory::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $query = Program::with('category')->where('is_active', 1);

        if ($categoryKey) {
            $cat = ProgramCategory::where('category_key', $categoryKey)->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('country_badge', 'like', "%{$search}%");
            });
        }

        $programs = $query->orderBy('display_order')->get();
        $shared = $this->shared();

        return view('program-index', array_merge($shared, compact('programs', 'categories', 'categoryKey', 'search')));
    }

    /**
     * Halaman Detail Program Studi / Vokasi
     * Route: /program/{slug}
     */
    public function detailProgram($slug)
    {
        $program = Program::with('category')
            ->where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        $relatedPrograms = Program::with('category')
            ->where('is_active', 1)
            ->where('id', '!=', $program->id)
            ->where('category_id', $program->category_id)
            ->take(3)
            ->get();

        if ($relatedPrograms->isEmpty()) {
            $relatedPrograms = Program::with('category')
                ->where('is_active', 1)
                ->where('id', '!=', $program->id)
                ->take(3)
                ->get();
        }

        // Load custom CMS content for this program if exists
        $sectionKey = 'program_detail_' . $slug;
        $sec = HomepageSection::where('section_key', $sectionKey)->first();
        $content = $sec ? (is_array($sec->section_content) ? $sec->section_content : json_decode($sec->section_content ?? '[]', true) ?? []) : [];

        // Controller defaults helper
        $backofficeCtrl = app(\App\Http\Controllers\BackofficeController::class);
        $defaults = $backofficeCtrl->getProgramDetailDefaults($slug);
        $cms = array_replace_recursive($defaults, $content);

        $shared = $this->shared();

        return view('program-detail', array_merge($shared, compact('program', 'relatedPrograms', 'cms')));
    }

}


