<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'stat_key' => 'years_established',
                'stat_value' => '18+',
                'stat_label' => 'YEARS OF HERITAGE',
                'stat_icon' => 'calendar_today',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'stat_key' => 'total_alumni',
                'stat_value' => '3000+',
                'stat_label' => 'SUCCESSFUL ALUMNIs',
                'stat_icon' => 'school',
                'is_active' => true,
                'display_order' => 2,
            ],
        ];

        foreach ($items as $item) {
            Statistic::updateOrCreate(
                ['stat_key' => $item['stat_key']],
                $item
            );
        }
    }
}
