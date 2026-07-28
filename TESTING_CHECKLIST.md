# Testing Checklist - DHS Laravel Project

## 📋 Checklist Testing Setelah Bug Fix

Gunakan checklist ini untuk memastikan semua fungsi berjalan dengan baik setelah perbaikan bug.

---

## 🔐 **1. Authentication & Session**

### Login Backoffice
- [ ] Buka `/backoffice` tanpa login → harus redirect ke halaman login
- [ ] Login dengan username salah → harus muncul error "Username atau password salah"
- [ ] Login dengan password salah → harus muncul error "Username atau password salah"
- [ ] Login dengan username & password benar → harus masuk ke dashboard
- [ ] Check session tersimpan di browser (inspect cookies/session storage)
- [ ] Activity log mencatat login dengan benar

### Logout
- [ ] Klik logout → redirect ke halaman login
- [ ] Session terhapus (tidak bisa akses dashboard lagi tanpa login ulang)
- [ ] Activity log mencatat logout dengan benar

### Session Expired/Security
- [ ] Hapus session manual di browser → akses `/backoffice/dashboard` harus redirect ke login
- [ ] AJAX request tanpa session → return 401 Unauthorized
- [ ] Akses route POST tanpa session → redirect ke login

---

## 👥 **2. User Management** (BUG #1 FIX)

### Create User Baru
- [ ] Buka `/backoffice/users`
- [ ] Klik "Tambah User"
- [ ] Isi form:
  - Nama: `Test User`
  - **Username: `testuser`** ← **WAJIB DIISI**
  - Email: `test@example.com`
  - Password: `password123`
  - Role: `Editor`
- [ ] Klik Submit → user berhasil dibuat
- [ ] Check database: `SELECT * FROM users WHERE username='testuser'` → **username harus tersimpan**
- [ ] Logout dan login dengan username `testuser` → **harus berhasil login** ✅

### Update User
- [ ] Edit user yang sudah ada
- [ ] Ubah username → harus tersimpan
- [ ] Ubah data lain (name, email, role) → harus tersimpan
- [ ] Ubah password → hash tersimpan dengan benar

### Delete User
- [ ] Hapus user (bukan user yang sedang login)
- [ ] User terhapus dari database
- [ ] Activity log mencatat delete

---

## 📝 **3. Pendaftar/Registration** (BUG #3 FIX)

### Status Update
- [ ] Buka `/backoffice/pendaftar`
- [ ] Pilih salah satu pendaftar
- [ ] Ubah status dropdown ke **"Baru"** → simpan
- [ ] Check database: `SELECT status FROM registrations WHERE id=...` → harus `pending` ✅
- [ ] Ubah status ke **"Diproses"** → database harus `verified` ✅
- [ ] Ubah status ke **"Diterima"** → database harus `accepted` ✅
- [ ] Ubah status ke **"Ditolak"** → database harus `rejected` ✅

### Export CSV (BUG #6 FIX)
- [ ] Klik "Export Excel"
- [ ] File CSV terdownload dengan nama `data_pendaftar_dhs_YYYY-MM-DD_HHMMSS.csv`
- [ ] Buka CSV di Excel → encoding UTF-8 benar (karakter Indonesia tidak rusak)
- [ ] Kolom "Sumber Informasi" menampilkan data dengan benar (tidak ada string "[object Object]" atau error)
- [ ] Semua data lengkap dan sesuai dengan database

### Detail Modal
- [ ] Klik icon "View Detail" (mata)
- [ ] Modal popup muncul dengan data lengkap
- [ ] Bukti pembayaran (gambar) ditampilkan dengan benar
- [ ] Link WhatsApp berfungsi
- [ ] Tombol "Tutup" menutup modal

---

## 📰 **4. Berita/News Management**

### Create Berita
- [ ] Buka `/backoffice/berita`
- [ ] Klik "Tambah Berita"
- [ ] Isi semua field (title, kategori, excerpt, content)
- [ ] Upload thumbnail atau paste URL gambar
- [ ] Set status "Dipublikasikan" → otomatis isi `published_at`
- [ ] Check `is_featured` → flag tersimpan
- [ ] Berita muncul di homepage frontend

### Update & Delete
- [ ] Edit berita → perubahan tersimpan
- [ ] Delete berita → terhapus dari database
- [ ] Activity log mencatat operasi

---

## 🎓 **5. Program Management**

### Create Program
- [ ] Buka `/backoffice/program`
- [ ] Tambah program baru dengan kategori
- [ ] Upload thumbnail atau paste URL
- [ ] Set `is_active` dan `is_featured`
- [ ] Program muncul di halaman `/akademi` frontend

### Update & Delete
- [ ] Edit program → perubahan tersimpan
- [ ] Delete program → terhapus dengan cascade ke relasi

---

## 🏠 **6. Beranda/Homepage CMS**

### Update Section
- [ ] Buka `/backoffice/beranda`
- [ ] Edit section "Hero" → ubah title atau subtitle
- [ ] Simpan → refresh homepage frontend → perubahan terlihat
- [ ] Edit section lain (About, Vision, dll) → semua berfungsi
- [ ] JSON content tersimpan dengan benar di database

---

## 🎨 **7. Branding & Color Palette**

### Branding
- [ ] Upload logo baru → file tersimpan di `/public/image/`
- [ ] Logo ditampilkan di frontend

### Color Palette (Bug Prevention)
- [ ] Ubah warna dengan color picker
- [ ] Validasi hex color berfungsi (`#RRGGBB` format)
- [ ] Warna tersimpan di database
- [ ] (Opsional) CSS variable terupdate di frontend

