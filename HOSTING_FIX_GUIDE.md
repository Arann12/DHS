# Fix Error dhs.or.id — Panduan untuk Senior

## Masalah
Website dhs.or.id mengalami error karena **database belum di-migrate** di hosting.

---

## Yang Perlu Dilakukan

### 1. Update `.env`
Buka File Manager → edit `.env` di root project:

```
APP_ENV=production
APP_DEBUG=false
```

Sisanya sudah benar (DB_DATABASE, DB_USERNAME, DB_PASSWORD, SESSION_DRIVER=database).

### 2. Jalankan Migration (PALING PENTING)

**Via Terminal (kalau ada):**
```bash
cd domains/dhs.or.id/public_html
php artisan migrate --force
php artisan db:seed --force
php artisan view:clear
php artisan cache:clear
```

**Via phpMyAdmin (kalau tidak ada Terminal):**
1. Buka phpMyAdmin di panel Hostinger
2. Pilih database `u128290195_dhs`
3. Klik tab **Import**
4. Pilih file `dhs_database.sql` (ada di root project)
5. Klik **Go/Import**

### 3. Set Folder Permissions
Pastikan folder ini writable (755):
- `storage/`
- `bootstrap/cache/`
- `public/uploads/`

### 4. Upload File yang Sudah Di-fix
Upload 3 file ini (replace yang lama):
- `resources/views/welcome.blade.php`
- `database/seeders/FaqSeeder.php`

---

## Setelah Fix, Cek:
- `https://dhs.or.id/` → homepage harus load
- `https://dhs.or.id/backoffice` → muncul form login (bukan 500 error)
- Login: `denpasarhotelschool` / `indoapps2026`
- `https://dhs.or.id/faq` → ada 8 FAQ
- `https://dhs.or.id/berita` → ada artikel

---

## Root Cause
`SESSION_DRIVER=database` tapi tabel `sessions` belum dibuat → semua request gagal → 500 error.
