<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['setting_key' => 'address_denpasar', 'setting_value' => 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali', 'setting_group' => 'contact'],
            ['setting_key' => 'phone_denpasar', 'setting_value' => '+62 81 246 319966', 'setting_group' => 'contact'],
            ['setting_key' => 'email_denpasar', 'setting_value' => 'sahabat@dhs.or.id', 'setting_group' => 'contact'],
            ['setting_key' => 'address_klungkung', 'setting_value' => 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali', 'setting_group' => 'contact'],
            ['setting_key' => 'phone_klungkung', 'setting_value' => '+0366 5582998', 'setting_group' => 'contact'],
            ['setting_key' => 'wa_klungkung', 'setting_value' => '+62 81 337 106480', 'setting_group' => 'contact'],
            ['setting_key' => 'linktree_url', 'setting_value' => 'https://linktr.ee/BiayaPendidikan_DHS', 'setting_group' => 'links'],
            ['setting_key' => 'student_portal_url', 'setting_value' => 'http://www.dhs.or.id/student', 'setting_group' => 'links'],
            ['setting_key' => 'google_maps_url', 'setting_value' => 'https://maps.google.com/?q=Denpasar+Hotel+School', 'setting_group' => 'links'],
            ['setting_key' => 'facebook_url', 'setting_value' => 'https://facebook.com/dhsofficial', 'setting_group' => 'social'],
            ['setting_key' => 'instagram_url', 'setting_value' => 'https://instagram.com/dhsofficial', 'setting_group' => 'social'],
            ['setting_key' => 'youtube_url', 'setting_value' => 'https://youtube.com/@dhsofficial', 'setting_group' => 'social'],
        ];

        foreach ($settings as $item) {
            FooterSetting::updateOrCreate(
                ['setting_key' => $item['setting_key']],
                $item
            );
        }
    }
}
