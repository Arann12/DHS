<?php

namespace Database\Seeders;

use App\Models\ProgramCategory;
use Illuminate\Database\Seeder;

class ProgramCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'category_key' => 'internasional',
                'category_name' => 'Program Internasional',
                'subtitle' => 'Program Internasionalsis',
                'description' => 'DHS bekerjasama dengan The Hotel School Melbourne & Sydney dan TAFE Australia untuk menyalurkan peserta didik DHS yang berminat lanjut untuk melaksanakan pendidikan di luar negeri.s',
                'career_opportunities' => 'Hotel Staff, Restaurant Staff, Instruktur LKP/LPK, Wirausaha',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'id' => 2,
                'category_key' => '2-tahun',
                'category_name' => 'Vokasi 2 Tahun',
                'subtitle' => 'PROGRAM VOKASI',
                'description' => 'Memiliki jurusan FB Service Bartender, Perhotelan dan Culinary Arts dengan jaminan OJT di Hotel Bintang 4 & 5.',
                'career_opportunities' => 'Hotel Staff, Restaurant Staff, Barista, Chef/Cook, Entrepreneur',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'id' => 3,
                'category_key' => '1-tahun',
                'category_name' => 'Vokasi 1 Tahun',
                'subtitle' => 'PROGRAM VOKASI',
                'description' => 'Dirancang untuk persiapan kilat memasuki industri perhotelan bintang 4 & 5 serta kapal pesiar.',
                'career_opportunities' => 'Hotel Staff, Restaurant Staff, Barista, Assistant Cook, Entrepreneur',
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'id' => 4,
                'category_key' => '1-tahun-kapal-pesiar',
                'category_name' => '1 Tahun Kapal Pesia',
                'subtitle' => 'PROGRAM KAPAL PESIAR',
                'description' => 'Program akselerasi 1 tahun yang difokuskan untuk persiapan bekerja secara profesional di departemen F&B dan housekeeping kapal pesiar.',
                'career_opportunities' => 'Cruise Ship Cook, Waiter/Waitress, Cabin Steward, Galley Utility',
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'id' => 5,
                'category_key' => '6-bulan',
                'category_name' => 'Short Course 6 Bulan',
                'subtitle' => 'KURSUS SINGKAT',
                'description' => 'Program singkat diperuntukan untuk peserta didik yang berniat menambah ilmu di bidang spesifik dengan mengutamakan praktek langsung.',
                'career_opportunities' => 'Entry-level Hotel Staff, Barista, Commis Chef, Restaurant Server',
                'is_active' => true,
                'display_order' => 5,
            ],
            [
                'id' => 6,
                'category_key' => 'eksekutif',
                'category_name' => 'Program Eksekutif (6 Bln)',
                'subtitle' => 'PROGRAM EKSEKUTIF',
                'description' => 'Program khusus 6 bulan kapal pesiar dengan berbagai fasilitas bonus menarik untuk akselerasi karir maritim instan.',
                'career_opportunities' => 'Cruise Line Cook, Cruise Line Bartender, Butler, Spa Therapist',
                'is_active' => true,
                'display_order' => 6,
            ],
        ];

        foreach ($categories as $cat) {
            ProgramCategory::updateOrCreate(
                ['category_key' => $cat['category_key']],
                $cat
            );
        }
    }
}
