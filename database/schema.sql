-- =========================================================================
-- DATABASE SCHEMA LENGKAP - DENPASAR HOTEL SCHOOL (DHS)
-- =========================================================================
-- Generated: 2026-07-22
-- Engine: InnoDB
-- Charset: utf8mb4 (mendukung karakter Indonesia & emoji)
-- 
-- DAFTAR TABEL:
-- 1. users                    - Manajemen user admin backoffice
-- 2. homepage_sections         - Konten dynamic halaman beranda (hero, about, vision, dll)
-- 3. branding_settings         - Logo, warna, font DHS
-- 4. news_articles             - Berita & artikel wawasan
-- 5. program_categories        - Kategori program (Internasional, 2 Tahun, 1 Tahun, dll)
-- 6. programs                  - Detail program studi per kategori
-- 7. galleries                 - Galeri foto kampus
-- 8. testimonials              - Testimoni alumni & mitra
-- 9. faqs                      - Pertanyaan yang sering diajukan
-- 10. registrations            - Data pendaftar dari form pendaftaran online
-- 11. partners                 - Mitra industri & institusi
-- 12. media_files              - File media terpusat (gambar, dokumen, dll)
-- 13. admissions               - Data penerimaan mahasiswa baru
-- 14. statistics               - Statistik kampus (jumlah alumni, mitra, dll)
-- 15. navigation_menus         - Menu navigasi website (header & footer)
-- 16. footer_settings          - Pengaturan footer website
-- 17. activity_logs            - Log aktivitas admin backoffice
-- =========================================================================

-- 1. USERS (Manajemen Akun Admin Backoffice)
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) DEFAULT NULL,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) DEFAULT NULL,
    role ENUM('super_admin', 'admin', 'editor') DEFAULT 'editor',
    is_active TINYINT(1) DEFAULT 1,
    last_login_at DATETIME DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. HOMEPAGE_SECTIONS (Konten Dinamis Halaman Beranda)
