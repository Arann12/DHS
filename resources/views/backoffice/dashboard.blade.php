@extends('backoffice.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div x-data="dashboardData()">

    {{-- Stat Cards --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:28px;">

        <div class="bo-card" style="border-left:4px solid #0E06B4;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#8A8478;">Total Berita</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(14,6,180,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#0E06B4;">article</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#2B2494;line-height:1;" x-text="stats.berita">12</div>
            <div style="font-size:12.5px;color:#8A8478;margin-top:6px;">3 draft, 9 dipublikasikan</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #16a34a;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#8A8478;">Program Studi</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(22,163,74,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#16a34a;">school</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#2B2494;line-height:1;" x-text="stats.program">4</div>
            <div style="font-size:12.5px;color:#8A8478;margin-top:6px;">Aktif semua</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #f59e0b;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#8A8478;">Testimoni</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(245,158,11,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#f59e0b;">format_quote</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#2B2494;line-height:1;" x-text="stats.testimoni">8</div>
            <div style="font-size:12.5px;color:#8A8478;margin-top:6px;">Dari alumni & industri</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #E10001;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#8A8478;">Pengguna</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(225,0,1,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#E10001;">manage_accounts</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#2B2494;line-height:1;" x-text="stats.users">3</div>
            <div style="font-size:12.5px;color:#8A8478;margin-top:6px;">Admin aktif</div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:start;">

        {{-- Recent Berita --}}
        <div class="bo-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#2B2494;margin:0;">Berita Terbaru</h2>
                <a href="/backoffice/berita" class="btn-secondary" style="padding:7px 14px;font-size:12.5px;">
                    <span class="material-icons-round" style="font-size:15px;">open_in_new</span>
                    Lihat Semua
                </a>
            </div>
            <table class="bo-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="item in recentBerita" :key="item.id">
                        <tr>
                            <td>
                                <div style="font-weight:600;color:#1a1a2e;" x-text="item.judul"></div>
                            </td>
                            <td><span class="badge badge-blue" x-text="item.kategori"></span></td>
                            <td style="color:#8A8478;font-size:13px;" x-text="item.tanggal"></td>
                            <td>
                                <span :class="item.status === 'Dipublikasikan' ? 'badge badge-green' : 'badge badge-gray'" x-text="item.status"></span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- Quick Links + Activity --}}
        <div style="display:flex;flex-direction:column;gap:18px;">

            {{-- Quick Actions --}}
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#2B2494;margin:0 0 16px;">Aksi Cepat</h2>
                <div style="display:flex;flex-direction:column;gap:10px;">
                    <a href="/backoffice/berita" class="btn-primary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">add</span>
                        Tambah Berita
                    </a>
                    <a href="/backoffice/program" class="btn-secondary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">school</span>
                        Kelola Program
                    </a>
                    <a href="/backoffice/galeri" class="btn-secondary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">photo_library</span>
                        Upload Galeri
                    </a>
                    <a href="/backoffice/branding" class="btn-secondary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">palette</span>
                        Pengaturan Warna
                    </a>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#2B2494;margin:0 0 16px;">Aktivitas Terkini</h2>
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <template x-for="act in activities" :key="act.id">
                        <div style="display:flex;gap:12px;align-items:flex-start;">
                            <div style="width:32px;height:32px;border-radius:8px;background:rgba(14,6,180,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <span class="material-icons-round" style="font-size:16px;color:#0E06B4;" x-text="act.icon"></span>
                            </div>
                            <div>
                                <div style="font-size:13px;font-weight:600;color:#1a1a2e;" x-text="act.aksi"></div>
                                <div style="font-size:12px;color:#8A8478;margin-top:2px;" x-text="act.waktu"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function dashboardData() {
    return {
        stats: { berita: 12, program: 4, testimoni: 8, users: 3 },
        recentBerita: [
            { id: 1, judul: 'DHS Raih Akreditasi A dari BAN-SM', kategori: 'Prestasi', tanggal: '20 Jul 2026', status: 'Dipublikasikan' },
            { id: 2, judul: 'Program Magang Industri 2026 Dibuka', kategori: 'Akademik', tanggal: '18 Jul 2026', status: 'Dipublikasikan' },
            { id: 3, judul: 'Workshop Barista & Coffee Art Bersama Marriott', kategori: 'Kegiatan', tanggal: '15 Jul 2026', status: 'Dipublikasikan' },
            { id: 4, judul: 'Pendaftaran Tahun Ajaran 2026/2027', kategori: 'Admisi', tanggal: '10 Jul 2026', status: 'Draft' },
            { id: 5, judul: 'Alumni DHS Raih Posisi GM di Ritz-Carlton Bali', kategori: 'Alumni', tanggal: '5 Jul 2026', status: 'Dipublikasikan' },
        ],
        activities: [
            { id: 1, icon: 'article', aksi: 'Berita "DHS Raih Akreditasi A" diterbitkan', waktu: '2 jam lalu' },
            { id: 2, icon: 'photo_library', aksi: '3 foto galeri baru diunggah', waktu: '5 jam lalu' },
            { id: 3, icon: 'manage_accounts', aksi: 'User "editor_bali" ditambahkan', waktu: 'Kemarin' },
            { id: 4, icon: 'palette', aksi: 'Warna brand diperbarui', waktu: '3 hari lalu' },
        ]
    }
}
</script>
@endpush
