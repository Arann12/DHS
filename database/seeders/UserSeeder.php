<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin DHS',
                'username' => 'denpasarhotelschool',
                'email' => 'admin@denpasarhotelschool.com',
                'password' => 'indoapps2026',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Admin DHS',
                'username' => 'admin',
                'email' => 'admin@dhs.or.id',
                'password' => 'adminDHS2026!',
                'role' => 'admin',
            ],
            [
                'name' => 'Finance DHS',
                'username' => 'finance',
                'email' => 'finance@dhs.or.id',
                'password' => 'financeDHS2026!',
                'role' => 'finance',
            ],
        ];

        foreach ($users as $userData) {
            $password = $userData['password'];
            unset($userData['password']);
            $userData['is_active'] = true;

            $user = User::firstOrNew(['username' => $userData['username']]);
            $user->fill($userData);
            if (!$user->exists) {
                $user->password = Hash::make($password);
            }
            $user->save();
        }

        User::where('username', 'editor')->update(['role' => 'admin']);
    }
}
