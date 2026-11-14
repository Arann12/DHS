<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users') && DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY role ENUM('super_admin','admin','editor','finance') NOT NULL DEFAULT 'admin'");
        }

        User::where('role', 'editor')->update(['role' => 'admin']);

        if (Schema::hasTable('users') && DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY role ENUM('super_admin','admin','finance') NOT NULL DEFAULT 'admin'");
        }

        $legacyAdmin = User::where('username', 'editor')->first();
        if ($legacyAdmin && !User::where('username', 'admin')->exists()) {
            $legacyAdmin->update([
                'name' => 'Admin DHS',
                'username' => 'admin',
                'email' => 'admin@dhs.or.id',
                'password' => Hash::make('adminDHS2026!'),
                'role' => 'admin',
                'is_active' => true,
            ]);
        }
    }

    public function down(): void
    {
        User::whereIn('role', ['admin', 'finance'])->update(['role' => 'editor']);
        if (Schema::hasTable('users') && DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY role ENUM('super_admin','admin','editor') NOT NULL DEFAULT 'editor'");
        }
    }
};
