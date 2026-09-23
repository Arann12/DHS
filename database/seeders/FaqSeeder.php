<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'question' => 'Apakah kurikulum DHS berstandar internasional?',
                'answer' => 'Ya, kurikulum kami dirancang dengan memadukan standar kompetensi nasional (SKKNI) dan standar internasional industri perhotelan. Kami juga bekerja sama dengan berbagai jaringan hotel global untuk memastikan materi yang diajarkan relevan dengan kebutuhan industri saat ini.',
                'category' => 'akademi',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'question' => 'Apa saja program studi yang tersedia di DHS?',
                'answer' => 'DHS menawarkan tiga program utama: Culinary Arts (seni kuliner), Hospitality Management (manajemen perhotelan), dan Food & Beverage Service. Setiap program dirancang dengan rasio praktik tinggi untuk memastikan kesiapan kerja lulusan.',
                'category' => 'akademi',
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'question' => 'Apa saja syarat pendaftaran mahasiswa baru?',
                'answer' => 'Syarat pendaftaran: 1) Lulusan SMA/SMK/MA sederajat dari semua jurusan, 2) Mengisi formulir pendaftaran online, 3) Menyerahkan fotokopi ijazah, SKHUN, dan transkrip nilai yang dilegalisir, 4) Pas foto terbaru ukuran 3x4 dan 4x6 (masing-masing 2 lembar), 5) Lulus ujian saringan masuk (Tes Potensi Akademik dan Wawancara).',
                'category' => 'pendaftaran',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'question' => 'Apakah ada beasiswa yang tersedia?',
                'answer' => 'DHS menyediakan beberapa jalur beasiswa, antara lain Beasiswa Prestasi Akademik, Beasiswa Prestasi Non-Akademik (olahraga/seni), dan Beasiswa Kemitraan Industri. Informasi lengkap mengenai persyaratan dan jadwal pengajuan beasiswa dapat dilihat pada halaman Beasiswa atau menghubungi tim admisi kami.',
                'category' => 'pendaftaran',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'question' => 'Kapan periode pendaftaran dibuka?',
                'answer' => 'Pendaftaran mahasiswa baru DHS dibuka setiap tahun mulai bulan Maret hingga Juli untuk penerimaan tahun ajaran baru di bulan September. Pendaftaran dilakukan secara online melalui portal resmi DHS.',
                'category' => 'pendaftaran',
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'question' => 'Berapa biaya kuliah di DHS?',
                'answer' => 'Biaya pendidikan di DHS bervariasi tergantung program yang dipilih. Untuk informasi lengkap mengenai struktur biaya, silakan mengunduh brosur biaya terbaru atau hubungi tim admisi kami. Kami juga menawarkan skema cicilan yang fleksibel.',
                'category' => 'biaya',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'question' => 'Apakah biaya kuliner/seragam sudah termasuk dalam biaya kuliah?',
                'answer' => 'Biaya seragam dan peralatan praktik (termasuk perlengkapan dapur untuk program Culinary) dikenakan terpisah pada saat registrasi ulang. Detail biaya ini akan diinformasikan pada saat dinyatakan lulus seleksi.',
                'category' => 'biaya',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'question' => 'Berapa lama durasi tiap program studi di DHS?',
                'answer' => 'Durasi program studi di Denpasar Hotel School bervariasi. Program Diploma 1 berdurasi 1 tahun, Diploma 3 berdurasi 3 tahun, dan Diploma 4 (Sarjana Terapan) berdurasi 4 tahun. Setiap program mencakup masa perkuliahan teori, praktik di laboratorium kampus, dan program magang (On the Job Training) di industri perhotelan.',
                'category' => 'akademi',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'question' => 'Apakah kurikulum DHS berstandar internasional?',
                'answer' => 'Ya, kurikulum kami dirancang dengan memadukan standar kompetensi nasional (SKKNI) dan standar internasional industri perhotelan. Kami juga bekerja sama dengan berbagai jaringan hotel global untuk memastikan materi yang diajarkan relevan dengan kebutuhan industri saat ini.',
                'category' => 'akademi',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'question' => 'Apa saja program studi yang tersedia di DHS?',
                'answer' => 'DHS menawarkan tiga program utama: Culinary Arts (seni kuliner), Hospitality Management (manajemen perhotelan), dan Food & Beverage Service. Setiap program dirancang dengan rasio praktik tinggi untuk memastikan kesiapan kerja lulusan.',
                'category' => 'akademi',
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'question' => 'Apa saja syarat pendaftaran mahasiswa baru?',
                'answer' => 'Syarat pendaftaran: 1) Lulusan SMA/SMK/MA sederajat dari semua jurusan, 2) Mengisi formulir pendaftaran online, 3) Menyerahkan fotokopi ijazah, SKHUN, dan transkrip nilai yang dilegalisir, 4) Pas foto terbaru ukuran 3x4 dan 4x6 (masing-masing 2 lembar), 5) Lulus ujian saringan masuk (Tes Potensi Akademik dan Wawancara).',
                'category' => 'pendaftaran',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'question' => 'Apakah ada beasiswa yang tersedia?',
                'answer' => 'DHS menyediakan beberapa jalur beasiswa, antara lain Beasiswa Prestasi Akademik, Beasiswa Prestasi Non-Akademik (olahraga/seni), dan Beasiswa Kemitraan Industri. Informasi lengkap mengenai persyaratan dan jadwal pengajuan beasiswa dapat dilihat pada halaman Beasiswa atau menghubungi tim admisi kami.',
                'category' => 'pendaftaran',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'question' => 'Kapan periode pendaftaran dibuka?',
                'answer' => 'Pendaftaran mahasiswa baru DHS dibuka setiap tahun mulai bulan Maret hingga Juli untuk penerimaan tahun ajaran baru di bulan September. Pendaftaran dilakukan secara online melalui portal resmi DHS.',
                'category' => 'pendaftaran',
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'question' => 'Berapa biaya kuliah di DHS?',
                'answer' => 'Biaya pendidikan di DHS bervariasi tergantung program yang dipilih. Untuk informasi lengkap mengenai struktur biaya, silakan mengunduh brosur biaya terbaru atau hubungi tim admisi kami. Kami juga menawarkan skema cicilan yang fleksibel.',
                'category' => 'biaya',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'question' => 'Apakah biaya kuliner/seragam sudah termasuk dalam biaya kuliah?',
                'answer' => 'Biaya seragam dan peralatan praktik (termasuk perlengkapan dapur untuk program Culinary) dikenakan terpisah pada saat registrasi ulang. Detail biaya ini akan diinformasikan pada saat dinyatakan lulus seleksi.',
                'category' => 'biaya',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'question' => 'Apakah saya ingin mau makan nasi',
                'answer' => '<p>saya makan nasi tapi sudah makan&nbsp;</p>',
                'category' => 'pendaftaran',
                'is_active' => true,
                'display_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            Faq::updateOrCreate(
                ['question' => $item['question']],
                $item
            );
        }
    }
}
