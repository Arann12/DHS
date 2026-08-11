@extends('backoffice.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Stat Cards --}}
    <div class="bo-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:28px;">

        <div class="bo-card" style="border-left:4px solid #1A365D;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#718096;">Total Berita</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#1A365D;">article</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#0F2440;line-height:1;">{{ $stats['berita'] }}</div>
            <div style="font-size:12.5px;color:#718096;margin-top:6px;">Total artikel berita</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #16a34a;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#718096;">Program Studi</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(22,163,74,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#16a34a;">school</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#0F2440;line-height:1;">{{ $stats['program'] }}</div>
            <div style="font-size:12.5px;color:#718096;margin-top:6px;">Total program aktif</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #f59e0b;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#718096;">Pendaftar Baru</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(245,158,11,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#f59e0b;">how_to_reg</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#0F2440;line-height:1;">{{ $stats['pendaftar'] }}</div>
            <div style="font-size:12.5px;color:#718096;margin-top:6px;">Total formulir masuk</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #C53030;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#718096;">Pengguna Admin</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#C53030;">manage_accounts</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#0F2440;line-height:1;">{{ $stats['users'] }}</div>
            <div style="font-size:12.5px;color:#718096;margin-top:6px;">Admin aktif</div>
        </div>
    </div>

    <div class="bo-grid-sidebar" style="display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:start;">

        {{-- Recent Berita --}}
        <div class="bo-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#0F2440;margin:0;">Berita Terbaru</h2>
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
                    @forelse($recentBerita as $item)
                    <tr>
                        <td>
                            <div style="font-weight:600;color:#1A365D;">{{ Str::limit($item->title, 50) }}</div>
                        </td>
                        <td><span class="badge badge-blue">{{ ucfirst($item->category) }}</span></td>
                        <td style="color:#718096;font-size:13px;">{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="{{ $item->status === 'dipublikasikan' ? 'badge badge-green' : 'badge badge-gray' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:#718096;padding:20px;">Belum ada berita.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Quick Links + Activity --}}
        <div style="display:flex;flex-direction:column;gap:18px;">

            {{-- Quick Actions --}}
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#0F2440;margin:0 0 16px;">Aksi Cepat</h2>
                <div style="display:flex;flex-direction:column;gap:10px;">
                    <a href="/backoffice/berita" class="btn-primary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">add</span>
                        Tambah Berita
                    </a>
                    <a href="/backoffice/program" class="btn-secondary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">school</span>
                        Kelola Program
                    </a>
                    <a href="/backoffice/pendaftar" class="btn-secondary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">how_to_reg</span>
                        Data Pendaftar
                    </a>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#0F2440;margin:0 0 16px;">Aktivitas Terkini</h2>
                <div style="display:flex;flex-direction:column;gap:14px;">
                    @forelse($activities->take(6) as $act)
                    <div style="display:flex;gap:12px;align-items:flex-start;">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(197,48,48,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-icons-round" style="font-size:16px;color:#1A365D;">
                                {{ $act->action === 'login' ? 'login' : ($act->action === 'create' ? 'add_circle' : ($act->action === 'delete' ? 'delete' : 'edit')) }}
                            </span>
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:600;color:#1A365D;">
                                {{ $act->user ? $act->user->name : 'Sistem' }}
                                — {{ ucfirst($act->action) }}
                                {{ $act->table_name ? '(' . $act->table_name . ')' : '' }}
                            </div>
                            <div style="font-size:12px;color:#718096;margin-top:2px;">{{ \Carbon\Carbon::parse($act->created_at)->diffForHumans() }}</div>
                        </div>
                    </div>
                    @empty
                    <div style="color:#718096;font-size:13px;text-align:center;">Belum ada aktivitas.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
