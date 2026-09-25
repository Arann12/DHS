<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BrandingSettingSeeder::class,
            ProgramCategorySeeder::class,
            ProgramSeeder::class,
            HomepageSectionSeeder::class,
            FooterSettingSeeder::class,
            StatisticSeeder::class,
            NavigationMenuSeeder::class,
            PartnerSeeder::class,
            AboutPageSeeder::class,
            NewsArticleSeeder::class,
            GallerySeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
