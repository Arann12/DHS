<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kas_categories')) {
            Schema::create('kas_categories', function (Blueprint $table) {
                $table->id();
                $table->enum('type', ['masuk', 'keluar']);
                $table->string('nama', 100);
                $table->text('deskripsi')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('display_order')->default(0);
                $table->timestamps();
            });

            // Seed default categories
            $defaults = [
                // Masuk
                ['type' => 'masuk', 'nama' => 'Pembayaran SPP / Uang Kuliah', 'deskripsi' => 'Pembayaran kuliah mahasiswa per semester / bulanan', 'display_order' => 1],
                ['type' => 'masuk', 'nama' => 'Uang Pendaftaran Mahasiswa', 'deskripsi' => 'Biaya formulir & admisi calon mahasiswa', 'display_order' => 2],
                ['type' => 'masuk', 'nama' => 'Pembayaran Biaya Wisuda', 'deskripsi' => 'Pelunasan administrasi wisuda', 'display_order' => 3],
                ['type' => 'masuk', 'nama' => 'Pembayaran Biaya Sertifikasi', 'deskripsi' => 'Uji kompetensi & sertifikasi profesi', 'display_order' => 4],
                ['type' => 'masuk', 'nama' => 'Penjualan Produk Praktik (F&B)', 'deskripsi' => 'Hasil penjualan praktikum restaurant, bakery & culinary', 'display_order' => 5],
                ['type' => 'masuk', 'nama' => 'Sewa Fasilitas Kampus', 'deskripsi' => 'Penyewaan ruangan, kitchen, lab untuk pihak luar', 'display_order' => 6],
                ['type' => 'masuk', 'nama' => 'Dana Beasiswa Masuk', 'deskripsi' => 'Penerimaan beasiswa dari instansi/mitra', 'display_order' => 7],
                ['type' => 'masuk', 'nama' => 'Hibah / Donasi', 'deskripsi' => 'Bantuan dana mitra kerja atau alumni', 'display_order' => 8],
                ['type' => 'masuk', 'nama' => 'Pendapatan Lain-lain', 'deskripsi' => 'Pemasukan di luar kategori utama', 'display_order' => 9],

                // Keluar
                ['type' => 'keluar', 'nama' => 'Gaji & Honor Pegawai', 'deskripsi' => 'Gaji bulanan staf dan karyawan', 'display_order' => 1],
                ['type' => 'keluar', 'nama' => 'Gaji & Honor Dosen/Instruktur', 'deskripsi' => 'Honor mengajar dosen tetap dan praktisi', 'display_order' => 2],
                ['type' => 'keluar', 'nama' => 'Biaya Operasional Kantor', 'deskripsi' => 'Operasional harian dan utilitas kantor', 'display_order' => 3],
                ['type' => 'keluar', 'nama' => 'Pembelian Bahan Praktik', 'deskripsi' => 'Bahan makanan, minuman, dan sanitasi praktikum', 'display_order' => 4],
                ['type' => 'keluar', 'nama' => 'Pembelian Perlengkapan Dapur', 'deskripsi' => 'Alat memasak, tableware, bar tools', 'display_order' => 5],
                ['type' => 'keluar', 'nama' => 'Perawatan Fasilitas & Gedung', 'deskripsi' => 'Maintenance AC, gedung, kelistrikan dan plumbing', 'display_order' => 6],
                ['type' => 'keluar', 'nama' => 'Biaya Listrik & Air & Internet', 'deskripsi' => 'Tagihan utilitas PLN, PDAM, dan koneksi internet', 'display_order' => 7],
                ['type' => 'keluar', 'nama' => 'Biaya Marketing & Promosi', 'deskripsi' => 'Iklan, brosur, expo kampus, dan media sosial', 'display_order' => 8],
                ['type' => 'keluar', 'nama' => 'Biaya Administrasi & ATK', 'deskripsi' => 'Kertas, printer, tinta, dan kebutuhan kantor', 'display_order' => 9],
                ['type' => 'keluar', 'nama' => 'Biaya Perjalanan Dinas', 'deskripsi' => 'Kunjungan industri, kemitraan, studi banding', 'display_order' => 10],
                ['type' => 'keluar', 'nama' => 'Biaya Acara & Event', 'deskripsi' => 'Seminar, workshop, Dies Natalis, welcoming', 'display_order' => 11],
                ['type' => 'keluar', 'nama' => 'Pengeluaran Lain-lain', 'deskripsi' => 'Pengeluaran tak terduga', 'display_order' => 12],
            ];

            $now = now();
            foreach ($defaults as $item) {
                DB::table('kas_categories')->insert(array_merge($item, [
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_categories');
    }
};

