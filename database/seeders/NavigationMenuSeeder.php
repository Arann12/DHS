<?php

namespace Database\Seeders;

use App\Models\NavigationMenu;
use Illuminate\Database\Seeder;

class NavigationMenuSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'id' => 1,
                'parent_id' => null,
                'menu_label' => 'Beranda',
                'menu_url' => '/',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'id' => 2,
                'parent_id' => null,
                'menu_label' => 'Tentang Kami',
                'menu_url' => '/tentang',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'id' => 3,
                'parent_id' => null,
                'menu_label' => 'Akademi',
                'menu_url' => '/akademi',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'id' => 4,
                'parent_id' => null,
                'menu_label' => 'Berita',
                'menu_url' => '/berita',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'id' => 5,
                'parent_id' => null,
                'menu_label' => 'FAQ',
                'menu_url' => '/faq',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 5,
            ],
            [
                'id' => 6,
                'parent_id' => null,
                'menu_label' => 'Karier',
                'menu_url' => '/karier',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 6,
            ],
            [
                'id' => 7,
                'parent_id' => null,
                'menu_label' => 'Pendaftaran',
                'menu_url' => '/cara-mendaftar',
                'menu_type' => 'header',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 7,
            ],
            [
                'id' => 8,
                'parent_id' => null,
                'menu_label' => 'Beranda',
                'menu_url' => '/',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'id' => 9,
                'parent_id' => null,
                'menu_label' => 'Tentang Kami',
                'menu_url' => '/tentang',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'id' => 10,
                'parent_id' => null,
                'menu_label' => 'Akademi',
                'menu_url' => '/akademi',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'id' => 11,
                'parent_id' => null,
                'menu_label' => 'Berita',
                'menu_url' => '/berita',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'id' => 12,
                'parent_id' => null,
                'menu_label' => 'FAQ',
                'menu_url' => '/faq',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 5,
            ],
            [
                'id' => 13,
                'parent_id' => null,
                'menu_label' => 'Karier',
                'menu_url' => '/karier',
                'menu_type' => 'both',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 6,
            ],
            [
                'id' => 14,
                'parent_id' => null,
                'menu_label' => 'Pendaftaran',
                'menu_url' => '/cara-mendaftar',
                'menu_type' => 'header',
                'target_blank' => false,
                'icon_class' => NULL,
                'is_active' => true,
                'display_order' => 7,
            ],
        ];

        foreach ($items as $item) {
            NavigationMenu::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }
    }
}
