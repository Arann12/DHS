<?php

namespace Database\Seeders;

use App\Models\BrandingSetting;
use Illuminate\Database\Seeder;

class BrandingSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['setting_key' => 'logo_primary', 'setting_value' => '/image/LogoDHS.png', 'setting_type' => 'file', 'setting_group' => 'logo'],
            ['setting_key' => 'logo_favicon', 'setting_value' => '/uploads/YDHQPruVJ78ikDyLNmWRzVFHAWHCTEAWpkRaRNNb.jpg', 'setting_type' => 'file', 'setting_group' => 'logo'],
            ['setting_key' => 'color_primary', 'setting_value' => '#1A1F6B', 'setting_type' => 'color', 'setting_group' => 'colors'],
            ['setting_key' => 'color_secondary', 'setting_value' => '#D4302A', 'setting_type' => 'color', 'setting_group' => 'colors'],
            ['setting_key' => 'color_gold', 'setting_value' => '#C53030', 'setting_type' => 'color', 'setting_group' => 'colors'],
            ['setting_key' => 'color_navy', 'setting_value' => '#101340', 'setting_type' => 'color', 'setting_group' => 'colors'],
            ['setting_key' => 'color_cream', 'setting_value' => '#F5F6F8', 'setting_type' => 'color', 'setting_group' => 'colors'],
            ['setting_key' => 'color_beige', 'setting_value' => '#EBF0FA', 'setting_type' => 'color', 'setting_group' => 'colors'],
            ['setting_key' => 'font_heading', 'setting_value' => 'Playfair Display, serif', 'setting_type' => 'text', 'setting_group' => 'typography'],
            ['setting_key' => 'font_body', 'setting_value' => 'Inter, sans-serif', 'setting_type' => 'text', 'setting_group' => 'typography'],
        ];

        foreach ($settings as $item) {
            BrandingSetting::updateOrCreate(
                ['setting_key' => $item['setting_key']],
                $item
            );
        }
    }
}
