# DHS — Denpasar Hotel School
## Design System & Content Guide (v1)

> Dokumen ini dibuat berdasarkan analisis visual homepage yang sudah didesain.
> Tujuannya: jadi acuan supaya halaman baru (Program Studi, Berita & Artikel, Admisi, dsb) tetap konsisten dari sisi warna, tipografi, komponen, dan penulisan.
> **Catatan:** kode warna di bawah adalah estimasi visual dari desain — sebaiknya dikonfirmasi ulang dengan file asli (Figma/XD) untuk nilai HEX yang presisi.

---

## 1. Brand Overview

- **Nama:** DHS — Denpasar Hotel School
- **Tagline:** "International Vocational Training Center in Bali"
- **Positioning:** Sekolah vokasi hospitality premium, berdiri sejak 1989, fokus pada culinary arts, hospitality management, dan F&B service.
- **Kesan visual yang ingin dibangun:** elegan, hangat, "resort luxury", warisan/heritage, profesional internasional.

---

## 2. Color Palette — v3 (Diambil Langsung dari File Logo)

> **Update:** Hex merah & biru di bawah **bukan lagi estimasi visual** — diambil langsung via color picker dari file logo yang diupload, jadi sudah 100% match dengan warna resmi logo DHS. Background cream/beige tetap dipertahankan sebagai penyeimbang karena warna logo (merah & biru) sangat saturated/cerah dan perlu "ruang napas" netral supaya tidak norak dipakai luas di halaman.

| Nama | HEX (dari logo) | RGB | Penggunaan |
|---|---|---|---|
| **DHS Red** (segitiga atas, huruf D) | `#E10001` | 225, 0, 1 | Aksen utama — badge, ikon kecil, highlight kutipan, underline tab aktif, angka statistik |
| **DHS Blue** (perisai, huruf H S) | `#0E06B4` | 14, 6, 180 | Warna dominan/primary — heading, nav bar, tombol primary solid, teks utama |
| White (huruf logo) | `#FFFFFF` | 255, 255, 255 | Card background, teks di atas Blue/Red, huruf logo |
| Cream / Off-white | `#F6F2EA` | — | Background utama section (penyeimbang, bukan dari logo) |
| Warm Beige | `#EFE7D8` | — | Background alternating section (Visionary Standards, Footer) |
| Dark Blue (teks sekunder) | `#2B2494` | — | Teks body sekunder, variasi lebih soft dari DHS Blue utama (dicampur sedikit dengan hitam supaya tidak terlalu "neon" untuk body text panjang) |
| Muted Gray | `#8A8478` | — | Label kecil huruf kapital ("BERITA & ARTIKEL", "OUR MISSION") |

**Catatan penting soal saturasi:** warna logo ini jauh lebih cerah/saturated dibanding palet "navy" versi sebelumnya (`#0E06B4` itu vivid royal blue, bukan navy gelap; `#E10001` itu merah terang, bukan merah bata). Ini konsekuensi dari keputusan "match 100% dengan logo" — supaya tetap terasa elegan dan bukan "norak", ikuti rasio pemakaian di bawah dengan ketat, dan pertimbangkan token `Dark Blue (#2B2494)` untuk area teks/section besar yang butuh biru tapi tidak seterang warna logo asli.

**Aturan pemakaian Merah & Biru (penting, supaya tidak norak):**
- **DHS Blue** jadi warna dominan/primary — dipakai luas: heading, tombol utama, nav aktif. Untuk area yang sangat luas (mis. section background solid), pertimbangkan pakai `Dark Blue #2B2494` sebagai versi lebih redup, bukan `#0E06B4` langsung — karena biru vivid ini bisa terasa terlalu tajam kalau dipakai sebagai bidang besar.
- **DHS Red** jadi aksen sekunder saja, dipakai SEDIKIT dan strategis — untuk elemen kecil yang perlu menarik perhatian (badge "Pendaftaran Dibuka", ikon, garis bawah tab aktif, highlight angka statistik). Jangan pakai merah untuk area luas (background section, misalnya) karena warnanya sangat terang dan akan terasa agresif untuk brand hospitality yang harusnya elegan.
- Rasio disarankan: Blue dominan ~70%, Red aksen ~10%, sisanya tetap cream/beige/putih sebagai penyeimbang.

**Aturan kontras:** teks abu-abu di atas cream harus dicek dengan contrast checker — beberapa label kecil berisiko gagal WCAG AA. Gunakan gray lebih gelap (`#6B6558` atau lebih pekat) untuk teks yang perlu dibaca nyaman, bukan cuma dekoratif. Teks putih di atas DHS Blue (`#0E06B4`) sudah pasti kontras aman; teks putih di atas DHS Red (`#E10001`) juga aman, tapi hindari teks abu-abu di atas keduanya — kontrasnya buruk karena warna dasarnya sudah sangat cerah.

---

## 3. Typography

| Elemen | Font style | Contoh pemakaian |
|---|---|---|
| Heading besar (H1/H2) | Serif elegan (mirip Canela/Georgia/Playfair) | "Crafting The Future Of Global Hospitality", "Pioneering Excellence Since 1989." |
| Body text | Sans-serif netral (mirip Inter/Helvetica) | Paragraf deskripsi, caption |
| Label kecil kapital | Sans-serif, letter-spacing lebar, ukuran kecil | "BERLAKU SEJAK", "THE VISION", "ALUMNI LEGACY" |
| Tombol (CTA) | Sans-serif, kapital, medium weight | "JELAJAHI PROGRAM" |

