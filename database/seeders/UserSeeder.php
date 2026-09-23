<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Super Admin DHS',
                'username' => 'denpasarhotelschool',
                'email' => 'admin@denpasarhotelschool.com',
                'password' => '$2y$10$434jurd5Whrg1gJ.6Cst4uuX6eHIENwwXahECQURV6Zkw8A45Xxm.', // indoapps2026
                'role' => 'super_admin',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Editor Konten',
                'username' => 'editor',
                'email' => 'editor@dhs.or.id',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'editor',
                'is_active' => true,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['username' => $userData['username']],
                $userData
            );
        }
    }
}
