# DHS — Panduan & Prompt: Antigravity + Stitch MCP (Frontend Only)

> Dokumen ini untuk tahap eksekusi: mengubah UI/UX yang sudah difinalisasi 
> menjadi kode frontend nyata, menggunakan Antigravity (IDE agent-first 
> dari Google) yang terhubung ke Stitch lewat MCP. Backend/fungsionalitas 
> BELUM dibahas di sini — fokus murni ke tampilan & navigasi antar halaman.

---

## 0. Prasyarat

- [ ] Stitch MCP server sudah terpasang & terkoneksi di Antigravity (API key dari `stitch.withgoogle.com/settings`)
- [ ] Install skill tambahan (via terminal Antigravity):
  ```bash
  npx skills add google-labs-code/stitch-skills --skill design-md --global
  npx skills add google-labs-code/stitch-skills --skill stitch-loop --global
  ```
- [ ] Siapkan file `design.md` (sudah kita buat & update palet warna barunya) dan `page-prompts.md` — taruh keduanya di root folder project supaya agent bisa membacanya sebagai konteks

---

## 1. Kenapa design.md tetap perlu (bukan cuma opsional)

`design-md` adalah skill resmi dari Google untuk workflow ini — dia menghasilkan/membaca `DESIGN.md` yang jadi **satu-satunya sumber kebenaran** (single source of truth) untuk seluruh sistem desain: warna, tipografi, spacing, komponen. Tanpa ini, tiap kali `stitch-loop` generate halaman baru, ada risiko warna/font/komponen sedikit "melenceng" dari halaman sebelumnya karena agent menebak ulang dari nol tiap generate. Jadi jawabannya: **ya, wajib dipakai**, bukan cuma nice-to-have — ini justru mencegah masalah "desain halaman baru tidak 100% konsisten" yang sempat kita bahas soal Google Stitch sebelumnya.

---

## 2. Langkah Eksekusi di Antigravity

### Langkah 1 — Import design system
Di chat Antigravity, prompt pertama:

```
Baca file design.md dan page-prompts.md di root project ini. Gunakan skill 
design-md untuk mengubah isinya menjadi DESIGN.md yang terstruktur dan 
optimal untuk Stitch. Ini adalah design system resmi untuk website DHS 
(Denpasar Hotel School) — jangan improvisasi warna, font, atau komponen 
di luar apa yang tertulis di file ini.
```

### Langkah 2 — Generate halaman SATU PER SATU (bukan sekaligus)

Supaya aman dari risiko limit, kirim 1 prompt untuk 1 halaman, bukan 1 prompt untuk 6 halaman. Urutan pengiriman yang saya sarankan:

**Urutan build (dari yang paling penting/sering dilihat dulu):**
1. Beranda (homepage)
2. Akademi
3. Berita & Artikel (+ halaman detail artikel)
4. Tentang Kami
5. FAQ Umum
6. Kontak

**Template prompt untuk SETIAP halaman** (ganti bagian `[NAMA HALAMAN]` dan `[DETAIL SECTION]` sesuai halaman yang sedang dikerjakan):

