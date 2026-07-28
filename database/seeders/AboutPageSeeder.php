<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'section_key' => 'hero',
                'section_title' => 'Hero Banner',
                'section_content' => [
                    'title' => 'Membangun Pemimpin Hospitality Masa Depan',
                    'subtitle' => 'INSTITUSI & WARISAN',
                    'bgImage' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvULZTmcRw3vX-f-CzNGg8stMRI2Ea5NrSmiyucdED1Ui6mqgK2AmexIratVtInAzxZCCHoL-zzOc0IKiakMVptfS6D7Totb7TxRP3hnBTI6jiqWvMeiM_1-hkImIpVicdfMM6OIO2stFSZu3ragqM52MjEfHpklP14W0JSFCG3J7oNfgCwfP2lub1AqE-vF_htAw-tUtFYRPRud-E7yvapjggWrzGecs_O5JgHck2s4ToD8oRnYCnxg',
                ],
                'display_order' => 1,
            ],
            [
                'section_key' => 'intro',
                'section_title' => 'Tagline & Intro',
                'section_content' => [
                    'label' => 'TENTANG DHS',
                    'headline' => 'Transforming Into Excellent',
                    'p1' => 'Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.',
                    'p2' => 'Lembaga ini hadir untuk mengajak mahasiswa belajar sambil bekerja di Australia, Jerman dan Asia Tenggara melalui Partnership Program of DHS, dikenal dengan sebutan PP DHS.',
                    'quote' => '"Mengintegrasikan pendidikan perhotelan dengan dunia industri nyata untuk karir global."',
                ],
                'display_order' => 2,
            ],
            [
                'section_key' => 'vision',
                'section_title' => 'Visi Misi Core Values',
                'section_content' => [
                    'visi' => 'Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.',
                    'misi' => [
                        'Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.',
                        'Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.',
                        'Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.',
                    ],
                    'coreValues' => [
                        ['title' => 'Integritas (Integrity)', 'desc' => 'DHS memegang teguh visi dan misi guna membentuk insan pariwisata yang kompeten dan berdaya saing.'],
                        ['title' => 'Tanggung Jawab (Responsibility)', 'desc' => 'DHS bertanggung jawab menghasilkan lulusan yang sesuai dengan kriteria dunia kerja serta tantangan di masa depan.'],
                        ['title' => 'Kualitas (Quality)', 'desc' => 'DHS memberikan pelayanan dan solusi terbaik yang berfokus pada kualitas pembelajaran.'],
                    ],
                ],
                'display_order' => 3,
            ],
            [
                'section_key' => 'timeline',
                'section_title' => 'Sejarah Timeline',
                'section_content' => [
                    'items' => [
                        ['year' => '2005', 'title' => 'DHS Berdiri', 'desc' => 'Denpasar Hotel School didirikan dengan visi membawa standar pendidikan hospitality internasional ke Bali.'],
                        ['year' => '2009', 'title' => 'Akreditasi Nasional', 'desc' => 'DHS meraih akreditasi A dari BAN-PT. Sebuah pengakuan atas komitmen kami terhadap kualitas pendidikan.'],
                        ['year' => '2013', 'title' => 'Gedung Training Center Baru', 'desc' => 'Peresmian Training Center seluas 4.500 m² dengan dapur profesional, training bar, dan training restaurant.'],
                        ['year' => '2017', 'title' => 'MoU dengan Marriott International', 'desc' => 'Penandatanganan MoU strategis dengan Marriott International membuka jalur rekrutmen langsung.'],
                        ['year' => '2022', 'title' => 'Program Internasional', 'desc' => 'Peluncuran program exchange mahasiswa dengan sekolah perhotelan di Swiss dan Singapura.'],
                        ['year' => '2024', 'title' => 'DHS Hari Ini', 'desc' => '3.000+ alumni tersebar di hotel-hotel terkemuka di 20+ negara.'],
                    ],
                ],
                'display_order' => 4,
            ],
            [
                'section_key' => 'director',
                'section_title' => 'Pesan Direktur',
                'section_content' => [
                    'p1' => '"Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten."',
                    'p2' => '"Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global."',
                    'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ',
                ],
                'display_order' => 5,
            ],
            [
                'section_key' => 'leader',
                'section_title' => 'Tim Kepemimpinan',
                'section_content' => [
                    'name' => 'I Made Dwija Suastana, S.H., M.H.',
                    'title' => 'Direktur Denpasar Hotel School',
                    'bio' => 'Memimpin Denpasar Hotel School (DHS) dengan komitmen penuh untuk mencetak SDM unggul berdaya saing global.',
                    'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ',
                ],
                'display_order' => 6,
            ],
            [
                'section_key' => 'cta',
                'section_title' => 'Bottom CTA',
                'section_content' => [
                    'title' => 'Jadilah Bagian dari Keluarga DHS',
                    'desc' => 'Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global.',
                    'btn1Text' => 'Jelajahi Program',
                    'btn2Text' => 'Daftar Sekarang',
                ],
                'display_order' => 7,
            ],
        ];

        foreach ($sections as $s) {
            AboutPage::updateOrCreate(
                ['section_key' => $s['section_key']],
                [
                    'section_title'   => $s['section_title'],
                    'section_content' => $s['section_content'],
                    'is_active'       => true,
                    'display_order'   => $s['display_order'],
                ]
            );
        }
    }
}
