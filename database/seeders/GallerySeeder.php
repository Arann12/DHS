<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Siswa DHS dalam Seragam',
                'description' => 'Mahasiswa DHS siap untuk praktikum industri',
                'image_url' => 'https://example.com/gallery1.jpg',
                'alt_text' => 'Students in uniform',
                'category' => 'kampus',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Kolam Resort Simulasi',
                'description' => 'Fasilitas kolam resort untuk praktik housekeeping',
                'image_url' => 'https://example.com/gallery2.jpg',
                'alt_text' => 'Resort Pool',
                'category' => 'fasilitas',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Praktikum Dapur Chef',
                'description' => 'Mahasiswa culinary arts sedang praktikum di dapur industri',
                'image_url' => 'https://example.com/gallery3.jpg',
                'alt_text' => 'Chefs cooking',
                'category' => 'kegiatan',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Dapur Industri Modern',
                'description' => 'Fasilitas dapur berstandar internasional',
                'image_url' => 'https://example.com/gallery4.jpg',
                'alt_text' => 'Industry Kitchen',
                'category' => 'fasilitas',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Training Bar & Restaurant',
                'description' => 'Fasilitas training bar dan restaurant untuk program F&B Service',
                'image_url' => 'https://example.com/gallery5.jpg',
                'alt_text' => 'Training Bar',
                'category' => 'fasilitas',
                'display_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Siswa DHS dalam Seragam',
                'description' => 'Mahasiswa DHS siap untuk praktikum industri',
                'image_url' => 'https://example.com/gallery1.jpg',
                'alt_text' => 'Students in uniform',
                'category' => 'kampus',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Kolam Resort Simulasi',
                'description' => 'Fasilitas kolam resort untuk praktik housekeeping',
                'image_url' => 'https://example.com/gallery2.jpg',
                'alt_text' => 'Resort Pool',
                'category' => 'fasilitas',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Praktikum Dapur Chef',
                'description' => 'Mahasiswa culinary arts sedang praktikum di dapur industri',
                'image_url' => 'https://example.com/gallery3.jpg',
                'alt_text' => 'Chefs cooking',
                'category' => 'kegiatan',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Dapur Industri Modern',
                'description' => 'Fasilitas dapur berstandar internasional',
                'image_url' => 'https://example.com/gallery4.jpg',
                'alt_text' => 'Industry Kitchen',
                'category' => 'fasilitas',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Training Bar & Restaurant',
                'description' => 'Fasilitas training bar dan restaurant untuk program F&B Service',
                'image_url' => 'https://example.com/gallery5.jpg',
                'alt_text' => 'Training Bar',
                'category' => 'fasilitas',
                'display_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Gallery::updateOrCreate(
                ['image_url' => $item['image_url']],
                $item
            );
        }
    }
}
