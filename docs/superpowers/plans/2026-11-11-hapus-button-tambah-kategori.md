# Hapus Button Tambah Kategori Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Hapus button `Tambah Kategori` dari halaman `Keuangan Program` tanpa mengubah fitur kategori lain.

**Architecture:** Hapus satu blok markup button dari view Blade yang menampilkan top bar halaman. Link `Kelola Kategori & Program`, route, modal, dan backend tetap utuh.

**Tech Stack:** Laravel Blade, HTML, Git.

**Spec:** `docs/superpowers/specs/2026-11-11-hapus-button-tambah-kategori-design.md`

## Global Constraints

- Perubahan hanya pada `resources/views/backoffice/kas-keuangan-program.blade.php`.
- Pertahankan link `Kelola Kategori &amp; Program`.
- Jangan hapus route, modal, atau logic backend.

## Review Focus

- Button `Tambah Kategori` tidak lagi dirender di top bar.
- Link `Kelola Kategori &amp; Program` tetap dirender.
- Struktur Blade tetap valid setelah blok button dihapus.

---

### Task 1: Hapus button duplikat dari view Keuangan Program

**Files:**
- Modify: `resources/views/backoffice/kas-keuangan-program.blade.php:85-88`
- Test: tidak perlu menambah file test; verifikasi dilakukan lewat pemeriksaan view dan diff karena perubahan berupa penghapusan markup statis.

**Interfaces:**
- Consumes: markup top bar halaman Keuangan Program.
- Produces: top bar tanpa button `Tambah Kategori`, dengan link `Kelola Kategori &amp; Program` tetap ada.

- [ ] **Step 1: Hapus blok button `Tambah Kategori`**

  Hapus elemen `<button>` pada baris 85-88, termasuk icon `add_circle` dan teks `Tambah Kategori`. Jangan mengubah elemen lain dalam top bar.

- [ ] **Step 2: Verifikasi hasil perubahan**

  Run: `git diff --check`

  Expected: tidak ada whitespace error.

  Run: `git diff -- resources/views/backoffice/kas-keuangan-program.blade.php`

  Expected: diff hanya menghapus blok button `Tambah Kategori`; link `Kelola Kategori &amp; Program` tetap ada.

- [ ] **Step 3: Commit perubahan**

  Commit only after user requests commit; current request does not request commit.
