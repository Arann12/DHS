# Daftar Transaksi Padat Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Ubah daftar transaksi keuangan menjadi tabel padat seperti screenshot, tanpa scroll horizontal desktop, sambil mempertahankan seluruh fungsi transaksi.

**Architecture:** Pakai CSS lokal bersama untuk tabel padat, lalu ubah markup tiga halaman keuangan agar memakai sembilan kolom informasi utama. Detail panjang tetap berada di modal yang sudah ada; mobile memakai layout responsif tanpa mengubah data atau route.

**Tech Stack:** Laravel Blade, Alpine.js, CSS inline/style block, PHPUnit.

**Spec:** `docs/superpowers/specs/2026-11-12-daftar-transaksi-padat-design.md`

## Global Constraints

- Tidak mengubah struktur database atau alur pencatatan transaksi.
- Tidak mengubah perhitungan saldo, piutang, DP, atau laporan CSV.
- Tidak menambah dependency frontend.
- Pertahankan modal detail, filter, sorting, bukti, edit, bayar/cicil, dan hapus.
- Desktop tidak memakai `overflow-x:auto` pada tabel transaksi utama.
- Mobile tidak boleh memunculkan scroll horizontal halaman.

## Review Focus

- Teks panjang pada deskripsi, nama siswa, kategori, dan program harus wrap tanpa merusak lebar tabel; test markup memakai kelas compact.
- Piutang dan transaksi lunas harus tetap membedakan warna/status; test memastikan binding status tetap ada.
- Tombol aksi harus tetap dapat diakses dengan keyboard dan memiliki `title`/`aria-label`; test mencari label aksi.
- Tabel kosong harus tetap menampilkan pesan kosong dengan colspan yang sesuai; test memeriksa struktur placeholder.
- Tiga halaman harus memakai pola tabel konsisten tanpa menghapus modal/detail; test memeriksa ketiga file.

---

### Task 1: Add shared compact transaction table styles and regression test

**Files:**
- Modify: `resources/views/backoffice/layouts/app.blade.php` or page-local style blocks as needed
- Create: `tests/Unit/CompactTransactionTableTest.php`

**Interfaces:**
- Produces CSS class contract: `.kas-transaction-table`, `.kas-transaction-table th`, `.kas-transaction-table td`, `.kas-transaction-table .kas-transaction-main`, `.kas-transaction-table .kas-transaction-meta`, `.kas-transaction-actions`.

- [ ] **Step 1: Write failing test**

