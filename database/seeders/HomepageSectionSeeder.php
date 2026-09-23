<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'section_key' => 'hero',
                'section_title' => 'Hero Section',
                'section_content' => array (
  'headline' => 'Membentuk Masa Depan Perhotelan Global',
  'overline' => 'DENPASAR HOTEL SCHOOL — PUSAT PELATIHAN VOKASI INTERNASIONAL DI BALI',
  'cta1_link' => '/akademi',
  'cta1_text' => 'JELAJAHI PROGRAM',
  'cta2_link' => '/cara-mendaftar',
  'cta2_text' => 'DAFTAR SEKARANG',
  'scroll_text' => 'Geser Untuk Scroll',
  'background_image' => '/image/about_dhs.jpg',
  'background_video_url' => '/uploads/HeroBeranda.webm',
  'background_video_type' => 'uploaded',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'about',
                'section_title' => 'Sekilas DHS',
                'section_content' => array (
  'note' => 'Mencetak SDM pariwisata yang unggul, kompeten, dan siap bersaing di tingkat global.',
  'image' => '/image/about_dhs.jpg',
  'label' => 'SEKILAS DHS',
  'headline' => 'Transformasi Menuju Unggul.',
  'paragraph1' => 'Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.',
  'paragraph2' => 'Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar negeri.',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'vision',
                'section_title' => 'Visi & Misi',
                'section_content' => array (
  'misiItems' => 
  array (
    0 => 'Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.',
    1 => 'Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.',
    2 => 'Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.',
  ),
  'misiLabel' => 'MISI',
  'visiLabel' => 'VISI',
  'coreValues' => 
  array (
    0 => 
    array (
      'desc' => 'Membentuk insan pariwisata yang kompeten dan berdaya saing tinggi.',
      'icon' => 'verified',
      'title' => 'Integritas',
    ),
    1 => 
    array (
      'desc' => 'Menghasilkan lulusan yang sesuai kriteria dunia kerja masa depan.',
      'icon' => 'fact_check',
      'title' => 'Tanggung Jawab',
    ),
    2 => 
    array (
      'desc' => 'Berfokus pada penyediaan solusi dan kualitas pembelajaran terbaik.',
      'icon' => 'star',
      'title' => 'Kualitas',
    ),
    3 => 
    array (
      'desc' => 'Kesempatan kerja & belajar di Australia, Jerman & Asia Tenggara.',
      'icon' => 'public',
      'title' => 'Global Network',
    ),
  ),
  'vision_text' => 'Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.',
  'sectionTitle' => 'Standar Visioner.',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'contact',
                'section_title' => 'Kontak & Lokasi',
                'section_content' => array (
  'linktree' => 'https://linktr.ee/BiayaPendidikan_DHS',
  'denpasar_wa' => '+6281337644463',
  'google_maps' => 'https://maps.google.com/?q=Denpasar+Hotel+School',
  'klungkung_wa' => '+62 81 337 106480',
  'denpasar_email' => 'sahabat@dhs.or.id',
  'student_portal' => 'http://www.dhs.or.id/student',
  'google_maps_dir' => 'https://maps.google.com/?q=Denpasar+Hotel+School',
  'klungkung_phone' => '+0366 5582998',
  'denpasar_address' => 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali',
  'klungkung_address' => 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'campus',
                'section_title' => 'Kehidupan Kampus',
                'section_content' => array (
  'fotos' => 
  array (
    0 => 
    array (
      'alt' => 'Siswa dalam seragam',
      'src' => '/image/campus_students.jpg',
    ),
    1 => 
    array (
      'alt' => 'Lobby Hotel Bintang',
      'src' => '/image/hotel_lobby.jpg',
    ),
    2 => 
    array (
      'alt' => 'Praktikum Dapur Chef',
      'src' => '/image/culinary_students.jpg',
    ),
  ),
  'title' => 'Kehidupan & Lingkungan Kampus',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'academy',
                'section_title' => 'Akademi Unggulan',
                'section_content' => array (
  'cards' => 
  array (
    0 => 
    array (
      'desc' => 'Pendidikan luar negeri berpartner dengan TAFE Australia & The Hotel School, serta Ausbildung Jerman.',
      'link' => '/akademi?filter=internasional',
      'image' => '/image/international_program.jpg',
      'title' => 'Program Internasional',
    ),
    1 => 
    array (
      'desc' => 'Jurusan Culinary Arts, Perhotelan, & F&B Service dengan jaminan OJT hotel bintang 4 & 5.',
      'link' => '/akademi?filter=2-tahun',
      'image' => '/image/culinary_students.jpg',
      'title' => 'Vokasi 2 Tahun',
    ),
    2 => 
    array (
      'desc' => 'Program singkat 6 bulan kapal pesiar (Cook, Steward, Bartender) dengan bonus gratis paspor & seaman book.',
      'link' => '/akademi?filter=eksekutif',
      'image' => '/image/Kapal.jpg',
      'title' => 'Program Eksekutif',
    ),
  ),
  'label' => 'AKADEMI UNGGULAN',
  'headline' => 'Disiplin & Pelatihan Profesional Kami',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'facilities',
                'section_title' => 'Fasilitas Kelas Dunia',
                'section_content' => array (
  'items' => 
  array (
    0 => 
    array (
      'image' => '/image/culinary_students.jpg',
      'label' => 'DAPUR INDUSTRI',
    ),
    1 => 
    array (
      'image' => '/image/hotel_lobby.jpg',
      'label' => 'KAMAR SUITE SIMULASI',
    ),
    2 => 
    array (
      'image' => '/image/short_course.jpg',
      'label' => 'BAR PELATIHAN',
    ),
  ),
  'title' => 'FASILITAS KELAS DUNIA',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'director',
                'section_title' => 'Pesan Direktur',
                'section_content' => array (
  'name' => 'I Made Dwija Suastana, S.H., M.H.',
  'label' => 'PESAN DIREKTUR',
  'title' => 'DIREKTUR DENPASAR HOTEL SCHOOL — SALAM EXCELLENT!',
  'message' => 'Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten. Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global.',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'news',
                'section_title' => 'Berita & Artikel',
                'section_content' => array (
  'label' => 'WAWASAN',
  'title' => 'Berita & Artikel.',
  'featured' => 
  array (
    'date' => '12 SEP 2024',
    'title' => 'Kemitraan DHS dengan Kapal Pesiar Mewah 2026',
    'excerpt' => 'Denpasar Hotel School mengumumkan kemitraan eksklusif dengan tiga perusahaan kapal pesiar global...',
    'category' => 'KEGIATAN',
  ),
  'smallArticles' => 
  array (
    0 => 
    array (
      'date' => '25 AGU 2024',
      'title' => 'Masterclass Kuliner bersama Chef Michelin',
      'category' => 'LOKAKARYA',
    ),
    1 => 
    array (
      'date' => '15 AGU 2024',
      'title' => 'Lulusan Memimpin Resort Butik di Asia',
      'category' => 'KARIER',
    ),
    2 => 
    array (
      'date' => '05 AGU 2024',
      'title' => 'Inisiatif Kampus Hospitality Berkelanjutan',
      'category' => 'KEBERLANJUTAN',
    ),
  ),
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'partner',
                'section_title' => 'Partnership Program',
                'section_content' => array (
  'desc' => 'DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel bintang 4 & 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee).',
  'label' => 'Kemitraan & Jaringan Global',
  'title' => 'Partnership Program (PP DHS)',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'testimonial_header',
                'section_title' => NULL,
                'section_content' => array (
  'title' => 'Apa Kata Mereka',
  'overline' => 'TESTIMONI ALUMNI DAN MITRA',
  'subtitle' => 'Pengalaman nyata dari alumni dan mitra industri yang telah berkembang bersama DHS',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'contact_form',
                'section_title' => NULL,
                'section_content' => array (
  'title' => 'Kirim Pertanyaan',
  'subtitle' => 'Isi formulir pesan dikirim otomatis ke email resmi kami.',
  'button_text' => 'KIRIM VIA EMAIL',
  'recipient_email' => 'sahabat@dhs.or.id',
),
                'is_active' => true,
                'display_order' => 0,
            ],
            [
                'section_key' => 'layanan_form_settings',
                'section_title' => 'Editor Form Layanan Beasiswa & Dokumen',
                'section_content' => array (
  'fields' => 
  array (
    0 => 
    array (
      'note' => 'Pilih Beasiswa / Dokumen',
      'type' => 'select',
      'label' => 'Pilih Jenis Pengajuan Utama',
      'required' => true,
      'placeholder' => 'Pilih Beasiswa atau Dokumen',
    ),
    1 => 
    array (
      'type' => 'text',
      'label' => 'Nama Lengkap Pemohon',
      'required' => true,
      'placeholder' => 'Masukkan nama lengkap sesuai KTP / Ijazah',
    ),
    2 => 
    array (
      'type' => 'tel',
      'label' => 'HP / WA (WhatsApp Aktif)',
      'required' => true,
      'placeholder' => '08xxxxxxxxxx',
    ),
    3 => 
    array (
      'type' => 'email',
      'label' => 'Alamat Email',
      'required' => true,
      'placeholder' => 'alamat@email.com',
    ),
    4 => 
    array (
      'note' => 'Daftar menyesuaikan pilihan jenis pengajuan',
      'type' => 'select',
      'label' => 'Program Studi / Dokumen',
      'required' => true,
      'placeholder' => 'Pilih program atau jenis dokumen',
    ),
    5 => 
    array (
      'note' => 'Instruksi pengunggahan berkas ke cloud storage',
      'type' => 'url',
      'label' => 'Link Berkas Berkas (Google Drive / Cloud)',
      'required' => true,
      'placeholder' => 'https://drive.google.com/...',
    ),
    6 => 
    array (
      'type' => 'textarea',
      'label' => 'Motivasi / Catatan Pengajuan',
      'required' => false,
      'placeholder' => 'Tuliskan alasan atau catatan tambahan pengajuan Anda...',
    ),
  ),
  'badge_text' => 'PENGAJUAN ONLINE DHS',
  'hero_image' => '/image/hero_registration.jpg',
  'helpdesk_wa' => '+62 81 246 319966',
  'notice_text' => 'Unggah berkas kelengkapan Anda ke Google Drive dan cantumkan link publik pada formulir di bawah. Tim DHS akan segera memproses pengajuan Anda.',
  'header_title' => 'Formulir Pengajuan Beasiswa & Dokumen',
  'helpdesk_email' => 'sahabat@dhs.or.id',
  'helpdesk_hours' => 'Senin - Sabtu: 08:00 - 17:00 WITA',
  'dokumen_options' => 
  array (
    0 => 
    array (
      'key' => 'Passport',
      'name' => 'Passport (Paspor 48 Hal / Pelaut)',
      'issuer' => 'Ditjen Imigrasi & Dephub RI',
      'duration' => '7 – 14 hari kerja',
      'is_active' => true,
    ),
    1 => 
    array (
      'key' => 'BST',
      'name' => 'BST (Basic Safety Training)',
      'issuer' => 'STCW 2010 / Dephub RI',
      'duration' => '5 – 7 hari pelatihan',
      'is_active' => true,
    ),
    2 => 
    array (
      'key' => 'SDSD',
      'name' => 'SDSD (Security Duties on Ships)',
      'issuer' => 'ISPS Code & STCW VI/6',
      'duration' => '2 – 3 hari pelatihan',
      'is_active' => true,
    ),
    3 => 
    array (
      'key' => 'CCM',
      'name' => 'CCM (Crowd Control Management)',
      'issuer' => 'STCW V/2 (Passenger Ships)',
      'duration' => '2 – 3 hari pelatihan',
      'is_active' => true,
    ),
    4 => 
    array (
      'key' => 'SSAT',
      'name' => 'SSAT (Ship Security Awareness)',
      'issuer' => 'STCW VI/6',
      'duration' => '1 – 2 hari pelatihan',
      'is_active' => true,
    ),
    5 => 
    array (
      'key' => 'PSCRB',
      'name' => 'PSCRB (Proficiency in Survival Craft)',
      'issuer' => 'STCW VI/2',
      'duration' => '3 – 5 hari pelatihan',
      'is_active' => true,
    ),
    6 => 
    array (
      'key' => 'C1/D Visa',
      'name' => 'C1/D VISA (US Seaman Visa)',
      'issuer' => 'US Embassy Jakarta & Surabaya',
      'duration' => '3 – 6 minggu',
      'is_active' => true,
    ),
    7 => 
    array (
      'key' => 'Surat Keterangan Alumni',
      'name' => 'Surat Keterangan Alumni / Lulus',
      'issuer' => 'Akademik DHS',
      'duration' => '1 – 3 hari kerja',
      'is_active' => true,
    ),
    8 => 
    array (
      'key' => 'Transkrip Nilai',
      'name' => 'Transkrip Nilai Akademik',
      'issuer' => 'Akademik DHS',
      'duration' => '1 – 3 hari kerja',
      'is_active' => true,
    ),
    9 => 
    array (
      'key' => 'Surat Rekomendasi Kerja',
      'name' => 'Surat Rekomendasi Kerja / Magang',
      'issuer' => 'Admisi & Placement DHS',
      'duration' => '1 – 3 hari kerja',
      'is_active' => true,
    ),
    10 => 
    array (
      'key' => 'Legalisir Dokumen',
      'name' => 'Legalisir Dokumen DHS',
      'issuer' => 'Akademik DHS',
      'duration' => '1 – 2 hari kerja',
      'is_active' => true,
    ),
  ),
  'beasiswa_options' => 
  array (
    0 => 
    array (
      'key' => 'Beasiswa Prestasi',
      'desc' => 'Keringanan Biaya Pendidikan s/d 50%',
      'name' => 'Beasiswa Prestasi',
      'is_active' => true,
    ),
    1 => 
    array (
      'key' => 'Beasiswa STT / Desa',
      'desc' => 'Utusan Sekaa Teruna & Desa Adat Bali',
      'name' => 'Beasiswa STT / Desa',
      'is_active' => true,
    ),
    2 => 
    array (
      'key' => 'Beasiswa Khusus',
      'desc' => 'Keluarga Kurang Mampu / KIP',
      'name' => 'Beasiswa Khusus',
      'is_active' => true,
    ),
  ),
),
                'is_active' => true,
                'display_order' => 15,
            ],
        ];

        foreach ($sections as $item) {
            HomepageSection::updateOrCreate(
                ['section_key' => $item['section_key']],
                $item
            );
        }
    }
}
