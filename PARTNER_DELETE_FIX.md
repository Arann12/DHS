# Fix: Error Hapus Partnership

## Masalah
Terjadi error ketika mencoba menghapus data partner/partnership dari halaman backoffice.

## Penyebab
1. **Request format tidak sesuai**: Fungsi JavaScript `confirmDeleteItem()` mengirim request dengan `Content-Type: application/json` dan body JSON, tetapi endpoint Laravel mengharapkan form data POST biasa.
2. **Schema database error**: Index pada tabel `partners` mereferensi kolom `group` yang tidak ada, seharusnya `partner_group`.

## Solusi Yang Diterapkan

### 1. Perbaikan JavaScript (resources/views/backoffice/partner.blade.php)
**Sebelum:**
```javascript
confirmDeleteItem() {
    fetch(`/backoffice/partner/${this.confirmDelete.targetId}/delete`, {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json', 
            'Accept': 'application/json', 
            'X-CSRF-TOKEN': '{{ csrf_token() }}', 
            'X-Requested-With': 'XMLHttpRequest' 
        },
        body: JSON.stringify({ id: this.confirmDelete.targetId })
    })
    // ...
}
```

**Sesudah:**
```javascript
confirmDeleteItem() {
    const fd = new FormData();
    fd.append('_token', '{{ csrf_token() }}');
    
    fetch(`/backoffice/partner/${this.confirmDelete.targetId}/delete`, {
        method: 'POST',
        body: fd
    }).then(r => {
        if (r.ok) { 
            location.reload(); 
        } else { 
            r.json()
                .then(j => alert('Gagal: ' + (j.message || j.error || 'Unknown error')))
                .catch(() => r.text().then(t => alert('Gagal menghapus: ' + t)));
        }
    }).catch(() => alert('Terjadi kesalahan jaringan.'));
}
```

### 2. Perbaikan Schema Database (database/schema.sql)
**Sebelum:**
```sql
INDEX idx_group (group),
```

**Sesudah:**
```sql
INDEX idx_partner_group (partner_group),
```

## Verifikasi
- ✅ Controller `partnerDestroy()` sudah benar
- ✅ Route `/backoffice/partner/{id}/delete` sudah terdaftar
- ✅ Model `Partner` tidak memiliki foreign key constraint yang memblokir penghapusan
- ✅ Request sekarang menggunakan FormData dengan CSRF token
- ✅ Error handling ditingkatkan untuk menampilkan pesan error yang lebih informatif

## Testing
Setelah perubahan ini:
1. Buka halaman `/backoffice/partner`
2. Klik tombol hapus pada salah satu partner
3. Konfirmasi penghapusan
4. Data partner seharusnya berhasil dihapus dan halaman reload otomatis

## File Yang Dimodifikasi
- `resources/views/backoffice/partner.blade.php` - Perbaikan fungsi delete
- `database/schema.sql` - Perbaikan nama index

## Catatan
Jika schema database sudah di-apply ke database production, perlu menjalankan migration atau ALTER TABLE untuk memperbaiki index yang salah:

```sql
ALTER TABLE partners DROP INDEX idx_group;
ALTER TABLE partners ADD INDEX idx_partner_group (partner_group);
```
