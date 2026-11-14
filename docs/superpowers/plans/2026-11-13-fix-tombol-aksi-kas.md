# Fix Tombol Aksi Kas Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Aktifkan tombol detail, edit, dan hapus pada daftar transaksi kas, lalu hapus tombol print yang tidak diperlukan.

**Architecture:** Pertahankan Alpine.js sebagai pengelola state dan modal. Telusuri bootstrap Alpine pada layout, perbaiki hanya titik runtime yang terbukti gagal, lalu hapus markup tombol print dari tabel kas umum.

**Tech Stack:** Laravel Blade, Alpine.js 3.14.1, PHPUnit.

**Spec:** `docs/superpowers/specs/2026-11-13-fix-tombol-aksi-kas-design.md`

## Global Constraints

- Pertahankan Alpine dan handler yang sudah ada.
- Perubahan sesedikit mungkin pada layout dan view kas.
- Tidak mengubah endpoint CRUD.
- Tombol print/kwitansi tidak dirender pada daftar transaksi.

## Review Focus

- Halaman kas tanpa Alpine aktif: tombol `x-on:click` harus tetap memiliki runtime Alpine setelah perbaikan bootstrap; verifikasi lewat smoke check browser atau pemeriksaan halaman.
- Tombol print tidak boleh muncul lagi di tabel kas umum; tes view harus memastikan markup `title="Cetak"` tidak ada.
- Detail, edit, dan hapus harus tetap terpasang; tes view mempertahankan handler `openDetail(item)`, `openModal('edit', item)`, dan `deleteItem(item.id)`.
- Penghapusan transaksi harus tetap memakai endpoint existing `/backoffice/kas/{id}/delete`; tes view mempertahankan action form/handler existing.
- Halaman kas-program dan kas-program-detail tidak ikut kehilangan aksi; tes compact table existing tetap dijalankan.

---

### Task 1: Pin down transaction action contract

**Files:**
- Modify: `tests/Unit/CompactTransactionTableTest.php`
- Test: `tests/Unit/CompactTransactionTableTest.php`

**Interfaces:**
- Consumes: Existing Blade action markup.
- Produces: PHPUnit assertions locking required actions and removed print action.

- [ ] **Step 1: Add failing assertions**

Update `test_transaction_tables_keep_actions_and_empty_state()` for `kas.blade.php`:
- assert `openDetail(item)` remains;
- assert `openModal('edit', item)` remains;
- assert `deleteItem(item.id)` remains;
- assert `title="Cetak"` is absent.

- [ ] **Step 2: Run focused test**

Run:
```powershell
php artisan test tests/Unit/CompactTransactionTableTest.php
```
Expected: FAIL only on the new absence assertion because current `kas.blade.php` still contains the print button.

- [ ] **Step 3: Keep test assertions minimal**

Do not add browser-driver dependencies or test unrelated modal implementation. Existing compact-table assertions remain unchanged.

- [ ] **Step 4: Run focused test after implementation task**

Run the same command after Task 2. Expected: PASS.

### Task 2: Fix Alpine action runtime and remove print action

**Files:**
- Modify: `resources/views/backoffice/layouts/app.blade.php:302-325`
- Modify: `resources/views/backoffice/kas.blade.php:180-186`

**Interfaces:**
- Consumes: Alpine 3.14.1 CDN bootstrap, `kasData()` component, existing action methods.
- Produces: Initialized Alpine runtime for backoffice pages and kas table with only detail/edit/delete actions.

- [ ] **Step 1: Reproduce runtime failure before code change**

Open `/backoffice/kas` while authenticated and inspect browser console. Record whether `Alpine`, `kasData`, or an Alpine expression error fails. If server startup is needed, use the project run workflow. Do not change code before recording evidence.

- [ ] **Step 2: Implement smallest bootstrap fix based on evidence**

Keep Alpine loaded once at `https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js` with `defer`. Ensure the `alpine:init` listener registering `Alpine.store('imageUpload', ...)` is registered before Alpine initialization and does not throw. Do not rewrite page handlers.

- [ ] **Step 3: Remove print button only**

In `resources/views/backoffice/kas.blade.php`, delete the button whose title is `Cetak` and whose click handler is `openDetail(item)`. Keep the adjacent detail button with title `Detail Transaksi`, edit button, and delete button unchanged.

- [ ] **Step 4: Run focused PHPUnit test**

Run:
```powershell
php artisan test tests/Unit/CompactTransactionTableTest.php
```
Expected: PASS.

- [ ] **Step 5: Run Blade/runtime smoke check**

Start the app through the project run workflow, open `/backoffice/kas`, and click:
1. eye icon — detail modal appears;
2. pencil icon — edit modal appears;
3. trash icon — delete confirmation appears.

Expected: no Alpine console error, no print icon in action column, and each remaining action responds.

### Task 3: Full verification

**Files:**
- No new files.

**Interfaces:**
- Consumes: Changes from Tasks 1-2.
- Produces: Verified working tree with focused and regression tests passing.

- [ ] **Step 1: Run related test suite**

Run:
```powershell
php artisan test tests/Unit/CompactTransactionTableTest.php tests/Unit/LogoutModalTest.php
```
Expected: PASS.

- [ ] **Step 2: Check changed diff**

Run:
```powershell
git diff --check
```
Expected: no output and exit code 0.

- [ ] **Step 3: Review final diff**

Confirm only intended Alpine bootstrap adjustment, test contract, and print-button removal changed. Do not commit unless explicitly requested.
