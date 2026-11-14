# Desain Daftar Transaksi Padat

## Intent

Ubah daftar transaksi keuangan agar terbaca seperti tabel pada screenshot: semua informasi utama tampil dalam satu tabel desktop tanpa scroll horizontal.

## Goals

- Tampilkan kolom utama: kode, tanggal, tipe, judul/penerima, program, nominal, metode, status, aksi.
- Gabungkan informasi sekunder ke dalam sel yang sama agar tabel tetap ringkas.
- Pertahankan fungsi filter, sorting, detail, edit, bayar/cicil piutang, bukti, dan hapus.
- Gunakan modal detail untuk informasi panjang dan bukti transaksi.
- Pada layar kecil, ubah tabel menjadi layout kartu agar tidak memaksa scroll horizontal.

## Non-goals

- Tidak mengubah struktur database atau alur pencatatan transaksi.
- Tidak mengubah perhitungan saldo, piutang, DP, atau laporan CSV.
- Tidak menambah dependency frontend.

## Anti-goals

- Jangan menghapus informasi transaksi.
- Jangan menyembunyikan aksi penting hanya karena tabel dipadatkan.
- Jangan membuat teks terlalu kecil untuk dibaca.

## Approach

Alternatif yang dipertimbangkan:

1. **Tabel padat seperti screenshot — dipilih.** Gabungkan kode+tanggal, deskripsi+kategori+penerima, nominal+detail pembayaran, serta status+metode. Paling sesuai permintaan dan memakai modal detail yang sudah ada.
2. **Mempertahankan semua kolom lama.** Perubahan kecil, tetapi tetap membutuhkan scroll dan tidak mencapai tujuan.
3. **Tabel minimal dengan semua detail di modal.** Lebih bersih, tetapi informasi penting terlalu tersembunyi.

## Design

- `kas.blade.php`: tabel umum menjadi sembilan kolom padat.
- `kas-program.blade.php`: daftar transaksi kategori memakai struktur kolom padat yang sama.
- `kas-program-detail.blade.php`: daftar pemasukan, pengeluaran, dan piutang memakai struktur padat sesuai konteks.
- Kolom aksi tetap memakai tombol ikon dengan `title` dan `aria-label`.
- Tabel memakai `table-layout: fixed`, lebar kolom eksplisit, padding ringkas, dan wrapping terkontrol.
- Tidak memakai `overflow-x:auto` pada tabel desktop.
- Media query di bawah lebar laptop mengubah baris menjadi kartu atau mengatur ulang grid agar tidak ada scroll halaman.

## Constraints

- Laravel Blade + Alpine.js yang sudah dipakai project.
- CSS inline/style block boleh diperbarui; dependency baru tidak diperlukan.
- Perubahan harus menjaga data binding Alpine dan route yang sudah ada.

## Builder calls

- Gunakan kelas CSS lokal agar tiga halaman konsisten.
- Pertahankan modal detail yang sudah ada; hanya ubah isi/trigger bila diperlukan.
- Tambahkan satu regression test yang memastikan struktur tabel padat dan tidak mengandung wrapper horizontal pada daftar utama.
