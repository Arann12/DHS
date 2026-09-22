@extends('backoffice.layouts.app')
@section('title', 'Detail Pengajuan — ' . $item->full_name)
@section('page-title', 'Detail & Jawaban Pengajuan')

@section('content')
<div style="max-width:900px;margin:0 auto;">
    <div style="margin-bottom:16px;">
        <a href="/backoffice/layanan" class="btn-secondary" style="padding:7px 14px;font-size:12.5px;">
            <span class="material-icons-round" style="font-size:16px;">arrow_back</span> Kembali ke Daftar Pengajuan
        </a>
    </div>

    <div class="bo-card" style="padding:28px;">
        <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1.5px solid #eee;padding-bottom:16px;margin-bottom:24px;">
            <div>
                <h2 style="font-family:'Playfair Display',serif;margin:0;color:#0F2440;font-size:22px;">{{ $item->full_name }}</h2>
                <div style="font-size:13px;color:#718096;margin-top:2px;">
                    Diajukan pada: {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i WITA') }}
                </div>
            </div>
            <div>
                @php
                    $statusBadge = [
                        'pending'  => ['bg' => 'rgba(234,179,8,0.15)', 'color' => '#ca8a04', 'label' => 'Pending (Menunggu)'],
                        'verified' => ['bg' => 'rgba(59,130,246,0.15)', 'color' => '#2563eb', 'label' => 'Verified (Diproses)'],
                        'accepted' => ['bg' => 'rgba(34,197,94,0.15)', 'color' => '#16a34a', 'label' => 'Accepted (Diterima)'],
                        'rejected' => ['bg' => 'rgba(239,68,68,0.15)', 'color' => '#dc2626', 'label' => 'Rejected (Ditolak)'],
                    ][$item->status] ?? ['bg' => '#eee', 'color' => '#666', 'label' => $item->status];
                @endphp
                <span class="badge" style="background:{{ $statusBadge['bg'] }};color:{{ $statusBadge['color'] }};padding:6px 14px;font-size:12px;">
                    {{ $statusBadge['label'] }}
                </span>
            </div>
        </div>

        <div class="bo-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
            <div>
                <label class="bo-label">Nama Lengkap Pemohon</label>
                <div class="bo-input" style="background:#fafafa;font-weight:700;">{{ $item->full_name }}</div>
            </div>
            <div>
                <label class="bo-label">Nomor WhatsApp / HP</label>
                <div class="bo-input" style="background:#fafafa;display:flex;align-items:center;justify-content:space-between;">
                    <span>{{ $item->phone }}</span>
                    @php
                        $cleanHp = preg_replace('/[^0-9]/', '', $item->phone);
                        if (str_starts_with($cleanHp, '0')) { $cleanHp = '62' . substr($cleanHp, 1); }
                        $waText = rawurlencode("Halo " . $item->full_name . ", mengenai pengajuan " . ($item->program_title ?? 'layanan') . " Anda di DHS:\n\n" . ($item->admin_reply ?? ''));
                    @endphp
                    <a href="https://wa.me/{{ $cleanHp }}?text={{ $waText }}" target="_blank" style="color:#16a34a;font-weight:700;font-size:12px;text-decoration:none;display:flex;align-items:center;gap:4px;">
                        <span class="material-icons-round" style="font-size:16px;">chat</span> Chat WA
                    </a>
                </div>
            </div>
            <div>
                <label class="bo-label">Alamat Email</label>
                <div class="bo-input" style="background:#fafafa;">{{ $item->email }}</div>
            </div>
            <div>
                <label class="bo-label">Program / Jenis Dokumen</label>
                <div class="bo-input" style="background:#fafafa;font-weight:700;color:#1A365D;">{{ $item->program_title ?? '-' }}</div>
            </div>
            <div style="grid-column:1/-1;">
                <label class="bo-label">Rincian & Catatan Khusus Dari Form</label>
                <div class="bo-textarea" style="background:#fafafa;min-height:90px;white-space:pre-line;font-size:13.5px;" readonly>{{ $item->special_request ?? 'Tidak ada catatan.' }}</div>
            </div>
        </div>

        {{-- JAWABAN ADMIN FORM --}}
        <div style="border-top:2px solid #e2e8f0;padding-top:24px;margin-top:24px;background:#f8fafc;padding:24px;border-radius:16px;">
            <h3 style="margin:0 0 16px;font-size:17px;font-family:'Playfair Display',serif;color:#0F2440;display:flex;align-items:center;gap:8px;">
                <span class="material-icons-round" style="color:#2563eb;">edit_note</span>
                Jawaban & Tanggapan Admin DHS
            </h3>

            <form action="/backoffice/layanan/{{ $item->id }}/update-reply" method="POST">
                @csrf
                <div class="form-group">
                    <label class="bo-label">Ubah Status Pengajuan</label>
                    <select name="status" class="bo-select" style="max-width:300px;">
                        <option value="pending" {{ $item->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="verified" {{ $item->status === 'verified' ? 'selected' : '' }}>Verified (Diproses)</option>
                        <option value="accepted" {{ $item->status === 'accepted' ? 'selected' : '' }}>Accepted (Diterima)</option>
                        <option value="rejected" {{ $item->status === 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="bo-label">Isi Balasan / Jawaban Admin Untuk Pemohon</label>
                    <textarea name="admin_reply" class="bo-textarea" style="min-height:130px;font-size:14px;" placeholder="Tulis balasan resmi untuk pemohon di sini...">{{ $item->admin_reply }}</textarea>
                    <div style="font-size:11.5px;color:#718096;margin-top:4px;">Balasan ini disimpan di sistem dan bisa dikirimkan langsung ke WhatsApp pemohon.</div>
                </div>

                <div class="form-group">
                    <label class="bo-label">Catatan Internal Admin (Catatan internal tim DHS)</label>
                    <input type="text" name="notes" class="bo-input" value="{{ $item->notes }}" placeholder="Catatan internal tim...">
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:24px;">
                    <a href="https://wa.me/{{ $cleanHp }}?text={{ $waText }}" target="_blank" class="btn-secondary" style="color:#16a34a;border-color:#16a34a;">
                        <span class="material-icons-round">chat</span> Kirim Jawaban via WA
                    </a>
                    <button type="submit" class="btn-primary">
                        <span class="material-icons-round">save</span> Simpan Jawaban
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