---

## 📊 **8. Other Modules**

### Statistik
- [ ] Create statistik baru → tersimpan
- [ ] Update nilai statistik → perubahan tersimpan
- [ ] Delete statistik → terhapus

### Galeri
- [ ] Upload foto atau paste URL
- [ ] Foto muncul di frontend homepage/galeri page
- [ ] Update & delete berfungsi

### Testimoni
- [ ] Tambah testimoni dengan/tanpa foto
- [ ] Set `is_featured` → muncul di homepage
- [ ] Rating bintang tersimpan (1-5)

### FAQ
- [ ] Tambah pertanyaan dengan kategori
- [ ] FAQ dikelompokkan per kategori di frontend
- [ ] Update & delete berfungsi

### Navigasi Menu
- [ ] Tambah menu header/footer
- [ ] Menu muncul di frontend
- [ ] Nested menu (parent-child) berfungsi

### Footer CMS
- [ ] Update kontak helpdesk (WA, Email, Jam Kerja)
- [ ] Perubahan tersimpan dan muncul di form pendaftaran

---

## 🛡️ **9. Security & Middleware** (BUG #4 & #5 FIX)

### Middleware Protection
- [ ] Logout dari backoffice
- [ ] Coba akses langsung ke URL berikut tanpa login:
  - `/backoffice/dashboard` → redirect ke login ✅
  - `/backoffice/berita` → redirect ke login ✅
  - `/backoffice/users` → redirect ke login ✅

### AJAX Request Protection
- [ ] Logout dan buka browser console
- [ ] Jalankan:
  ```javascript
  fetch('/backoffice/berita/store', {
    method: 'POST',
    headers: {'X-Requested-With': 'XMLHttpRequest'}
  }).then(r => r.json()).then(console.log)
  ```
- [ ] Response harus `{"error": "Unauthorized"}` dengan status 401 ✅

### CSRF Protection
- [ ] Semua form POST memiliki `@csrf` token
- [ ] POST request tanpa token → 419 CSRF token mismatch error

---

## 📱 **10. Frontend Public Pages**

### Homepage
- [ ] `/` → homepage load dengan benar
- [ ] Statistik, program featured, berita featured tampil
- [ ] Testimoni carousel berfungsi
- [ ] Galeri foto load

### Other Pages
- [ ] `/tentang-kami` → load dengan benar
- [ ] `/akademi` → list program per kategori tampil
- [ ] `/berita` → list berita + pagination + search berfungsi
- [ ] `/faq` → FAQ grouped by category
- [ ] `/karier` → mitra industri tampil
- [ ] `/cara-mendaftar` atau `/formulir-pendaftaran` → form tampil

### Registration Form
- [ ] Isi form pendaftaran lengkap
- [ ] Upload bukti bayar (pendaftaran & program)
- [ ] Submit → data masuk ke database `registrations`
- [ ] Status default = `pending` ✅
- [ ] Success message muncul dengan nama pendaftar

---

## 🔍 **11. Activity Log**

### Log Tracking
- [ ] Setiap operasi create/update/delete tercatat di `activity_logs`
- [ ] User ID, action, table_name, record_id tersimpan
- [ ] Old data & new data (JSON) tersimpan untuk update
- [ ] IP address & user agent tercatat
- [ ] Dashboard menampilkan 10 aktivitas terbaru

---

## ⚡ **12. Performance & Cache**

### Cache Commands
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
- [ ] Aplikasi masih berfungsi setelah cache
- [ ] Tidak ada error 500 atau white screen

### Clear Cache
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```
- [ ] Perubahan di `.env` terdeteksi setelah clear cache

---

## 🐛 **Bug Regression Check**

### Verifikasi Bug Tidak Kembali
- [x] **Bug #1:** Username field tersimpan saat create user ✅
- [x] **Bug #2:** Migration file terdokumentasi ✅
- [x] **Bug #3:** Status mapping benar (Baru→pending, dll) ✅
- [x] **Bug #4:** Guard redirect tidak throw exception ✅
- [x] **Bug #5:** Middleware protection aktif ✅
- [x] **Bug #6:** Export CSV tidak double decode ✅

---

## ✅ **Final Checklist**

### Production Readiness
- [ ] Semua test di atas PASSED
- [ ] Tidak ada PHP error di log (`storage/logs/laravel.log`)
- [ ] Database connection stabil
- [ ] File uploads berfungsi (permissions 755 untuk `public/uploads/`)
- [ ] `.env` configuration benar untuk environment
- [ ] App key sudah di-generate (`APP_KEY` di `.env`)
- [ ] HTTPS ready (jika deploy)

### Documentation
- [ ] Baca `BUG_FIXES_REPORT.md` untuk detail teknis
- [ ] Baca `QUICK_START_AFTER_BUGFIX.md` untuk setup
- [ ] Backup database sebelum deployment

---

## 📝 Notes

### Jika Ada Issue:
1. Check `storage/logs/laravel.log` untuk error details
2. Check browser console untuk JavaScript errors
3. Verify `.env` configuration
4. Clear cache: `php artisan optimize:clear`
5. Check file permissions (storage & bootstrap/cache harus writable)

### Priority Testing:
🔴 **HIGH:** Authentication, User Management, Status Mapping  
🟡 **MEDIUM:** CRUD operations, Export CSV  
🟢 **LOW:** UI/UX details, minor features

---

**Testing Date:** _________________  
**Tested By:** _________________  
**Result:** ☐ PASSED  ☐ FAILED  
**Notes:** _________________________________________________

---

Happy Testing! 🎉
