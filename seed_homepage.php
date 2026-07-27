<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$sections = [
    'hero' => ['overline' => 'DENPASAR HOTEL SCHOOL', 'headline' => 'Membentuk Masa Depan Perhotelan Global', 'cta1_text' => 'JELAJAHI PROGRAM', 'cta1_link' => '/akademi', 'cta2_text' => 'DAFTAR SEKARANG', 'cta2_link' => '/cara-mendaftar', 'scroll_text' => 'Geser Untuk Scroll', 'background_image' => ''],
    'about' => ['label' => 'SEKILAS DHS', 'headline' => 'Transformasi Menuju Unggul.', 'paragraph1' => 'Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.', 'paragraph2' => 'Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar negeri.', 'note' => 'Mencetak SDM pariwisata yang unggul, kompeten, dan siap bersaing di tingkat global.', 'image' => ''],
    'vision' => ['sectionTitle' => 'Standar Visioner.', 'visiLabel' => 'VISI', 'vision_text' => 'Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.', 'misiLabel' => 'MISI', 'misiItems' => ['Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.', 'Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.', 'Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.'], 'coreValues' => [['icon' => 'verified', 'title' => 'Integritas', 'desc' => 'Membentuk insan pariwisata yang kompeten dan berdaya saing tinggi.'], ['icon' => 'fact_check', 'title' => 'Tanggung Jawab', 'desc' => 'Menghasilkan lulusan yang sesuai kriteria dunia kerja masa depan.'], ['icon' => 'star', 'title' => 'Kualitas', 'desc' => 'Berfokus pada penyediaan solusi dan kualitas pembelajaran terbaik.'], ['icon' => 'public', 'title' => 'Global Network', 'desc' => 'Kesempatan kerja dan belajar di Australia, Jerman dan Asia Tenggara.']]],
    'campus' => ['title' => 'Kehidupan dan Lingkungan Kampus', 'fotos' => [['src' => '', 'alt' => 'Foto 1'], ['src' => '', 'alt' => 'Foto 2'], ['src' => '', 'alt' => 'Foto 3']]],
    'academy' => ['label' => 'AKADEMI UNGGULAN', 'headline' => 'Disiplin dan Pelatihan Profesional Kami', 'cards' => [['title' => 'Program Internasional', 'desc' => 'Pendidikan luar negeri berpartner dengan TAFE Australia dan The Hotel School, serta Ausbildung Jerman.', 'image' => '', 'link' => '/akademi?filter=internasional'], ['title' => 'Vokasi 2 Tahun', 'desc' => 'Jurusan Culinary Arts, Perhotelan, dan FB Service dengan jaminan OJT hotel bintang 4 dan 5.', 'image' => '', 'link' => '/akademi?filter=2-tahun'], ['title' => 'Program Eksekutif', 'desc' => 'Program singkat 6 bulan kapal pesiar dengan bonus gratis paspor dan seaman book.', 'image' => '/image/Kapal.jpg', 'link' => '/akademi?filter=eksekutif']]],
    'facilities' => ['title' => 'FASILITAS KELAS DUNIA', 'items' => [['label' => 'DAPUR INDUSTRI', 'image' => ''], ['label' => 'KAMAR SUITE SIMULASI', 'image' => ''], ['label' => 'BAR PELATIHAN', 'image' => '']]],
    'director' => ['label' => 'PESAN DIREKTUR', 'message' => 'Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten.', 'name' => 'I Made Dwija Suastana, S.H., M.H.', 'title' => 'DIREKTUR DENPASAR HOTEL SCHOOL'],
    'news' => ['label' => 'WAWASAN', 'title' => 'Berita dan Artikel.', 'featured' => ['category' => 'KEGIATAN', 'date' => '12 SEP 2024', 'title' => 'Kemitraan DHS dengan Kapal Pesiar Mewah 2026', 'excerpt' => 'Denpasar Hotel School mengumumkan kemitraan eksklusif dengan tiga perusahaan kapal pesiar global.'], 'smallArticles' => [['category' => 'LOKAKARYA', 'date' => '25 AGU 2024', 'title' => 'Masterclass Kuliner bersama Chef Michelin'], ['category' => 'KARIER', 'date' => '15 AGU 2024', 'title' => 'Lulusan Memimpin Resort Butik di Asia'], ['category' => 'KEBERLANJUTAN', 'date' => '05 AGU 2024', 'title' => 'Inisiatif Kampus Hospitality Berkelanjutan']]],
    'partner' => ['label' => 'Kemitraan dan Jaringan Global', 'title' => 'Partnership Program (PP DHS)', 'desc' => 'DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global.'],
    'testimonial_header' => ['overline' => 'TESTIMONI ALUMNI DAN MITRA', 'title' => 'Apa Kata Mereka', 'subtitle' => 'Pengalaman nyata dari alumni dan mitra industri yang telah berkembang bersama DHS'],
    'contact_form' => ['title' => 'Kirim Pertanyaan', 'subtitle' => 'Isi formulir pesan dikirim otomatis ke email resmi kami.', 'recipient_email' => 'sahabat@dhs.or.id', 'button_text' => 'KIRIM VIA EMAIL'],
    'contact' => ['denpasar_address' => 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali', 'denpasar_wa' => '+62 81 246 319966', 'denpasar_email' => 'sahabat@dhs.or.id', 'klungkung_address' => 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali', 'klungkung_phone' => '+0366 5582998', 'klungkung_wa' => '+62 81 337 106480']
];

foreach ($sections as $key => $content) {
    DB::table('homepage_sections')->updateOrInsert(
        ['section_key' => $key],
        ['section_content' => json_encode($content), 'display_order' => 0]
    );
}

echo "✅ Database seeded successfully!\n";