```
Gunakan Stitch MCP server untuk membangun FRONTEND halaman "[NAMA HALAMAN]" 
website DHS (Denpasar Hotel School), mengikuti DESIGN.md yang sudah dibuat. 
Ini murni frontend/tampilan — JANGAN buat backend, database, atau logic 
fungsional apapun. Data boleh statis/dummy dulu.

ISI HALAMAN INI:
[DETAIL SECTION — copy dari page-prompts.md/design.md bagian halaman ini]

ATURAN KETERHUBUNGAN:
- Nav bar dan footer HARUS pakai component yang sama persis dengan halaman 
  lain yang sudah dibuat sebelumnya (reusable component, jangan bikin 
  ulang dari nol)
- Label nav bar harus sama persis dengan judul (H1) halaman ini
- Semua tombol/link di halaman ini yang mengarah ke halaman lain harus 
  menunjuk ke path/route yang benar sesuai struktur project yang sudah ada
- Kalau ada link ke halaman yang belum dibuat, gunakan placeholder route 
  yang valid (tidak error), beri catatan di kode bahwa ini menunggu 
  halaman tersebut dibuat

ATURAN PENTING SOAL BATASAN WAKTU/QUOTA:
- Jika kamu merasa akan kehabisan quota/waktu sebelum halaman ini selesai 
  100%, JANGAN berhenti di tengah menulis sebuah file atau komponen.
- Selesaikan dulu file/komponen yang sedang kamu kerjakan sampai valid 
  dan bisa dibuka tanpa error, baru berhenti.
- Jika section tertentu di halaman ini belum sempat dikerjakan, catat di 
  next-prompt.md section mana yang tersisa, supaya sesi berikutnya bisa 
  lanjut persis dari situ.
- Sebelum berhenti, pastikan project masih bisa di-build/dijalankan tanpa 
  error.
- Setelah halaman ini selesai dan tervalidasi, jalankan git add & git 
  commit dengan pesan jelas (contoh: "feat: halaman [NAMA HALAMAN] selesai").
```

Dengan pola ini, tiap halaman jadi 1 unit kerja yang aman — kalaupun limit kena di tengah, paling buruk cuma 1 halaman yang tertunda, bukan seluruh project berantakan.

### Langkah 3 — Review & minta perbaikan spesifik (kalau ada yang meleset)
Setelah hasil pertama keluar, jangan ragu prompt lanjutan spesifik, contoh:

```
Halaman Akademi hasil generate belum menggunakan warna Navy (#1B2A6B) 
untuk heading-nya, masih pakai warna default. Perbaiki supaya sesuai 
DESIGN.md.
```

```
Link tombol "Program Details" di kartu Culinary Arts pada Beranda belum 
mengarah ke tab yang benar di halaman Akademi. Perbaiki routing-nya.
```

---

## 3. Supaya hasilnya bagus & menarik (bukan generik)

- **Selalu sertakan referensi ke DESIGN.md di tiap prompt**, jangan andalkan Antigravity "ingat" dari prompt sebelumnya — sistem prompt yang eksplisit menyebut file ini membuat hasil jauh lebih konsisten
- **Generate 1-2 halaman dulu, review, baru lanjut** — jangan langsung minta 6 halaman sekaligus di percobaan pertama kalau ini kali pertama kamu pakai `stitch-loop`, supaya kalau ada kesalahan arah, tidak terlanjur menyebar ke semua halaman
- **Manfaatkan skill `enhance-prompt`** (opsional, bagian dari paket yang sama) untuk memperkaya prompt kamu secara otomatis dengan kata kunci UI/UX yang lebih presisi sebelum dikirim ke Stitch:
  ```bash
  npx skills add google-labs-code/stitch-skills --skill enhance-prompt --global
  ```
- **Cek preview di browser bawaan Antigravity** (fitur "Browser Subagent") setiap selesai 1 halaman — Antigravity bisa langsung buka & screenshot hasilnya, jadi kamu tidak perlu bolak-balik export manual untuk cek

## 3.5 Strategi Menghadapi Limit/Quota Antigravity (PENTING)

Antigravity punya sistem quota ganda: **sprint limit** (refresh tiap ±5 jam) dan **batas mingguan** (hard cap, reset 1x seminggu). Kalau tidak diantisipasi, agent bisa berhenti mendadak di tengah generate 1 halaman — hasilnya file setengah jadi, kode tidak lengkap, halaman jadi error saat dibuka. Ini strategi supaya itu tidak terjadi:

### A. Jangan generate semua halaman dalam 1 sesi/prompt besar
Prompt di Langkah 2 sebelumnya (generate 6 halaman sekaligus) itu **cocok kalau quota kamu masih penuh/besar**. Tapi kalau kamu tahu quota terbatas, pecah jadi per-halaman, 1 prompt = 1 halaman. Ini juga sebenarnya cara kerja alami `stitch-loop` — dia memang didesain iteratif per halaman lewat sistem "baton" (`next-prompt.md`), bukan wajib sekali jalan semua.