CREATE TABLE IF NOT EXISTS homepage_sections (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    section_key VARCHAR(100) NOT NULL UNIQUE COMMENT 'Key unik: hero, about, vision, campus, academy, facilities, director, news, partners, contact',
    section_title VARCHAR(255) DEFAULT NULL,
    section_content JSON DEFAULT NULL COMMENT 'Data konten dalam format JSON (fleksibel per section)',
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_section_key (section_key),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. BRANDING_SETTINGS (Logo, Warna, Font DHS)
CREATE TABLE IF NOT EXISTS branding_settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE COMMENT 'Key: logo_primary, logo_favicon, color_primary, color_secondary, font_heading, font_body',
    setting_value TEXT DEFAULT NULL,
    setting_type ENUM('text', 'color', 'file', 'json') DEFAULT 'text',
    setting_group VARCHAR(50) DEFAULT 'general' COMMENT 'Group: logo, colors, typography',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_setting_key (setting_key),
    INDEX idx_setting_group (setting_group)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. NEWS_ARTICLES (Berita & Artikel)
CREATE TABLE IF NOT EXISTS news_articles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    category ENUM('prestasi', 'akademik', 'kegiatan', 'admisi', 'alumni', 'umum', 'partnership', 'kampus', 'keberlanjutan') DEFAULT 'umum',
    excerpt TEXT DEFAULT NULL,
    content LONGTEXT DEFAULT NULL,
    thumbnail_url VARCHAR(500) DEFAULT NULL,
    author_id BIGINT UNSIGNED DEFAULT NULL,
    status ENUM('draft', 'dipublikasikan', 'archived') DEFAULT 'draft',
    published_at DATETIME DEFAULT NULL,
    views_count INT UNSIGNED DEFAULT 0,
    is_featured TINYINT(1) DEFAULT 0 COMMENT '1 = Featured article di homepage',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_category (category),
    INDEX idx_status (status),
    INDEX idx_published_at (published_at),
    INDEX idx_is_featured (is_featured),
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. PROGRAM_CATEGORIES (Kategori Program Studi)
CREATE TABLE IF NOT EXISTS program_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_key VARCHAR(100) NOT NULL UNIQUE COMMENT 'internasional, 2-tahun, 1-tahun, 1-tahun-kapal-pesiar, 6-bulan, eksekutif',
    category_name VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    career_opportunities TEXT DEFAULT NULL COMMENT 'Peluang kerja lulusan',
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category_key (category_key),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. PROGRAMS (Detail Program Studi)
CREATE TABLE IF NOT EXISTS programs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    country_badge VARCHAR(100) DEFAULT NULL COMMENT 'Contoh: 🇩🇪 JERMAN, 🇦🇺 AUSTRALIA, 🇮🇩 INDONESIA',
    description TEXT DEFAULT NULL,
    duration VARCHAR(100) DEFAULT NULL COMMENT 'Contoh: 1 Tahun, 2 Tahun, 6 Bulan',
    requirements TEXT DEFAULT NULL COMMENT 'Persyaratan pendaftaran',
    curriculum LONGTEXT DEFAULT NULL COMMENT 'Detail kurikulum program',
    facilities TEXT DEFAULT NULL COMMENT 'Fasilitas program',
    thumbnail_url VARCHAR(500) DEFAULT NULL,
    brochure_url VARCHAR(500) DEFAULT NULL COMMENT 'URL file brosur PDF',
    tuition_fee DECIMAL(15,2) DEFAULT NULL COMMENT 'Biaya pendidikan',
    is_active TINYINT(1) DEFAULT 1,
    is_featured TINYINT(1) DEFAULT 0,
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_category_id (category_id),
    INDEX idx_is_active (is_active),
    INDEX idx_is_featured (is_featured),
    FOREIGN KEY (category_id) REFERENCES program_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. GALLERIES (Galeri Foto Kampus)
CREATE TABLE IF NOT EXISTS galleries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    image_url VARCHAR(500) NOT NULL,
    alt_text VARCHAR(255) DEFAULT NULL,
    category ENUM('kampus', 'kegiatan', 'fasilitas', 'alumnus', 'partnership', 'umum') DEFAULT 'umum',
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. TESTIMONIALS (Testimoni Alumni & Mitra)
CREATE TABLE IF NOT EXISTS testimonials (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) DEFAULT NULL COMMENT 'Jabatan/Angkatan: Alumni 2018 · F&B Manager',
    company VARCHAR(255) DEFAULT NULL COMMENT 'Nama perusahaan/hotel',
    quote TEXT NOT NULL COMMENT 'Kutipan testimoni',
    photo_url VARCHAR(500) DEFAULT NULL,
    rating TINYINT UNSIGNED DEFAULT 5 COMMENT 'Rating 1-5',
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_is_featured (is_featured),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. FAQS (Pertanyaan yang Sering Diajukan)
CREATE TABLE IF NOT EXISTS faqs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(500) NOT NULL,
    answer LONGTEXT NOT NULL,
    category ENUM('akademi', 'pendaftaran', 'biaya', 'kampus', 'umum') DEFAULT 'umum',
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. REGISTRATIONS (Data Pendaftar dari Form Pendaftaran Online)
CREATE TABLE IF NOT EXISTS registrations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    category_key VARCHAR(100) DEFAULT NULL COMMENT 'Kategori durasi: internasional, 2-tahun, dll',
    program_title VARCHAR(255) DEFAULT NULL COMMENT 'Nama program yang dipilih',
    special_request TEXT DEFAULT NULL,
    registration_fee_proof VARCHAR(500) DEFAULT NULL COMMENT 'URL bukti pembayaran pendaftaran',
    program_fee_proof VARCHAR(500) DEFAULT NULL COMMENT 'URL bukti pembayaran program',
    info_sources JSON DEFAULT NULL COMMENT 'Array sumber info: [Keluarga, Teman, Media Sosial, dll]',
    status ENUM('pending', 'verified', 'accepted', 'rejected', 'cancelled') DEFAULT 'pending',
    notes TEXT DEFAULT NULL COMMENT 'Catatan admin untuk pendaftar',
    registration_date DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_phone (phone),
    INDEX idx_status (status),
    INDEX idx_registration_date (registration_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. PARTNERS (Mitra Industri & Institusi)
CREATE TABLE IF NOT EXISTS partners (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    logo_url VARCHAR(500) DEFAULT NULL,
    partner_group VARCHAR(50) DEFAULT 'mitra_industri' COMMENT 'mitra_industri, partnership',
    type ENUM('hotel', 'restaurant', 'cruise', 'education', 'government', 'other') DEFAULT 'other',
    description TEXT DEFAULT NULL,
    website_url VARCHAR(500) DEFAULT NULL,
    country VARCHAR(100) DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    is_featured TINYINT(1) DEFAULT 0 COMMENT 'Tampil di marquee homepage',
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_partner_group (partner_group),
    INDEX idx_is_featured (is_featured),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. MEDIA_FILES (File Media Terpusat)
CREATE TABLE IF NOT EXISTS media_files (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_type VARCHAR(50) NOT NULL COMMENT 'image, document, video, audio',
    mime_type VARCHAR(100) DEFAULT NULL,
    file_size INT UNSIGNED DEFAULT NULL COMMENT 'Ukuran file dalam bytes',
    uploaded_by BIGINT UNSIGNED DEFAULT NULL,
    usage_context VARCHAR(100) DEFAULT NULL COMMENT 'Digunakan di: news, gallery, branding, program',
    alt_text VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_file_type (file_type),
    INDEX idx_usage_context (usage_context),
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 13. ADMISSIONS (Data Penerimaan Mahasiswa Baru)
CREATE TABLE IF NOT EXISTS admissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    registration_id BIGINT UNSIGNED DEFAULT NULL COMMENT 'Link ke pendaftar di tabel registrations',
    student_name VARCHAR(255) NOT NULL,
    student_id VARCHAR(50) UNIQUE DEFAULT NULL COMMENT 'NIM/Student ID',
    program_id BIGINT UNSIGNED DEFAULT NULL,
    admission_year YEAR NOT NULL,
    admission_semester ENUM('ganjil', 'genap') DEFAULT 'ganjil',
    status ENUM('active', 'graduated', 'dropout', 'transferred', 'suspended') DEFAULT 'active',
    graduation_date DATE DEFAULT NULL,
    notes TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_student_id (student_id),
    INDEX idx_admission_year (admission_year),
    INDEX idx_status (status),
    FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE SET NULL,
    FOREIGN KEY (program_id) REFERENCES programs(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 14. STATISTICS (Statistik Kampus)
CREATE TABLE IF NOT EXISTS statistics (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    stat_key VARCHAR(100) NOT NULL UNIQUE COMMENT 'Key: total_alumni, total_students, total_partners, years_established, success_rate',
    stat_value VARCHAR(255) NOT NULL,
    stat_label VARCHAR(255) DEFAULT NULL COMMENT 'Label tampilan: YEARS OF HERITAGE, SUCCESSFUL ALUMNI',
    stat_icon VARCHAR(100) DEFAULT NULL COMMENT 'Material icon name',
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_stat_key (stat_key),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 15. NAVIGATION_MENUS (Menu Navigasi Website)
CREATE TABLE IF NOT EXISTS navigation_menus (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    parent_id BIGINT UNSIGNED DEFAULT NULL COMMENT 'Untuk submenu, isi dengan ID parent menu',
    menu_label VARCHAR(255) NOT NULL,
    menu_url VARCHAR(500) DEFAULT NULL,
    menu_type ENUM('header', 'footer', 'both') DEFAULT 'header',
    target_blank TINYINT(1) DEFAULT 0 COMMENT '1 = Buka di tab baru',
    icon_class VARCHAR(100) DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_parent_id (parent_id),
    INDEX idx_menu_type (menu_type),
    INDEX idx_display_order (display_order),
    FOREIGN KEY (parent_id) REFERENCES navigation_menus(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 16. FOOTER_SETTINGS (Pengaturan Footer Website)
CREATE TABLE IF NOT EXISTS footer_settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE COMMENT 'Key: address_denpasar, address_klungkung, phone, email, social_media',
    setting_value TEXT DEFAULT NULL,
    setting_group VARCHAR(50) DEFAULT 'contact' COMMENT 'Group: contact, social, links',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_setting_key (setting_key),
    INDEX idx_setting_group (setting_group)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 17. ACTIVITY_LOGS (Log Aktivitas Admin Backoffice)
CREATE TABLE IF NOT EXISTS activity_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED DEFAULT NULL,
    action VARCHAR(255) NOT NULL COMMENT 'create, update, delete, login, logout',
    table_name VARCHAR(100) DEFAULT NULL COMMENT 'Nama tabel yang diubah',
    record_id BIGINT UNSIGNED DEFAULT NULL COMMENT 'ID record yang diubah',
    old_data JSON DEFAULT NULL COMMENT 'Data lama sebelum diubah',
    new_data JSON DEFAULT NULL COMMENT 'Data baru setelah diubah',
    ip_address VARCHAR(50) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_table_name (table_name),
    INDEX idx_created_at (created_at),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================================
-- SEEDING DATA DUMMY (untuk keperluan testing frontend & backoffice)
-- =========================================================================

-- SEED: users (Admin Backoffice)
-- Username: denpasarhotelschool | Password: indoapps2026
-- Username: editor              | Password: password
INSERT IGNORE INTO users (name, username, email, password, role) VALUES
('Super Admin DHS', 'denpasarhotelschool', 'admin@dhs.or.id', '$2y$10$434jurd5Whrg1gJ.6Cst4uuX6eHIENwwXahECQURV6Zkw8A45Xxm.', 'super_admin'),
('Editor Konten', 'editor', 'editor@dhs.or.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editor');

-- SEED: branding_settings (Logo, Warna, Font)
INSERT IGNORE INTO branding_settings (setting_key, setting_value, setting_type, setting_group) VALUES
('logo_primary', '/image/LogoDHS.png', 'file', 'logo'),
('logo_favicon', '/favicon.ico', 'file', 'logo'),
('color_primary', '#0010B8', 'color', 'colors'),
('color_secondary', '#D62828', 'color', 'colors'),
('color_navy', '#2B2494', 'color', 'colors'),
('color_cream', '#F6F2EA', 'color', 'colors'),
('color_beige', '#EFE7D8', 'color', 'colors'),
('font_heading', 'Playfair Display, serif', 'text', 'typography'),
('font_body', 'Inter, sans-serif', 'text', 'typography');

-- SEED: homepage_sections (Konten Homepage)
INSERT IGNORE INTO homepage_sections (section_key, section_title, section_content, display_order) VALUES
('hero', 'Hero Section', '{"overline": "DENPASAR HOTEL SCHOOL — PUSAT PELATIHAN VOKASI INTERNASIONAL DI BALI", "headline": "Membentuk Masa Depan Perhotelan Global", "cta1_text": "JELAJAHI PROGRAM", "cta1_link": "/akademi", "cta2_text": "DAFTAR SEKARANG", "cta2_link": "/cara-mendaftar", "background_image": "https://example.com/hero.jpg"}', 1),
('about', 'Sekilas DHS', '{"label": "SEKILAS DHS", "headline": "Transformasi Menuju Unggul.", "paragraph1": "Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri.", "paragraph2": "Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar negeri."}', 2),
('vision', 'Visi & Misi', '{"section_title": "Standar Visioner.", "vision_text": "Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.", "mission_items": ["Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.", "Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.", "Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara."]}', 3),
('contact', 'Kontak & Lokasi', '{"denpasar_address": "Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali", "denpasar_wa": "+62 81 246 319966", "denpasar_email": "sahabat@dhs.or.id", "klungkung_address": "Jl. Raya Takmung No. 36, Klungkung 80752, Bali", "klungkung_phone": "+0366 5582998", "klungkung_wa": "+62 81 337 106480"}', 10);

-- SEED: program_categories (Kategori Program)
INSERT IGNORE INTO program_categories (category_key, category_name, subtitle, description, career_opportunities, display_order) VALUES
('internasional', 'Program Internasional', 'GLOBAL OPPORTUNITY', 'DHS bekerjasama dengan The Hotel School Melbourne & Sydney dan TAFE Australia untuk menyalurkan peserta didik DHS yang berminat lanjut untuk melaksanakan pendidikan di luar negeri.', 'Hotel Staff, Restaurant Staff, Instruktur LKP/LPK, Wirausaha', 1),
('2-tahun', 'Vokasi 2 Tahun', 'PROGRAM VOKASI', 'Memiliki jurusan FB Service Bartender, Perhotelan dan Culinary Arts dengan jaminan OJT di Hotel Bintang 4 & 5.', 'Hotel Staff, Restaurant Staff, Barista, Chef/Cook, Entrepreneur', 2),
('1-tahun', 'Vokasi 1 Tahun', 'PROGRAM VOKASI', 'Dirancang untuk persiapan kilat memasuki industri perhotelan bintang 4 & 5 serta kapal pesiar.', 'Hotel Staff, Restaurant Staff, Barista, Assistant Cook, Entrepreneur', 3),
('1-tahun-kapal-pesiar', '1 Tahun Kapal Pesiar', 'PROGRAM KAPAL PESIAR', 'Program akselerasi 1 tahun yang difokuskan untuk persiapan bekerja secara profesional di departemen F&B dan housekeeping kapal pesiar.', 'Cruise Ship Cook, Waiter/Waitress, Cabin Steward, Galley Utility', 4),
('6-bulan', 'Short Course 6 Bulan', 'KURSUS SINGKAT', 'Program singkat diperuntukan untuk peserta didik yang berniat menambah ilmu di bidang spesifik dengan mengutamakan praktek langsung.', 'Entry-level Hotel Staff, Barista, Commis Chef, Restaurant Server', 5),
('eksekutif', 'Program Eksekutif (6 Bln)', 'PROGRAM EKSEKUTIF', 'Program khusus 6 bulan kapal pesiar dengan berbagai fasilitas bonus menarik untuk akselerasi karir maritim instan.', 'Cruise Line Cook, Cruise Line Bartender, Butler, Spa Therapist', 6);

-- SEED: programs (Detail Program per Kategori)
INSERT IGNORE INTO programs (category_id, title, slug, country_badge, description, duration, thumbnail_url, display_order) VALUES
(1, 'Program 1 Tahun + Ausbildung Jerman', 'program-1-tahun-ausbildung-jerman', '🇩🇪 JERMAN', 'Pelatihan intensif 1 tahun di kampus dilanjutkan program penempatan Ausbildung kerja di Jerman.', '1 Tahun + Ausbildung', 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b', 1),
(1, 'Program 2 Tahun + 1 Semester TAFE Australia', 'program-2-tahun-1-semester-tafe-australia', '🇦🇺 AUSTRALIA', 'Studi komprehensif di Bali dengan transfer kredit 1 semester di TAFE Australia.', '2 Tahun + 1 Semester', 'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be', 2),
(1, 'TAFE Australia Pathway', 'tafe-australia-pathway', '🇦🇺 AUSTRALIA', 'Program penyaluran langsung menuju perkuliahan TAFE di Australia.', 'Pathway Program', 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9', 3),
(1, 'THS Australia Pathway', 'ths-australia-pathway', '🇦🇺 AUSTRALIA', 'Jalur studi khusus berpartner dengan The Hotel School Sydney & Melbourne.', 'Pathway Program', 'https://images.unsplash.com/photo-1566073771259-6a8506099945', 4),
(2, 'Perhotelan (FO & HK) — 2 Tahun', 'perhotelan-fo-hk-2-tahun', '2 TAHUN', 'Fokus pada operasional Front Office dan Housekeeping berstandar hotel bintang 5.', '2 Tahun', 'https://images.pexels.com/photos/5371676/pexels-photo-5371676.jpeg', 1),
(2, 'Tata Boga (Culinary Art) — 2 Tahun', 'tata-boga-culinary-art-2-tahun', '2 TAHUN', 'Mengembangkan keahlian memasak masakan internasional dan lokal dengan standar kebersihan tinggi.', '2 Tahun', 'https://images.pexels.com/photos/15323383/pexels-photo-15323383.jpeg', 2),
(2, 'Tata Hidangan (FBS & Bartender) — 2 Tahun', 'tata-hidangan-fbs-bartender-2-tahun', '2 TAHUN', 'Seni pelayanan makanan, minuman, mixology, dan hospitality service terapan.', '2 Tahun', 'https://images.pexels.com/photos/4485382/pexels-photo-4485382.jpeg', 3),
(3, 'Perhotelan (FO & HK) — 1 Tahun', 'perhotelan-fo-hk-1-tahun', '1 TAHUN', 'Teori terfokus dan penempatan praktis di Front Office & Housekeeping.', '1 Tahun', 'https://images.pexels.com/photos/5371676/pexels-photo-5371676.jpeg', 1),
(3, 'Tata Boga (Culinary Art) — 1 Tahun', 'tata-boga-culinary-art-1-tahun', '1 TAHUN', 'Fondasi dasar teknik kuliner, penanganan bahan makanan, dan sanitasi.', '1 Tahun', 'https://images.pexels.com/photos/15323383/pexels-photo-15323383.jpeg', 2),
(4, 'Cook (Asisten Koki) — Kapal Pesiar', 'cook-asisten-koki-kapal-pesiar', 'KAPAL PESIAR', 'Praktek dapur intensif untuk menyiapkan menu cruise line internasional.', '1 Tahun', 'https://images.pexels.com/photos/16140004/pexels-photo-16140004.jpeg', 1),
(4, 'Waiter & Bartender — Kapal Pesiar', 'waiter-bartender-kapal-pesiar', 'KAPAL PESIAR', 'Layanan restoran mewah & pencampuran minuman tingkat lanjut untuk bar kapal pesiar.', '1 Tahun', 'https://images.pexels.com/photos/19300593/pexels-photo-19300593.jpeg', 2),
(4, 'Hotel Steward — Kapal Pesiar', 'hotel-steward-kapal-pesiar', 'KAPAL PESIAR', 'Manajemen kebersihan, tata graha, dan penataan kamar di kabin kapal pesiar mewah.', '1 Tahun', 'https://images.pexels.com/photos/6466213/pexels-photo-6466213.jpeg', 3),
(6, 'FBS & Bar (Cruise Line)', 'fbs-bar-cruise-line', 'EKSEKUTIF', 'Bonus: Free Bottle Shaker Flair untuk praktek atraksi bar.', '6 Bulan', 'https://images.pexels.com/photos/19674104/pexels-photo-19674104.jpeg', 1),
(6, 'Cook (Cruise Line)', 'cook-cruise-line', 'EKSEKUTIF', 'Bonus: Free Passport & Seaman Book (Buku Pelaut) resmi.', '6 Bulan', '/image/Kapal.jpg', 2),
(6, 'Butler', 'butler-eksekutif', 'EKSEKUTIF', 'Pelayanan eksklusif personal. Bonus: Free Driving Licence (SIM).', '6 Bulan', 'https://images.pexels.com/photos/5371583/pexels-photo-5371583.jpeg', 3),
(6, 'SPA Therapist', 'spa-therapist-eksekutif', 'EKSEKUTIF', 'Seni pijat relaksasi dan terapi spa berkualitas hotel bintang lima.', '6 Bulan', 'https://images.pexels.com/photos/9146364/pexels-photo-9146364.jpeg', 4);

-- SEED: news_articles (Berita & Artikel)
INSERT IGNORE INTO news_articles (title, slug, category, excerpt, content, thumbnail_url, author_id, status, published_at, is_featured) VALUES
('Kemitraan DHS dengan Kapal Pesiar Mewah 2026', 'kemitraan-dhs-dengan-kapal-pesiar-mewah-2026', 'partnership', 'Denpasar Hotel School mengumumkan kemitraan eksklusif dengan tiga perusahaan kapal pesiar global.', 'Denpasar Hotel School announces an exclusive partnership with three global cruise lines. This collaboration will provide outstanding access for our best students to intern on luxury ships, upgrading marine hospitality training standards...', 'https://example.com/news1.jpg', 1, 'dipublikasikan', '2024-09-12 10:00:00', 1),
('Masterclass Kuliner bersama Chef Michelin', 'masterclass-kuliner-bersama-chef-michelin', 'kegiatan', 'Menjelajahi teknik gastronomi modern yang dipandu oleh pakar kuliner bertaraf internasional.', 'Exploring modern gastronomy techniques guided by international-level culinary experts.', 'https://example.com/news2.jpg', 1, 'dipublikasikan', '2024-08-25 08:00:00', 0),
('Alumni Memimpin Boutique Resort di Asia', 'alumni-memimpin-boutique-resort-di-asia', 'alumni', 'Kisah sukses alumni DHS yang membentuk masa depan akomodasi butik eksklusif di seluruh kawasan Asia.', 'Success stories of DHS graduates shaping the future of exclusive boutique accommodations across Asia.', 'https://example.com/news3.jpg', 1, 'dipublikasikan', '2024-08-15 09:00:00', 0),
('Inisiatif Kampus Hospitality Berkelanjutan', 'inisiatif-kampus-hospitality-berkelanjutan', 'keberlanjutan', 'Menerapkan praktik ramah lingkungan inovatif di fasilitas pelatihan kami untuk mempersiapkan siswa menghadapi green hospitality.', 'Implementing innovative eco-friendly practices in our training facilities to prepare students for green hospitality.', 'https://example.com/news4.jpg', 1, 'dipublikasikan', '2024-08-05 07:00:00', 0),
('DHS Raih Akreditasi A dari BAN-SM', 'dhs-raih-akreditasi-a-dari-ban-sm', 'prestasi', 'Denpasar Hotel School secara resmi meraih akreditasi A dari Badan Akreditasi Nasional.', 'Pencapaian ini merupakan bukti komitmen DHS dalam menjaga kualitas pendidikan hospitality di Indonesia.', 'https://example.com/news5.jpg', 1, 'dipublikasikan', '2026-07-20 06:00:00', 0);

-- SEED: galleries (Galeri Foto)
INSERT IGNORE INTO galleries (title, description, image_url, alt_text, category, display_order) VALUES
('Siswa DHS dalam Seragam', 'Mahasiswa DHS siap untuk praktikum industri', 'https://example.com/gallery1.jpg', 'Students in uniform', 'kampus', 1),
('Kolam Resort Simulasi', 'Fasilitas kolam resort untuk praktik housekeeping', 'https://example.com/gallery2.jpg', 'Resort Pool', 'fasilitas', 2),
('Praktikum Dapur Chef', 'Mahasiswa culinary arts sedang praktikum di dapur industri', 'https://example.com/gallery3.jpg', 'Chefs cooking', 'kegiatan', 3),
('Dapur Industri Modern', 'Fasilitas dapur berstandar internasional', 'https://example.com/gallery4.jpg', 'Industry Kitchen', 'fasilitas', 4),
('Training Bar & Restaurant', 'Fasilitas training bar dan restaurant untuk program F&B Service', 'https://example.com/gallery5.jpg', 'Training Bar', 'fasilitas', 5);

-- SEED: testimonials (Testimoni Alumni)
INSERT IGNORE INTO testimonials (name, position, company, quote, photo_url, rating, is_featured, display_order) VALUES
('I Wayan Sudana', 'Alumni 2015 · F&B Manager', 'Intercontinental Bali', 'DHS memberikan fondasi yang luar biasa. Saya mendapat pekerjaan impian hanya 2 bulan setelah lulus.', NULL, 5, 1, 1),
('Ni Luh Ayu Dewi', 'Alumni 2018 · Guest Relations', 'Ritz-Carlton Bali', 'Instruktur di DHS adalah profesional industri yang mengerti kebutuhan dunia kerja nyata.', NULL, 5, 1, 2),
('I Made Agus Pranata', 'Alumni 2020 · Chef de Partie', 'Alila Seminyak', 'Program Culinary Arts di DHS sangat komprehensif. Saya siap bekerja sejak hari pertama.', NULL, 5, 0, 3),
('Komang Rai Saputra', 'Alumni 2019 · Cruise Ship Waiter', 'Royal Caribbean', 'Berkat DHS, saya bisa bekerja di kapal pesiar internasional dan mengunjungi 30+ negara.', NULL, 5, 1, 4);

-- SEED: faqs (Pertanyaan yang Sering Diajukan)
INSERT IGNORE INTO faqs (question, answer, category, display_order) VALUES
('Berapa lama durasi tiap program studi di DHS?', 'Durasi program studi di Denpasar Hotel School bervariasi. Program Diploma 1 berdurasi 1 tahun, Diploma 3 berdurasi 3 tahun, dan Diploma 4 (Sarjana Terapan) berdurasi 4 tahun. Setiap program mencakup masa perkuliahan teori, praktik di laboratorium kampus, dan program magang (On the Job Training) di industri perhotelan.', 'akademi', 1),
('Apakah kurikulum DHS berstandar internasional?', 'Ya, kurikulum kami dirancang dengan memadukan standar kompetensi nasional (SKKNI) dan standar internasional industri perhotelan. Kami juga bekerja sama dengan berbagai jaringan hotel global untuk memastikan materi yang diajarkan relevan dengan kebutuhan industri saat ini.', 'akademi', 2),
('Apa saja program studi yang tersedia di DHS?', 'DHS menawarkan tiga program utama: Culinary Arts (seni kuliner), Hospitality Management (manajemen perhotelan), dan Food & Beverage Service. Setiap program dirancang dengan rasio praktik tinggi untuk memastikan kesiapan kerja lulusan.', 'akademi', 3),
('Apa saja syarat pendaftaran mahasiswa baru?', 'Syarat pendaftaran: 1) Lulusan SMA/SMK/MA sederajat dari semua jurusan, 2) Mengisi formulir pendaftaran online, 3) Menyerahkan fotokopi ijazah, SKHUN, dan transkrip nilai yang dilegalisir, 4) Pas foto terbaru ukuran 3x4 dan 4x6 (masing-masing 2 lembar), 5) Lulus ujian saringan masuk (Tes Potensi Akademik dan Wawancara).', 'pendaftaran', 1),
('Apakah ada beasiswa yang tersedia?', 'DHS menyediakan beberapa jalur beasiswa, antara lain Beasiswa Prestasi Akademik, Beasiswa Prestasi Non-Akademik (olahraga/seni), dan Beasiswa Kemitraan Industri. Informasi lengkap mengenai persyaratan dan jadwal pengajuan beasiswa dapat dilihat pada halaman Beasiswa atau menghubungi tim admisi kami.', 'pendaftaran', 2),
('Kapan periode pendaftaran dibuka?', 'Pendaftaran mahasiswa baru DHS dibuka setiap tahun mulai bulan Maret hingga Juli untuk penerimaan tahun ajaran baru di bulan September. Pendaftaran dilakukan secara online melalui portal resmi DHS.', 'pendaftaran', 3),
('Berapa biaya kuliah di DHS?', 'Biaya pendidikan di DHS bervariasi tergantung program yang dipilih. Untuk informasi lengkap mengenai struktur biaya, silakan mengunduh brosur biaya terbaru atau hubungi tim admisi kami. Kami juga menawarkan skema cicilan yang fleksibel.', 'biaya', 1),
('Apakah biaya kuliner/seragam sudah termasuk dalam biaya kuliah?', 'Biaya seragam dan peralatan praktik (termasuk perlengkapan dapur untuk program Culinary) dikenakan terpisah pada saat registrasi ulang. Detail biaya ini akan diinformasikan pada saat dinyatakan lulus seleksi.', 'biaya', 2),
('Apakah DHS menyediakan fasilitas asrama mahasiswa?', 'Ya, kami merekomendasikan beberapa fasilitas akomodasi yang dikelola oleh mitra kami yang berlokasi dekat dengan kampus. Fasilitas ini dirancang nyaman, aman, dan mendukung lingkungan belajar mahasiswa. Hubungi layanan mahasiswa kami untuk bantuan penempatan akomodasi.', 'kampus', 1),
('Kegiatan apa saja yang tersedia di luar jam kuliah?', 'DHS memiliki berbagai kegiatan kemahasiswaan seperti komunitas memasak, klub barista, himpunan mahasiswa jurusan, dan kompetisi keterampilan reguler. Kami juga mengadakan kunjungan industri ke hotel dan resort terkemuka secara rutin.', 'kampus', 2);

-- SEED: partners (Mitra Industri)
INSERT IGNORE INTO partners (name, logo_url, type, description, country, is_featured, display_order) VALUES
('TAFE Australia', NULL, 'education', 'Technical and Further Education - Australia', 'Australia', 1, 1),
('The Hotel School', NULL, 'education', 'The Hotel School Melbourne & Sydney', 'Australia', 1, 2),
('Ausbildung', NULL, 'education', 'Vocational Education Germany', 'Germany', 1, 3),
('Marriott International', NULL, 'hotel', 'Global Hotel Chain', 'Global', 1, 4),
('Four Points by Sheraton', NULL, 'hotel', 'Ungasan Bali', 'Indonesia', 1, 5),
('Intercontinental Bali', NULL, 'hotel', 'Luxury Resort Bali', 'Indonesia', 1, 6),
('Ritz-Carlton Bali', NULL, 'hotel', '5-Star Luxury Hotel', 'Indonesia', 1, 7),
('NEO by Aston', NULL, 'hotel', 'Hotel Chain Indonesia', 'Indonesia', 1, 8),
('Amnaya Resort Bali', NULL, 'hotel', 'Resort Bali', 'Indonesia', 1, 9),
('COMO Uma Canggu', NULL, 'hotel', 'Boutique Resort', 'Indonesia', 1, 10);

-- SEED: statistics (Statistik Kampus)
INSERT IGNORE INTO statistics (stat_key, stat_value, stat_label, stat_icon, display_order) VALUES
('years_established', '18+', 'YEARS OF HERITAGE', 'calendar_today', 1),
('total_alumni', '3000+', 'SUCCESSFUL ALUMNI', 'school', 2),
('total_partners', '120+', 'INDUSTRY PARTNERS', 'handshake', 3),
('placement_rate', '95%', 'JOB PLACEMENT RATE', 'trending_up', 4),
('countries_reached', '20+', 'COUNTRIES WORLDWIDE', 'public', 5);

-- SEED: navigation_menus (Menu Navigasi)
INSERT IGNORE INTO navigation_menus (parent_id, menu_label, menu_url, menu_type, display_order) VALUES
(NULL, 'Beranda', '/', 'both', 1),
(NULL, 'Tentang Kami', '/tentang', 'both', 2),
(NULL, 'Akademi', '/akademi', 'both', 3),
(NULL, 'Berita', '/berita', 'both', 4),
(NULL, 'FAQ', '/faq', 'both', 5),
(NULL, 'Karier', '/karier', 'both', 6),
(NULL, 'Pendaftaran', '/cara-mendaftar', 'header', 7);

-- SEED: footer_settings (Pengaturan Footer)
INSERT IGNORE INTO footer_settings (setting_key, setting_value, setting_group) VALUES
('address_denpasar', 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali', 'contact'),
('phone_denpasar', '+62 81 246 319966', 'contact'),
('email_denpasar', 'sahabat@dhs.or.id', 'contact'),
('address_klungkung', 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali', 'contact'),
('phone_klungkung', '+0366 5582998', 'contact'),
('wa_klungkung', '+62 81 337 106480', 'contact'),
('linktree_url', 'https://linktr.ee/BiayaPendidikan_DHS', 'links'),
('student_portal_url', 'http://www.dhs.or.id/student', 'links'),
('google_maps_url', 'https://maps.google.com/?q=Denpasar+Hotel+School', 'links'),
('facebook_url', 'https://facebook.com/dhsofficial', 'social'),
('instagram_url', 'https://instagram.com/dhsofficial', 'social'),
('youtube_url', 'https://youtube.com/@dhsofficial', 'social');

-- SEED: registrations (Contoh Data Pendaftar)
INSERT IGNORE INTO registrations (full_name, phone, email, category_key, program_title, special_request, info_sources, status, registration_date) VALUES
('I Made Surya Pratama', '081234567890', 'surya.pratama@email.com', 'internasional', 'Program 1 Tahun + Ausbildung Jerman', 'Saya ingin konsultasi lebih lanjut mengenai persyaratan visa Jerman.', '["Media Sosial", "Teman"]', 'pending', '2026-07-20'),
('Ni Kadek Ayu Lestari', '081298765432', 'ayu.lestari@email.com', '2-tahun', 'Tata Boga (Culinary Art) — 2 Tahun', 'Mohon info beasiswa prestasi akademik.', '["Pameran Pendidikan", "Lembaga Tempat Belajar atau Kerja"]', 'verified', '2026-07-18'),
('I Putu Bagus Wijaya', '081256784321', 'bagus.wijaya@email.com', 'eksekutif', 'Cook (Cruise Line)', NULL, '["Keluarga", "Situs Denpasar Hotel School"]', 'accepted', '2026-07-15'),
('Ni Nyoman Sari Dewi', '081287654321', 'sari.dewi@email.com', '1-tahun-kapal-pesiar', 'Waiter & Bartender — Kapal Pesiar', 'Apakah program ini sudah termasuk biaya pembuatan seaman book?', '["Media Sosial"]', 'pending', '2026-07-12');

-- SEED: admissions (Contoh Data Mahasiswa yang Sudah Diterima)
INSERT IGNORE INTO admissions (registration_id, student_name, student_id, program_id, admission_year, admission_semester, status) VALUES
(3, 'I Putu Bagus Wijaya', 'DHS2026001', 14, 2026, 'ganjil', 'active'),
(NULL, 'I Ketut Gede Darma', 'DHS2025012', 5, 2025, 'ganjil', 'active'),
(NULL, 'Ni Made Ari Wulandari', 'DHS2024056', 6, 2024, 'ganjil', 'active'),
(NULL, 'I Komang Adi Putra', 'DHS2023089', 2, 2023, 'ganjil', 'graduated'),
(NULL, 'Ni Luh Putu Sari', 'DHS2023045', 5, 2023, 'ganjil', 'graduated');

-- SEED: media_files (Contoh File Media)
INSERT IGNORE INTO media_files (file_name, file_path, file_type, mime_type, file_size, uploaded_by, usage_context, alt_text) VALUES
('logo-dhs-primary.png', '/storage/branding/logo-dhs-primary.png', 'image', 'image/png', 45620, 1, 'branding', 'Logo DHS Utama'),
('hero-background.jpg', '/storage/homepage/hero-background.jpg', 'image', 'image/jpeg', 1250000, 1, 'homepage', 'Hero Background Image'),
('news-thumbnail-1.jpg', '/storage/news/news-thumbnail-1.jpg', 'image', 'image/jpeg', 320000, 1, 'news', 'Thumbnail Berita Kemitraan DHS'),
('program-culinary.jpg', '/storage/programs/program-culinary.jpg', 'image', 'image/jpeg', 280000, 1, 'program', 'Thumbnail Program Culinary Arts'),
('gallery-kampus-1.jpg', '/storage/galleries/gallery-kampus-1.jpg', 'image', 'image/jpeg', 450000, 1, 'gallery', 'Foto Kampus DHS Denpasar');

-- SEED: activity_logs (Contoh Log Aktivitas Admin)
INSERT IGNORE INTO activity_logs (user_id, action, table_name, record_id, ip_address, user_agent) VALUES
(1, 'login', NULL, NULL, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'create', 'news_articles', 1, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'update', 'programs', 5, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'login', NULL, NULL, '192.168.1.105', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36'),
(2, 'create', 'galleries', 3, '192.168.1.105', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36');

-- =========================================================================
-- MIGRATION LARAVEL (Opsional - Jika Ingin Menggunakan Laravel Migration)
-- =========================================================================
-- File schema.sql ini sudah lengkap dan bisa langsung diimport ke MySQL.
-- Namun, untuk integrasi dengan Laravel, Anda bisa membuat migration files
-- yang sesuai dengan struktur tabel di atas.
--
-- Cara import manual:
-- 1. Buka phpMyAdmin atau MySQL CLI
-- 2. Pilih database DHS (atau buat dulu: CREATE DATABASE dhs_db;)
-- 3. Import file ini: mysql -u root -p dhs_db < schema.sql
--
-- Atau via Laravel:
-- php artisan migrate (setelah membuat migration files dari schema ini)
-- =========================================================================

-- =========================================================================
-- ADDITIONAL NOTES & RECOMMENDATIONS
-- =========================================================================

-- BEST PRACTICES YANG SUDAH DITERAPKAN:
-- ✓ Engine InnoDB untuk semua tabel (mendukung foreign keys & transactions)
-- ✓ Charset utf8mb4_unicode_ci (mendukung karakter Indonesia & emoji)
-- ✓ Primary key BIGINT UNSIGNED AUTO_INCREMENT di semua tabel
-- ✓ Kolom created_at & updated_at dengan DEFAULT CURRENT_TIMESTAMP
-- ✓ Foreign keys dengan constraint yang jelas (ON DELETE CASCADE/SET NULL sesuai konteks)
-- ✓ Index di kolom yang sering digunakan untuk filter/search/sort
-- ✓ Naming convention snake_case & tabel bentuk jamak
-- ✓ ENUM untuk kolom dengan nilai terbatas & terstruktur
-- ✓ JSON column untuk data fleksibel (homepage_sections, info_sources)
-- ✓ Tabel media_files terpusat untuk manajemen file
-- ✓ Tabel activity_logs untuk audit trail

-- REKOMENDASI PENGEMBANGAN LEBIH LANJUT:
-- 1. Tambahkan tabel 'scholarships' jika program beasiswa perlu dikelola lebih detail
-- 2. Tambahkan tabel 'events' untuk manajemen event kampus (open house, workshop, dll)
-- 3. Tambahkan tabel 'email_templates' untuk email automation (konfirmasi pendaftaran, dll)
-- 4. Tambahkan tabel 'settings' global untuk konfigurasi sistem
-- 5. Pertimbangkan full-text search index untuk kolom yang sering di-search
-- 6. Implementasi soft deletes (deleted_at) untuk tabel kritikal seperti registrations

-- CARA PENGGUNAAN:
-- 1. Pastikan MySQL/MariaDB sudah terinstall (via Laragon sudah include)
-- 2. Buat database baru:
--    CREATE DATABASE dhs_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- 3. Import schema.sql ini:
--    mysql -u root -p dhs_db < database/schema.sql
--    atau via phpMyAdmin: Import > Pilih file schema.sql
-- 4. Update file .env Laravel:
--    DB_CONNECTION=mysql
--    DB_HOST=127.0.0.1
--    DB_PORT=3306
--    DB_DATABASE=dhs_db
--    DB_USERNAME=root
--    DB_PASSWORD=
-- 5. Buat Models Laravel sesuai dengan tabel:
--    php artisan make:model NewsArticle
--    php artisan make:model Program
--    dll.

-- =========================================================================
-- TABEL SISTEM LARAVEL (Sessions, Cache, Jobs, Reset Tokens)
-- =========================================================================

CREATE TABLE IF NOT EXISTS password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED DEFAULT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_last_activity (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cache (
    `key` VARCHAR(255) PRIMARY KEY,
    `value` MEDIUMTEXT NOT NULL,
    `expiration` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cache_locks (
    `key` VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL,
    reserved_at INT UNSIGNED DEFAULT NULL,
    available_at INT UNSIGNED NOT NULL,
    created_at INT UNSIGNED NOT NULL,
    INDEX idx_queue (queue)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INT NOT NULL,
    pending_jobs INT NOT NULL,
    failed_jobs INT NOT NULL,
    failed_job_ids LONGTEXT NOT NULL,
    options LONGTEXT DEFAULT NULL,
    cancelled_at INT DEFAULT NULL,
    created_at INT NOT NULL,
    finished_at INT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS failed_jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload LONGTEXT NOT NULL,
    exception LONGTEXT NOT NULL,
    failed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================================
-- END OF SCHEMA
-- Total Tables: 24 (17 Tabel DHS + 7 Tabel Sistem Laravel)
-- Total Seeded Records: 100+ records
-- =========================================================================

