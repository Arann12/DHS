@extends('backoffice.layouts.app')
@section('title', 'Kelola Dokumen Sertifikasi')
@section('page-title', 'Editor Halaman Dokumen Sertifikasi (7 Sertifikasi Maritim & Pelaut)')

@section('content')
<div>

    {{-- Top Description --}}
    <div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;">
        <div>
            <h2 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:0 0 4px;">Daftar Halaman Dokumen Sertifikasi</h2>
            <p style="font-size:13px;color:#718096;margin:0;">Pilih salah satu dokumen sertifikasi di bawah untuk mengedit judul, deskripsi, persyaratan, prosedur, dan FAQ yang tampil pada website public DHS.</p>
        </div>
        <div class="badge badge-blue" style="padding:8px 16px;font-size:12px;">7 Halaman Dokumen Aktif</div>
    </div>

    {{-- Grid 7 Documents --}}
    <div class="bo-grid-2" style="display:grid;grid-template-columns:repeat(auto-fill, minmax(380px, 1fr));gap:20px;">
        @foreach($documents as $type => $doc)
        <div class="bo-card" style="display:flex;flex-direction:column;justify-content:space-between;border-left:4px solid {{ $doc['color'] ?? '#1A365D' }};position:relative;overflow:hidden;">
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                    <span class="badge badge-blue" style="font-size:10.5px;">{{ $doc['badge'] ?? 'Sertifikasi DHS' }}</span>
                    <div style="width:36px;height:36px;border-radius:10px;background:rgba(26,54,93,0.08);color:{{ $doc['color'] ?? '#1A365D' }};display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round" style="font-size:20px;">{{ $doc['icon'] ?? 'description' }}</span>
                    </div>
                </div>

                <h3 style="font-family:'Playfair Display',serif;font-size:17px;font-weight:700;color:#0F2440;margin:0 0 6px;">{{ $doc['title'] }}</h3>
                <div style="font-size:11.5px;color:#718096;margin-bottom:10px;font-weight:600;">Kategori: {{ $doc['category'] ?? '-' }}</div>

                <p style="font-size:12.5px;color:#555;line-height:1.5;margin:0 0 14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                    {{ $doc['description'] }}
                </p>

                <div style="background:#f8fafc;border-radius:8px;padding:10px 12px;font-size:11.5px;color:#475569;margin-bottom:16px;display:flex;flex-direction:column;gap:4px;">
                    <div>⏱️ <strong>Waktu Proses:</strong> {{ $doc['waktu'] ?? '-' }}</div>
                    <div>🎯 <strong>Peruntukan:</strong> {{ $doc['peruntukan'] ?? '-' }}</div>
                    <div>🕒 <strong>Update Terakhir:</strong> {{ $doc['updated_at'] ?? 'Standar Default' }}</div>
                </div>
            </div>

            <div style="display:flex;align-items:center;gap:10px;border-top:1px solid #eee;padding-top:14px;margin-top:auto;">
                <a href="/backoffice/dokumen-sertifikasi/{{ $type }}" class="btn-primary" style="flex:1;justify-content:center;padding:8px 14px;font-size:12.5px;">
                    <span class="material-icons-round" style="font-size:16px;">edit</span> Edit Konten Halaman
                </a>
                <a href="/dokumen/{{ $type }}" target="_blank" class="btn-secondary" style="padding:8px 12px;font-size:12.5px;" title="Lihat Tampilan Public">
                    <span class="material-icons-round" style="font-size:16px;">open_in_new</span>
                </a>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
