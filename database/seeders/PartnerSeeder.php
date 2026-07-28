<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        // Mitra Industri — hotel, resort, cruise, restoran
        $mitraIndustri = [
            ['name' => 'NEO by Aston', 'country' => 'Indonesia', 'type' => 'hotel', 'partner_group' => 'mitra_industri'],
            ['name' => 'Four Star by Trans Hotel', 'country' => 'Indonesia', 'type' => 'hotel', 'partner_group' => 'mitra_industri'],
            ['name' => 'Amnaya Resort Bali', 'country' => 'Indonesia', 'type' => 'hotel', 'partner_group' => 'mitra_industri'],
            ['name' => 'Theanna Villa Canggu', 'country' => 'Indonesia', 'type' => 'hotel', 'partner_group' => 'mitra_industri'],
            ['name' => 'Four Points by Sheraton Ungasan', 'country' => 'Indonesia', 'type' => 'hotel', 'partner_group' => 'mitra_industri'],
            ['name' => 'Kuta Paradiso Hotel', 'country' => 'Indonesia', 'type' => 'hotel', 'partner_group' => 'mitra_industri'],
            ['name' => 'COMO Uma Canggu', 'country' => 'Indonesia', 'type' => 'hotel', 'partner_group' => 'mitra_industri'],
            ['name' => 'The Vasini Smart Boutique', 'country' => 'Indonesia', 'type' => 'hotel', 'partner_group' => 'mitra_industri'],
            ['name' => 'Soulbites Ubud', 'country' => 'Indonesia', 'type' => 'restaurant', 'partner_group' => 'mitra_industri'],
            ['name' => 'Taco Casa', 'country' => 'Indonesia', 'type' => 'restaurant', 'partner_group' => 'mitra_industri'],
            ['name' => 'Noble Career Gurus', 'country' => 'Indonesia', 'type' => 'cruise', 'partner_group' => 'mitra_industri'],
            ['name' => 'Fokusindo', 'country' => 'Indonesia', 'type' => 'other', 'partner_group' => 'mitra_industri'],
            ['name' => 'Jubilee', 'country' => '', 'type' => 'other', 'partner_group' => 'mitra_industri'],
        ];

        // Partnership — pendidikan, kerjasama internasional
        $partnership = [
            ['name' => 'TAFE', 'country' => 'Australia', 'type' => 'education', 'partner_group' => 'partnership'],
            ['name' => 'The Hotel School Sydney & Melbourne', 'country' => 'Australia', 'type' => 'education', 'partner_group' => 'partnership'],
            ['name' => 'Ausbildung Jerman', 'country' => 'Jerman', 'type' => 'education', 'partner_group' => 'partnership'],
            ['name' => 'GCOM Education', 'country' => '', 'type' => 'education', 'partner_group' => 'partnership'],
            ['name' => 'Bursa SDM Indonesia', 'country' => 'Indonesia', 'type' => 'government', 'partner_group' => 'partnership'],
            ['name' => 'Bali Language Art & Culture', 'country' => 'Indonesia', 'type' => 'education', 'partner_group' => 'partnership'],
        ];

        $order = 1;
        foreach (array_merge($mitraIndustri, $partnership) as $p) {
            Partner::updateOrCreate(
                ['name' => $p['name']],
                array_merge($p, ['is_active' => 1, 'is_featured' => 1, 'display_order' => $order++])
            );
        }
    }
}