Assert `kas.blade.php`, `kas-program.blade.php`, and `kas-program-detail.blade.php` contain `kas-transaction-table`, contain compact action labels, and do not contain horizontal-scroll wrappers immediately around their primary transaction tables.

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=CompactTransactionTableTest`
Expected: FAIL because current pages use `bo-table` and horizontal wrappers.

- [ ] **Step 3: Implement minimal shared styles**

Add reusable CSS in the existing backoffice layout or a single existing finance style block. Use fixed/controlled column widths, `overflow-wrap:anywhere`, compact padding, readable minimum font size, and a mobile breakpoint that stacks rows/cards without page-level horizontal overflow.

- [ ] **Step 4: Run test**

Expected: still fail until page markup adopts class.

---

### Task 2: Convert general finance transaction list

**Files:**
- Modify: `resources/views/backoffice/kas.blade.php:110-230`
- Test: `tests/Unit/CompactTransactionTableTest.php`

**Interfaces:**
- Consumes existing Alpine `filtered`, `openDetail`, `lunasPiutang`, `openModal`, and `deleteItem` bindings.
- Produces nine visible columns: `Kode`, `Tanggal`, `Tipe`, `Judul / Penerima`, `Program`, `Nominal`, `Metode`, `Status`, `Aksi`.

- [ ] **Step 1: Add assertions for general table fields**

Assert the file contains the nine headings, keeps `openDetail(item)`, `lunasPiutang(item)`, `openModal('edit', item)`, and `deleteItem(item.id)`, and keeps an empty-state row.

- [ ] **Step 2: Run focused test and verify failure**

Run: `php artisan test --filter=CompactTransactionTableTest`
Expected: FAIL for missing compact headings/class.

- [ ] **Step 3: Replace only table markup**

Combine existing fields without changing Alpine data:
- code/date in separate compact cells;
- type badge from `item.type`;
- description, category, and `piutang_nama` in title/recipient cell;
- program/project label in program cell;
- amount plus unit/price detail in nominal cell;
- payment-mode text from existing `payment_mode`/piutang state in method cell;
- DP/piutang/lunas badge in status cell;
- action buttons retain existing handlers and add `aria-label`.

Remove the table’s `overflow-x:auto` wrapper. Keep detail modal unchanged.

- [ ] **Step 4: Run focused test**

Expected: general finance assertions PASS.

---

### Task 3: Convert category/program transaction list

**Files:**
- Modify: `resources/views/backoffice/kas-program.blade.php:226-326`
- Test: `tests/Unit/CompactTransactionTableTest.php`

**Interfaces:**
- Consumes existing `filtered`, `lunasPiutang`, `openModal`, and `deleteItem` Alpine bindings.
- Produces the same compact headings and action behavior as Task 2.

- [ ] **Step 1: Add category table assertions**

Assert compact class, nine headings, piutang binding, edit/delete bindings, and empty state.

- [ ] **Step 2: Run test to verify failure**

Run: `php artisan test --filter=CompactTransactionTableTest`
Expected: FAIL before markup conversion.

- [ ] **Step 3: Convert markup**

Collapse existing ten columns into the compact nine-column structure. Keep program/category context visible in program and title cells, preserve piutang status and existing action buttons, remove horizontal-scroll wrapper.

- [ ] **Step 4: Run focused test**

Expected: category table assertions PASS.

---

### Task 4: Convert program-detail transaction tables

**Files:**
- Modify: `resources/views/backoffice/kas-program-detail.blade.php:272-503`
- Test: `tests/Unit/CompactTransactionTableTest.php`

**Interfaces:**
- Consumes server-rendered `$pemasukanList`, `$pengeluaranList`, and pending piutang lists.
- Produces compact tables for pemasukan, pengeluaran, and piutang with existing payment/delete actions.

- [ ] **Step 1: Add detail table assertions**

Assert all three table contexts use the compact table class, keep `openPayPiutang`/`deleteTrx`, preserve empty-state rows, and retain evidence links.

- [ ] **Step 2: Run test to verify failure**

Run: `php artisan test --filter=CompactTransactionTableTest`
Expected: FAIL before conversion.

- [ ] **Step 3: Convert all three table markup blocks**

Use compact cells for date/code, type/context, title/recipient, category/program, amount/payment status, evidence, and actions. Keep route/action handlers unchanged. Remove horizontal-scroll wrappers only from transaction tables.

- [ ] **Step 4: Run focused test**

Expected: all detail assertions PASS.

---

### Task 5: Full verification

**Files:**
- Test: `tests/Unit/CompactTransactionTableTest.php`

- [ ] **Step 1: Run focused tests**

Run: `php artisan test --filter='CompactTransactionTableTest|AuthControllerTest|BackofficeAuthTest|BackofficePasswordTest|LogoutModalTest'`
Expected: all tests pass.

- [ ] **Step 2: Compile Blade views**

Run: `php artisan view:clear && php artisan view:cache`
Expected: Blade cache compiles successfully.

- [ ] **Step 3: Run syntax and diff checks**

Run: `php -l app/Http/Controllers/BackofficeController.php && git diff --check`
Expected: PHP syntax valid. Existing unrelated whitespace findings must be reported if present.

- [ ] **Step 4: Review diff**

Confirm only transaction presentation changed; no route, controller, database, or payment behavior changed.