**Aturan:** setiap section besar punya pola **label kecil kapital → heading serif besar → body sans-serif**. Pola ini harus dipertahankan di semua halaman baru.

---

## 4. Spacing & Layout

- Section menggunakan **padding vertikal besar** (terasa "napas lega", tidak padat) — pertahankan whitespace generous khas web hospitality premium.
- Grid dua kolom sering dipakai: teks di kiri, gambar di kanan (atau sebaliknya), lihat section "Pioneering Excellence Since 1989."
- Card grid 3 kolom untuk: Disiplin/Program, Popular Image, Executive Leadership.
- Card grid 2 kolom untuk: Visionary Standards (Akreditasi, Global Network, Expert Faculty, Job Placement).
- Gambar besar full-width untuk hero dan "World Class Facilities".

---

## 5. Komponen

### 5.1 Tombol (Button)
- **Primary (solid):** background DHS Blue `#0E06B4`, teks putih, kapital — contoh: "JELAJAHI PROGRAM"
- **Secondary (outline):** border tipis DHS Blue, teks DHS Blue, background transparan — contoh tombol kedua di hero
- ⚠️ **Aturan penting:** teks tombol HARUS deskriptif dan sesuai tujuan link. Jangan pernah biarkan placeholder/typo lolos ke desain final (lihat catatan "CETAK DASHBOARD" di homepage — perlu diperbaiki).

### 5.2 Card
- Card program (Culinary Arts, dst): gambar di atas, judul serif, deskripsi 1-2 kalimat, link kecil kapital "PROGRAM DETAILS" di bawah.
- Card statistik (Akreditasi, Global Network): ikon merah DHS Red (`#E10001`) kecil, judul bold warna DHS Blue, subjudul kecil di bawah.

### 5.3 Navigasi
- Logo kiri, menu tengah/kanan: **Beranda · Tentang Kami · Akademi · Berita · Karier**
- Ikon hamburger/menu kanan atas.
- **Aturan konsistensi label:** nama menu di nav HARUS sama persis dengan H1 halaman tujuan. Contoh: menu "Akademi" → halaman harus berjudul "Akademi" (bukan "Program Kerja" atau nama lain).

### 5.4 Footer (belum final — rencana perbaikan)
- Kolom kiri: nama sekolah + deskripsi singkat + ikon sosial media
- Kolom kanan: dua grup link ("EXPLORE" dan "ADMISSIONS")
- **Tambahan yang direkomendasikan:** sitemap, privacy policy, syarat & ketentuan, newsletter signup.

---

## 6. Gaya Fotografi

- Foto interior kampus bernuansa hangat, natural light, warm wood tones.
- Foto siswa dalam seragam formal (blazer merah marun) — dipakai untuk humanize brand.
- Foto proses kerja (dapur, bartending, plating) untuk section disiplin/program.
- Semua foto punya **aspect ratio konsisten** dalam satu grid (jangan campur square dengan landscape dalam 1 baris card).

---

## 7. Voice & Tone / Aturan Bahasa

⚠️ **Ini keputusan yang harus dikunci sebelum lanjut ke halaman lain:**

Saat ini bahasa campur: hero pakai Inggris ("Crafting The Future Of Global Hospitality"), tapi tombol dan body pakai Indonesia. Pilih salah satu:

- **Opsi A — Bahasa Indonesia sebagai bahasa utama**, dengan istilah Inggris hanya untuk nama program/gelar (mis. "Culinary Arts", "F&B Service") karena itu istilah industri internasional.
- **Opsi B — Bilingual toggle EN/ID** di nav, dengan dua versi konten penuh.

Tone: formal namun hangat, tidak kaku — mencerminkan institusi heritage (35+ tahun) tapi modern secara internasional.

---

## 8. Pola Struktur Halaman (dipakai di homepage, jadi acuan halaman baru)

1. **Hero** — headline besar + subcopy singkat + 2 CTA (primary & secondary) + gambar full-width
2. **Label kecil + intro section** — 2 kolom (teks kiri, gambar kanan) dengan angka statistik
3. **Section nilai/standar** — kutipan besar + card grid ikon
4. **Grid galeri/showcase** — 3 gambar sejajar
5. **Grid konten utama** (program/berita/dst) — card 3 kolom dengan link detail
6. **Showcase fasilitas** — gambar besar campuran ukuran
7. **Testimoni** — kutipan besar dengan navigasi slider
8. **News/related content preview**
9. **Contact / CTA form**
10. **Footer**

Halaman baru tidak harus pakai semua section ini, tapi urutan besar (hero → konten utama → showcase → CTA → footer) sebaiknya dipertahankan supaya user experience-nya familiar di seluruh situs.

---

## 9. Checklist Konsistensi Sebelum Publish Halaman Baru

- [ ] Judul H1 halaman sama dengan label di nav
- [ ] Tombol CTA punya teks yang jelas & sesuai tujuan (tidak ada typo/placeholder)
- [ ] Bahasa konsisten sesuai keputusan section 7
- [ ] Warna & tipografi mengikuti section 2 & 3
- [ ] Setiap card/list item punya link yang benar-benar mengarah ke halaman detail (tidak dead-end)
- [ ] Footer sama persis di semua halaman
- [ ] Gambar pakai aspect ratio konsisten dalam satu grid
