# Hapus Button Tambah Kategori

- **Tujuan:** Hilangkan button `Tambah Kategori` dari halaman `Keuangan Program` agar pengelolaan kategori terpusat di halaman `Kategori & Program`.
- **Scope:** Hapus markup button di `resources/views/backoffice/kas-keuangan-program.blade.php`; pertahankan link `Kelola Kategori & Program`, route, modal, dan backend.
- **Pendekatan:** Hapus button saja. Menghapus modal atau logic backend tidak perlu dan berisiko mengubah alur lain.
- **Verifikasi:** Periksa diff dan jalankan pemeriksaan ringan terhadap view terkait.
