# Fix Tombol Aksi Kas

## Intent
Membuat tombol detail, edit, dan hapus pada daftar transaksi kas merespons klik. Tombol print dihapus karena tidak diperlukan.

## Goals
- Alpine berjalan pada halaman kas dan mengaktifkan `x-on:click`.
- Tombol mata membuka detail transaksi.
- Tombol pensil membuka modal edit.
- Tombol sampah membuka konfirmasi hapus.
- Tombol print tidak lagi dirender pada daftar transaksi.

## Non-goals
- Tidak mengubah endpoint CRUD.
- Tidak mengubah format modal, validasi, atau desain tabel selain menghapus tombol print.
- Tidak mengubah halaman kwitansi lain.

## Constraints
- Pertahankan Alpine dan handler yang sudah ada.
- Perubahan sesedikit mungkin pada layout dan view kas.
- Verifikasi dengan tes yang relevan dan pemeriksaan runtime halaman.

## Approaches
1. **Perbaiki bootstrap Alpine (dipilih)** — telusuri dan perbaiki titik load/init Alpine yang membuat handler tidak aktif; pertahankan handler existing. Paling kecil dan menghindari duplikasi.
2. JavaScript native per tombol — tidak dipilih karena menduplikasi state/modal Alpine.
3. Ubah semua aksi menjadi link/form langsung — tidak dipilih karena menghilangkan modal detail, edit, dan konfirmasi hapus.

## Implementation call
Periksa error runtime halaman kas, perbaiki akar masalah bootstrap/init Alpine, hapus markup tombol `print` dari `resources/views/backoffice/kas.blade.php`, lalu jalankan tes dan smoke check halaman.
