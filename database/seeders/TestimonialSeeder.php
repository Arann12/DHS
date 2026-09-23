<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Komang Rai Saputra',
                'position' => 'Alumni 2019 ?? Cruise Ship Waiter',
                'company' => 'Royal Caribbean',
                'quote' => 'Berkat DHS, saya bisa bekerja di kapal pesiar internasional dan mengunjungi 30+ negara.',
                'photo_url' => NULL,
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'name' => 'Ni Luh Ayu Dewi',
                'position' => 'Alumni 2018 Guest Relations, Ritz-Carlton Bali',
                'company' => 'Ritz-Carlton Bali',
                'quote' => 'Instruktur di DHS adalah profesional industri yang mengerti kebutuhan dunia kerja nyata.',
                'photo_url' => NULL,
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Made Wirawan',
                'position' => 'Alumni 2022 Cruise land',
                'company' => NULL,
                'quote' => 'Sekolah terbaik',
                'photo_url' => NULL,
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'display_order' => 6,
            ],
            [
                'name' => 'I Gde Dharma Sumandita Yasa',
                'position' => 'Alumni 2019 Jurusan F&B',
                'company' => NULL,
                'quote' => 'sekolah disini benar benar asik dan membuat saya cepat mengerti, cita cita saya ingin keluar negeri',
                'photo_url' => NULL,
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'display_order' => 7,
            ],
        ];

        foreach ($items as $item) {
            Testimonial::updateOrCreate(
                ['name' => $item['name'], 'company' => $item['company']],
                $item
            );
        }
    }
}
