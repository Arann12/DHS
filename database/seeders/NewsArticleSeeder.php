<?php

namespace Database\Seeders;

use App\Models\NewsArticle;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::where('role', 'super_admin')->first() ?? User::first();
        $authorId = $author ? $author->id : 1;

        $articles = [
            [
                'title' => 'Kemitraan DHS dengan Kapal Pesiar Mewah 2026',
                'slug' => 'kemitraan-dhs-dengan-kapal-pesiar-mewah-2026',
                'category' => 'partnership',
                'excerpt' => 'Denpasar Hotel School mengumumkan kemitraan eksklusif dengan tiga perusahaan kapal pesiar global.',
                'content' => 'Denpasar Hotel School announces an exclusive partnership with three global cruise lines. This collaboration will provide outstanding access for our best students to intern on luxury ships, upgrading marine hospitality training standards.',
                'thumbnail_url' => '/uploads/berita/CpSE9lwCazvpWOAAn3x1JCEy7oBt88W6BHzNu3fM.jpg',
                'author_id' => $authorId,
                'status' => 'dipublikasikan',
                'published_at' => '2024-09-12 10:00:00',
                'views_count' => 6,
                'is_featured' => true,
            ],
            [
                'title' => 'Masterclass Kuliner bersama Chef Michelin',
                'slug' => 'masterclass-kuliner-bersama-chef-michelin',
                'category' => 'kegiatan',
                'excerpt' => 'Menjelajahi teknik gastronomi modern yang dipandu oleh pakar kuliner bertaraf internasional.',
                'content' => 'Exploring modern gastronomy techniques guided by international-level culinary experts.',
                'thumbnail_url' => '/image/about_dhs.jpg',
                'author_id' => $authorId,
                'status' => 'dipublikasikan',
                'published_at' => '2024-08-25 08:00:00',
                'views_count' => 3,
                'is_featured' => false,
            ],
            [
                'title' => 'Alumni Memimpin Boutique Resort di Asia',
                'slug' => 'alumni-memimpin-boutique-resort-di-asia',
                'category' => 'alumni',
                'excerpt' => 'Kisah sukses alumni DHS yang membentuk masa depan akomodasi butik eksklusif di seluruh kawasan Asia.',
                'content' => 'Success stories of DHS graduates shaping the future of exclusive boutique accommodations across Asia.',
                'thumbnail_url' => '/image/about_dhs.jpg',
                'author_id' => $authorId,
                'status' => 'dipublikasikan',
                'published_at' => '2024-08-15 09:00:00',
                'views_count' => 1,
                'is_featured' => false,
            ],
            [
                'title' => 'Inisiatif Kampus Hospitality Berkelanjutan',
                'slug' => 'inisiatif-kampus-hospitality-berkelanjutan',
                'category' => 'keberlanjutan',
                'excerpt' => 'Menerapkan praktik ramah lingkungan inovatif di fasilitas pelatihan kami untuk mempersiapkan siswa menghadapi green hospitality.',
                'content' => 'Implementing innovative eco-friendly practices in our training facilities to prepare students for green hospitality.',
                'thumbnail_url' => '/image/about_dhs.jpg',
                'author_id' => $authorId,
                'status' => 'dipublikasikan',
                'published_at' => '2024-08-05 07:00:00',
                'views_count' => 1,
                'is_featured' => false,
            ],
            [
                'title' => 'DHS Raih Akreditasi A dari BAN-SM',
                'slug' => 'dhs-raih-akreditasi-a-dari-ban-sm',
                'category' => 'prestasi',
                'excerpt' => 'Denpasar Hotel School secara resmi meraih akreditasi A dari Badan Akreditasi Nasional.',
                'content' => 'Pencapaian ini merupakan bukti komitmen DHS dalam menjaga kualitas pendidikan hospitality di Indonesia.',
                'thumbnail_url' => '/image/about_dhs.jpg',
                'author_id' => $authorId,
                'status' => 'dipublikasikan',
                'published_at' => '2026-07-20 06:00:00',
                'views_count' => 9,
                'is_featured' => false,
            ],
        ];

        foreach ($articles as $item) {
            NewsArticle::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
