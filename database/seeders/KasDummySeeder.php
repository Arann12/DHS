<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KasProject;
use App\Models\KasTransaction;
use App\Models\Program;
use App\Models\User;

class KasDummySeeder extends Seeder
{
    /**
     * Tambah data dummy realistis untuk Manajemen Keuangan DHS:
     * - 6 Jenis Program (campuran status Lunas & Piutang / Belum Lunas lintas 6 kategori akademi)
     * - Transaksi Keuangan Umum & Per Program lintas tanggal (hari ini, bulan ini, bulan lalu, tahun lalu)
     * - Item Pemasukan, Pengeluaran, dan Piutang Mahasiswa
     */
    public function run(): void
    {
        $adminId = User::value('id') ?? 1;

        $findProgramId = function (string $keyword, ?int $fallbackId = null): ?int {
            $id = Program::where('title', 'like', '%' . $keyword . '%')->value('id');
            return $id ?? ($fallbackId && Program::where('id', $fallbackId)->exists() ? $fallbackId : Program::value('id'));
        };

        $progJerman   = $findProgramId('Ausbildung Jerman', 1);
        $progTafe     = $findProgramId('TAFE Australia', 2);
        $progCulinary = $findProgramId('Culinary Art', 6);
        $progTataHid  = $findProgramId('Tata Hidangan', 7);
        $progFoHk1Th  = $findProgramId('Perhotelan (FO & HK) — 1 Tahun', 8);
        $progCookKp   = $findProgramId('Cook (Asisten Koki)', 10);
        $progBarista  = $findProgramId('Short Course F&B', 18);
        $progSpa      = $findProgramId('SPA Therapist', 16);

        // Pastikan Jenis Program (kas_projects) tidak ditambahkan lagi
        KasTransaction::whereNotNull('project_id')->update(['project_id' => null]);
        if (\Illuminate\Support\Facades\Schema::hasTable('kas_projects')) {
            KasProject::query()->delete();
        }

        // Seed Transaksi Keuangan Umum & Per Program — idempoten berdasarkan kode transaksi
        $trxDefs = [
            // --- KEUANGAN UMUM (Operasional Kampus, Non-Program) ---
            [
                'kode'         => 'KM-DM-20261111-01',
                'tanggal'      => '2026-11-11',
                'type'         => 'masuk',
                'jenis'        => 'Sewa Fasilitas Kampus',
                'deskripsi'    => 'Sewa Ruang Dapur Praktik & Aula Pelatihan Asosiasi Chef Bali',
                'satuan'       => 'Hari',
                'volume'       => 2,
                'harga_satuan' => 1750000,
                'keterangan'   => 'Penggunaan aula kampus dan kitchen lab untuk acara uji kompetensi eksternal.',
                'program_id'   => null,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261111-02',
                'tanggal'      => '2026-11-11',
                'type'         => 'keluar',
                'jenis'        => 'Biaya Listrik & Air & Internet',
                'deskripsi'    => 'Tagihan Listrik PLN, PDAM & Fiber Internet Kampus Nov 2026',
                'satuan'       => 'Paket',
                'volume'       => 1,
                'harga_satuan' => 3850000,
                'keterangan'   => 'Pembayaran tagihan utilitas bulanan gedung utama & lab praktik.',
                'program_id'   => null,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261108-03',
                'tanggal'      => '2026-11-08',
                'type'         => 'keluar',
                'jenis'        => 'Biaya Administrasi & ATK',
                'deskripsi'    => 'Pembelian Kertas A4, Tinta Printer & Perlengkapan Tata Usaha',
                'satuan'       => 'Paket',
                'volume'       => 5,
                'harga_satuan' => 180000,
                'keterangan'   => 'Kebutuhan administrasi ruang pendaftaran & ruang dosen.',
                'program_id'   => null,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261025-04',
                'tanggal'      => '2026-10-25',
                'type'         => 'keluar',
                'jenis'        => 'Perawatan Fasilitas & Gedung',
                'deskripsi'    => 'Servis Berkala AC Ruang Kelas & Perbaikan Chiller Dapur',
                'satuan'       => 'Unit',
                'volume'       => 6,
                'harga_satuan' => 350000,
                'keterangan'   => 'Teknisi HVAC melakukan pembersihan dan pengisian freon 6 unit.',
                'program_id'   => null,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KM-DM-20261015-05',
                'tanggal'      => '2026-10-15',
                'type'         => 'masuk',
                'jenis'        => 'Hibah / Donasi',
                'deskripsi'    => 'Dukungan Sponsor Peralatan Hospitality Mitra Hotel Nusa Dua',
                'satuan'       => 'Paket',
                'volume'       => 1,
                'harga_satuan' => 5000000,
                'keterangan'   => 'Dana hibah pengembangan fasilitas simulasi kamar hotel.',
                'program_id'   => null,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20260928-06',
                'tanggal'      => '2026-09-28',
                'type'         => 'keluar',
                'jenis'        => 'Biaya Operasional Kantor',
                'deskripsi'    => 'Konsumsi Rapat Evaluasi Akademik & Perlengkapan Kebersihan',
                'satuan'       => 'Bulan',
                'volume'       => 1,
                'harga_satuan' => 1450000,
                'keterangan'   => 'Operasional umum bulan September 2026.',
                'program_id'   => null,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20251120-07',
                'tanggal'      => '2025-11-20',
                'type'         => 'keluar',
                'jenis'        => 'Biaya Listrik & Air & Internet',
                'deskripsi'    => 'Tagihan Listrik & Internet Kampus Periode November 2025',
                'satuan'       => 'Bulan',
                'volume'       => 1,
                'harga_satuan' => 3200000,
                'keterangan'   => 'Arsip pembanding pengeluaran tahun sebelumnya.',
                'program_id'   => null,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KM-DM-20261110-30',
                'tanggal'      => '2026-11-10',
                'type'         => 'masuk',
                'jenis'        => 'Sewa Fasilitas Kampus',
                'deskripsi'    => '[DP] Sewa Ruang Lab Kitchen Acara Komunitas Chef Bali',
                'satuan'       => 'Paket',
                'volume'       => 1,
                'harga_satuan' => 1500000,
                'keterangan'   => 'DP diterima Rp 1.500.000 dari total Rp 3.500.000 | Penanggung: Komunitas Chef Bali',
                'piutang_nama' => 'Komunitas Chef Bali',
                'program_id'   => null,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KM-DM-20261110-31',
                'tanggal'      => '2026-11-10',
                'type'         => 'masuk',
                'jenis'        => 'Sewa Fasilitas Kampus',
                'deskripsi'    => '[Sisa Tagihan / Piutang] Sewa Ruang Lab Kitchen Acara Komunitas Chef Bali',
                'satuan'       => 'Paket',
                'volume'       => 1,
                'harga_satuan' => 2000000,
                'keterangan'   => 'Sisa tagihan setelah DP KM-DM-20261110-30 | Penanggung: Komunitas Chef Bali',
                'is_piutang'   => true,
                'piutang_nama' => 'Komunitas Chef Bali',
                'program_id'   => null,
                'project_id'   => null,
            ],

            // --- PRG-2026-001: Ausbildung Jerman (Lunas) ---
            [
                'kode'         => 'KM-DM-20261006-08',
                'tanggal'      => '2026-10-06',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran SPP / Uang Kuliah',
                'deskripsi'    => 'Pelunasan Gelombang 1 Peserta Ausbildung Jerman (10 Mahasiswa)',
                'satuan'       => 'Orang',
                'volume'       => 10,
                'harga_satuan' => 2000000,
                'keterangan'   => 'Transfer kolektif pembayaran tahap 1 angkatan Oktober.',
                'program_id'   => $progJerman,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KM-DM-20261103-09',
                'tanggal'      => '2026-11-03',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran SPP / Uang Kuliah',
                'deskripsi'    => 'Pelunasan Gelombang 2 & Modul Bahasa Jerman (10 Mahasiswa)',
                'satuan'       => 'Orang',
                'volume'       => 10,
                'harga_satuan' => 1500000,
                'keterangan'   => 'Pelunasan penuh target biaya batch Ausbildung Oktober 2026.',
                'program_id'   => $progJerman,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261018-10',
                'tanggal'      => '2026-10-18',
                'type'         => 'keluar',
                'jenis'        => 'Gaji & Honor Dosen/Instruktur',
                'deskripsi'    => 'Honor Pengajar Bahasa Jerman B1 & Pembekalan Budaya',
                'satuan'       => 'Sesi',
                'volume'       => 24,
                'harga_satuan' => 250000,
                'keterangan'   => '24 sesi tatap muka bulan Oktober.',
                'program_id'   => $progJerman,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261105-11',
                'tanggal'      => '2026-11-05',
                'type'         => 'keluar',
                'jenis'        => 'Biaya Acara & Event',
                'deskripsi'    => 'Konsumsi & Perlengkapan Seminar Persiapan Wawancara Hotel Jerman',
                'satuan'       => 'Paket',
                'volume'       => 1,
                'harga_satuan' => 3250000,
                'keterangan'   => 'Hadir narasumber HR hotel mitra Munich & Berlin.',
                'program_id'   => $progJerman,
                'project_id'   => null,
            ],

            // --- PRG-2026-002: Culinary Art Batch 14 (Piutang / Belum Lunas) ---
            [
                'kode'         => 'KM-DM-20260912-12',
                'tanggal'      => '2026-09-12',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran SPP / Uang Kuliah',
                'deskripsi'    => 'Pembayaran DP & Termin 1 Kelas Culinary Batch 14',
                'satuan'       => 'Paket',
                'volume'       => 1,
                'harga_satuan' => 14500000,
                'keterangan'   => 'Pembayaran uang muka dan SPP semester awal.',
                'program_id'   => $progCulinary,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KM-DM-20261109-13',
                'tanggal'      => '2026-11-09',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran SPP / Uang Kuliah',
                'deskripsi'    => 'Tagihan Cicilan Termin 2 Mahasiswa Culinary Batch 14',
                'satuan'       => 'Paket',
                'volume'       => 1,
                'harga_satuan' => 4750000,
                'keterangan'   => 'Menunggu pelunasan termin kedua jatuh tempo akhir November.',
                'program_id'   => $progCulinary,
                'project_id'   => null,
                'is_piutang'   => true,
                'piutang_nama' => 'Made Arya & Kadek Rina',
            ],
            [
                'kode'         => 'KK-DM-20261104-14',
                'tanggal'      => '2026-11-04',
                'type'         => 'keluar',
                'jenis'        => 'Pembelian Bahan Praktik',
                'deskripsi'    => 'Belanja Bahan Baku Pastry, Daging & Bumbu Praktik Mingguan',
                'satuan'       => 'Lot',
                'volume'       => 4,
                'harga_satuan' => 1150000,
                'keterangan'   => 'Pengadaan rutin 4 minggu praktikum dapur.',
                'program_id'   => $progCulinary,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261009-15',
                'tanggal'      => '2026-10-09',
                'type'         => 'keluar',
                'jenis'        => 'Pembelian Perlengkapan Dapur',
                'deskripsi'    => 'Pengadaan Pisau Chef Set & Seragam Kitchen Mahasiswa Baru',
                'satuan'       => 'Set',
                'volume'       => 10,
                'harga_satuan' => 320000,
                'keterangan'   => 'Dibagikan kepada 10 mahasiswa peserta aktif.',
                'program_id'   => $progCulinary,
                'project_id'   => null,
            ],

            // --- PRG-2026-003: Perhotelan FO & HK 1 Tahun (Piutang / Belum Lunas) ---
            [
                'kode'         => 'KM-DM-20261016-16',
                'tanggal'      => '2026-10-16',
                'type'         => 'masuk',
                'jenis'        => 'Uang Pendaftaran Mahasiswa',
                'deskripsi'    => 'Pembayaran Registrasi & SPP Awal Kelas FO & HK 2026',
                'satuan'       => 'Orang',
                'volume'       => 10,
                'harga_satuan' => 1000000,
                'keterangan'   => 'Setoran awal dari 10 pendaftar terkonfirmasi.',
                'program_id'   => $progFoHk1Th,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KM-DM-20261110-17',
                'tanggal'      => '2026-11-10',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran SPP / Uang Kuliah',
                'deskripsi'    => 'Tagihan Cicilan Semester 1 Kelas FO & HK (Belum Lunas)',
                'satuan'       => 'Orang',
                'volume'       => 5,
                'harga_satuan' => 1700000,
                'keterangan'   => 'Sisa angsuran 5 mahasiswa yang dijadwalkan lunas bulan ini.',
                'program_id'   => $progFoHk1Th,
                'project_id'   => null,
                'is_piutang'   => true,
                'piutang_nama' => 'Komang Adi Saputra dkk (5 Siswa)',
            ],
            [
                'kode'         => 'KK-DM-20261022-18',
                'tanggal'      => '2026-10-22',
                'type'         => 'keluar',
                'jenis'        => 'Pembelian Bahan Praktik',
                'deskripsi'    => 'Chemical Housekeeping, Amenities Hotel & Linen Lab Praktik',
                'satuan'       => 'Paket',
                'volume'       => 2,
                'harga_satuan' => 1250000,
                'keterangan'   => 'Stok perlengkapan simulasi kamar Mockup Room.',
                'program_id'   => $progFoHk1Th,
                'project_id'   => null,
            ],

            // --- PRG-2026-004: Cook Kapal Pesiar (Lunas) ---
            [
                'kode'         => 'KM-DM-20261101-19',
                'tanggal'      => '2026-11-01',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran Biaya Sertifikasi',
                'deskripsi'    => 'Pelunasan Paket Pelatihan & Sertifikasi Cook Kapal Pesiar',
                'satuan'       => 'Orang',
                'volume'       => 8,
                'harga_satuan' => 2500000,
                'keterangan'   => '8 peserta melunasi paket lengkap sebelum praktik dimulai.',
                'program_id'   => $progCookKp,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261106-20',
                'tanggal'      => '2026-11-06',
                'type'         => 'keluar',
                'jenis'        => 'Gaji & Honor Dosen/Instruktur',
                'deskripsi'    => 'Honor Chef Instruktur & Asesor Uji Kompetensi Kapal Pesiar',
                'satuan'       => 'Jam',
                'volume'       => 16,
                'harga_satuan' => 225000,
                'keterangan'   => '16 jam praktik intensif standar galley internasional.',
                'program_id'   => $progCookKp,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261107-21',
                'tanggal'      => '2026-11-07',
                'type'         => 'keluar',
                'jenis'        => 'Pembelian Bahan Praktik',
                'deskripsi'    => 'Bahan Praktik Menu Continental & Asian Cruise Cuisine',
                'satuan'       => 'Paket',
                'volume'       => 3,
                'harga_satuan' => 1400000,
                'keterangan'   => 'Bahan protein seafood, beef cut, dan rempah western.',
                'program_id'   => $progCookKp,
                'project_id'   => null,
            ],

            // --- PRG-2026-005: Short Course F&B Service & Bar (Piutang / Belum Lunas) ---
            [
                'kode'         => 'KM-DM-20261102-22',
                'tanggal'      => '2026-11-02',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran SPP / Uang Kuliah',
                'deskripsi'    => 'DP Pendaftaran Workshop Barista & Bartender Ekspres',
                'satuan'       => 'Orang',
                'volume'       => 6,
                'harga_satuan' => 750000,
                'keterangan'   => 'Pembayaran tahap 1 (60% biaya workshop).',
                'program_id'   => $progBarista,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KM-DM-20261111-23',
                'tanggal'      => '2026-11-11',
                'type'         => 'masuk',
                'jenis'        => 'Penjualan Produk Praktik (F&B)',
                'deskripsi'    => 'Penjualan Kopi Espresso & Mocktail Bazar Praktik Mahasiswa',
                'satuan'       => 'Pcs',
                'volume'       => 60,
                'harga_satuan' => 25000,
                'keterangan'   => 'Hasil praktik mahasiswa saat Open House Kampus DHS.',
                'program_id'   => $progBarista,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KM-DM-20261111-24',
                'tanggal'      => '2026-11-11',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran SPP / Uang Kuliah',
                'deskripsi'    => 'Sisa Pelunasan Workshop Barista & Bartender (Belum Lunas)',
                'satuan'       => 'Orang',
                'volume'       => 3,
                'harga_satuan' => 500000,
                'keterangan'   => 'Kekurangan pelunasan 3 peserta menjelang ujian sertifikat.',
                'program_id'   => $progBarista,
                'project_id'   => null,
                'is_piutang'   => true,
                'piutang_nama' => 'Putu Eka & 2 Peserta Lain',
            ],
            [
                'kode'         => 'KK-DM-20261110-25',
                'tanggal'      => '2026-11-10',
                'type'         => 'keluar',
                'jenis'        => 'Pembelian Bahan Praktik',
                'deskripsi'    => 'Biji Kopi Arabika Specialty, Sirup Monin & Susu UHT Praktik Bar',
                'satuan'       => 'Lot',
                'volume'       => 2,
                'harga_satuan' => 950000,
                'keterangan'   => 'Bahan habis pakai kelas Barista & Mixology minggu ke-2.',
                'program_id'   => $progBarista,
                'project_id'   => null,
            ],

            // --- PRG-2026-006: SPA Therapist (Lunas) ---
            [
                'kode'         => 'KM-DM-20260815-26',
                'tanggal'      => '2026-08-15',
                'type'         => 'masuk',
                'jenis'        => 'Pembayaran SPP / Uang Kuliah',
                'deskripsi'    => 'Pelunasan Biaya Program Eksekutif SPA Therapist Batch 8',
                'satuan'       => 'Orang',
                'volume'       => 6,
                'harga_satuan' => 2000000,
                'keterangan'   => 'Seluruh 6 peserta telah melunasi biaya program.',
                'program_id'   => $progSpa,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20260910-27',
                'tanggal'      => '2026-09-10',
                'type'         => 'keluar',
                'jenis'        => 'Pembelian Bahan Praktik',
                'deskripsi'    => 'Paket Minyak Aromaterapi, Lulur Tradisional & Handuk Spa',
                'satuan'       => 'Set',
                'volume'       => 4,
                'harga_satuan' => 750000,
                'keterangan'   => 'Kebutuhan praktik Balinese Massage & Spa Treatment.',
                'program_id'   => $progSpa,
                'project_id'   => null,
            ],

            // --- Transaksi Program Langsung (Tanpa Entri Batch Khusus) ---
            [
                'kode'         => 'KM-DM-20261111-28',
                'tanggal'      => '2026-11-11',
                'type'         => 'masuk',
                'jenis'        => 'Uang Pendaftaran Mahasiswa',
                'deskripsi'    => 'Biaya Formulir Pendaftaran Calon Mahasiswa Tata Hidangan',
                'satuan'       => 'Orang',
                'volume'       => 4,
                'harga_satuan' => 250000,
                'keterangan'   => 'Pendaftaran langsung di front desk admisi DHS.',
                'program_id'   => $progTataHid,
                'project_id'   => null,
            ],
            [
                'kode'         => 'KK-DM-20261012-29',
                'tanggal'      => '2026-10-12',
                'type'         => 'keluar',
                'jenis'        => 'Biaya Marketing & Promosi',
                'deskripsi'    => 'Iklan Digital Instagram Ads & Cetak Brosur TAFE Australia Pathway',
                'satuan'       => 'Paket',
                'volume'       => 1,
                'harga_satuan' => 1800000,
                'keterangan'   => 'Kampanye promosi penerimaan jalur internasional Q4 2026.',
                'program_id'   => $progTafe,
                'project_id'   => null,
            ],
        ];

        foreach ($trxDefs as $row) {
            $jumlah = round($row['volume'] * $row['harga_satuan'], 2);
            KasTransaction::updateOrCreate(
                ['kode' => $row['kode']],
                [
                    'tanggal'          => $row['tanggal'],
                    'type'             => $row['type'],
                    'jenis'            => $row['jenis'],
                    'deskripsi'        => $row['deskripsi'],
                    'satuan'           => $row['satuan'],
                    'volume'           => $row['volume'],
                    'harga_satuan'     => $row['harga_satuan'],
                    'jumlah'           => $jumlah,
                    'keterangan'       => $row['keterangan'],
                    'program_id'       => $row['program_id'],
                    'project_id'       => $row['project_id'],
                    'is_piutang'       => $row['is_piutang'] ?? false,
                    'piutang_nama'     => $row['piutang_nama'] ?? null,
                    'piutang_lunas_at' => $row['piutang_lunas_at'] ?? null,
                    'created_by'       => $adminId,
                ]
            );
        }
    }
}