### B. Cek sisa quota SEBELUM mulai sesi baru
Buka **Settings → Models** di Antigravity, lihat baseline quota yang tersisa untuk model yang kamu pakai. Kalau tersisa tipis, jangan mulai halaman baru — selesaikan dulu yang sedang jalan atau berhenti di titik aman.

### C. Tambahkan instruksi "checkpoint" eksplisit di SETIAP prompt
Selalu sisipkan blok ini di akhir prompt kamu (bisa jadi kebiasaan standar):

```
ATURAN PENTING SOAL BATASAN WAKTU/QUOTA:
- Jika kamu merasa akan kehabisan quota/waktu sebelum halaman ini selesai 
  100%, JANGAN berhenti di tengah menulis sebuah file atau komponen.
- Selesaikan dulu file/komponen yang sedang kamu kerjakan sampai valid 
  dan bisa dibuka tanpa error, baru berhenti.
- Jika 1 halaman penuh tidak akan selesai, prioritaskan menyelesaikan 
  section-section yang sudah kamu mulai secara utuh, dan tandai section 
  mana yang belum sempat dikerjakan di file next-prompt.md atau progress 
  notes, supaya sesi berikutnya bisa lanjut persis dari situ.
- Sebelum berhenti, pastikan project masih bisa di-build/dijalankan tanpa 
  error meskipun ada halaman yang belum lengkap (halaman yang belum 
  selesai boleh ditandai "Coming Soon" sementara, asal tidak bikin 
  seluruh aplikasi crash).
```

### D. Commit ke git setelah SETIAP halaman selesai
Ini jaring pengaman di luar kendali AI — jangan andalkan agent saja. Minta Antigravity commit tiap 1 halaman kelar:

```
Setelah halaman ini selesai dan sudah divalidasi tidak error, jalankan 
git add dan git commit dengan pesan yang jelas (contoh: "feat: halaman 
Akademi selesai"). Ini checkpoint supaya kalau sesi berikutnya terputus, 
progress halaman ini sudah aman tersimpan.
```

Kalau project belum ada git, minta di awal: *"Inisialisasi git repository di project ini sebelum mulai."*

### E. Atur "AI Credit Overages" sesuai kondisi budget kamu
Di Settings, ada opsi kalau baseline quota habis:
- **"Never"** → berhenti total sampai quota reset (aman untuk budget, tapi kerja terhenti)
- **"Always"** → otomatis pakai AI credits berbayar untuk lanjut kerja saat baseline habis (kerja tidak terhenti, tapi ada biaya tambahan)

Pilih sesuai prioritas kamu: kalau ini fase kritis mengejar deadline, "Always" lebih aman; kalau masih eksplorasi/belajar, "Never" supaya tidak kebobolan biaya.

### F. Manfaatkan next-prompt.md sebagai "save point" resmi
`stitch-loop` sudah otomatis menulis progress ke `next-prompt.md` di tiap iterasi. Kalau sesi terputus karena limit, di sesi BERIKUTNYA (setelah quota reset atau kamu buka Antigravity lagi), prompt-nya tinggal:

```
Baca file next-prompt.md di project ini, lanjutkan pekerjaan persis dari 
titik terakhir yang tercatat di sana. Jangan ulangi halaman yang sudah 
selesai dan sudah ter-commit di git.
```

---

## 4. Setelah frontend selesai



Simpan dulu di sini — jangan lanjut ke backend/database dulu sebelum semua halaman frontend benar-benar solid, link antar halaman teruji, dan sudah sesuai `design.md`. Setelah itu baru lanjut ke tahap sebelumnya yang sudah kita bahas: back-office/CMS (lihat `admin-panel-prompt.md`) untuk menghubungkan konten statis ini ke database supaya bisa diedit dari admin panel.
