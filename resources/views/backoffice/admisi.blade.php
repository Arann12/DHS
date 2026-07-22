@extends('backoffice.layouts.app')
@section('title', 'Editor Registration Form & Admisi')
@section('page-title', 'Editor Lengkap Halaman Registration Form & Admisi')

@section('content')
<div x-data="admisiCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh pengaturan Halaman Registration Form berhasil disimpan (demo).
    </div>

    {{-- Tabs --}}
    <div style="display:flex;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:24px;border-bottom:1px solid #e5e7eb;scrollbar-width:none;">
        <template x-for="tab in tabs" :key="tab.id">
            <button type="button" @click="activeTab = tab.id"
                :class="activeTab === tab.id ? 'btn-primary' : 'btn-secondary'"
                style="padding:8px 14px;font-size:12.5px;white-space:nowrap;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:16px;" x-text="tab.icon"></span>
                <span x-text="tab.label"></span>
            </button>
        </template>
    </div>

    {{-- TAB 1: HEADER & STATUS --}}
    <div x-show="activeTab === 'header'">
        <div class="bo-card" style="max-width:750px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">1. Header & Status Pendaftaran</h2>
            <div class="form-group">
                <label class="bo-label">Judul Utama H1</label>
                <input type="text" class="bo-input" x-model="header.title">
            </div>
            <div class="form-group">
                <label class="bo-label">Sub-header / Deskripsi</label>
                <textarea class="bo-textarea" rows="3" x-model="header.desc"></textarea>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="bo-label">Tanggal Batas Pendaftaran</label>
                    <input type="date" class="bo-input" x-model="header.deadline">
                </div>
                <div class="form-group">
                    <label class="bo-label">Status Pendaftaran</label>
                    <select class="bo-select" x-model="header.status">
                        <option value="buka">Sedang Dibuka</option>
                        <option value="tutup">Ditutup Sementara</option>
                        <option value="segera">Segera Dibuka</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 2: PERSYARATAN PENDAFTARAN --}}
    <div x-show="activeTab === 'requirements'">
        <div class="bo-card" style="max-width:800px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0;">2. Daftar Persyaratan Pendaftaran</h2>
                <button class="btn-primary" style="padding:6px 12px;font-size:12px;" @click="requirements.push('')">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Syarat
                </button>
            </div>

            <div style="display:flex;flex-direction:column;gap:10px;">
                <template x-for="(req, idx) in requirements" :key="idx">
                    <div style="display:flex;align-items:center;gap:10px;padding:10px 12px;background:#fafafa;border-radius:10px;border:1.5px solid #eee;">
                        <span class="material-icons-round" style="font-size:18px;color:#0010B8;flex-shrink:0;">check_circle</span>
                        <input type="text" class="bo-input" style="flex:1;padding:7px 12px;" x-model="requirements[idx]">
                        <button class="btn-icon danger" style="width:30px;height:30px;" @click="requirements.splice(idx, 1)">
                            <span class="material-icons-round" style="font-size:16px;">close</span>
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 3: FIELD FORM ONLINE --}}
    <div x-show="activeTab === 'fields'">
        <div class="bo-card" style="max-width:900px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <div>
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 4px;">3. Field Form Pendaftaran Online</h2>
                    <p style="font-size:13px;color:#8A8478;margin:0;">Atur pertanyaan/field yang harus diisi oleh calon mahasiswa.</p>
                </div>
                <button class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="fields.push({ label:'', placeholder:'', type:'text', required:false })">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Field
                </button>
            </div>

            <div style="display:grid;gap:10px;">
                <template x-for="(field, idx) in fields" :key="idx">
                    <div style="display:flex;align-items:center;gap:12px;padding:12px 14px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                        <span class="material-icons-round" style="color:#8A8478;flex-shrink:0;" title="Field">drag_indicator</span>
                        <div style="flex:1;display:grid;grid-template-columns:1fr 1fr 150px;gap:10px;">
                            <div>
                                <label class="bo-label" style="font-size:11px;">Label Field</label>
                                <input type="text" class="bo-input" style="padding:7px;" x-model="field.label">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Placeholder</label>
                                <input type="text" class="bo-input" style="padding:7px;" x-model="field.placeholder">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Tipe Field</label>
                                <select class="bo-select" style="padding:7px;" x-model="field.type">
                                    <option value="text">Text</option>
                                    <option value="email">Email</option>
                                    <option value="tel">Telepon (WA)</option>
                                    <option value="select">Dropdown</option>
                                    <option value="textarea">Textarea</option>
                                </select>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <label style="display:flex;align-items:center;gap:5px;cursor:pointer;font-size:12px;color:#555;">
                                <input type="checkbox" x-model="field.required" style="accent-color:#0010B8;">
                                Wajib
                            </label>
                            <button class="btn-icon danger" style="width:30px;height:30px;" @click="fields.splice(idx, 1)">
                                <span class="material-icons-round" style="font-size:16px;">close</span>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 4: KONTAK ADMISI --}}
    <div x-show="activeTab === 'contact'">
        <div class="bo-card" style="max-width:700px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">4. Kontak Helpdesk Admisi</h2>
            <div class="form-group">
                <label class="bo-label">No. WhatsApp Panitia Admisi</label>
                <input type="text" class="bo-input" x-model="contact.wa">
            </div>
            <div class="form-group">
                <label class="bo-label">Email Admisi</label>
                <input type="text" class="bo-input" x-model="contact.email">
            </div>
            <div class="form-group">
                <label class="bo-label">Jam Operasional Pelayanan</label>
                <input type="text" class="bo-input" x-model="contact.hours">
            </div>
        </div>
    </div>

    {{-- Global Save --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()">
            <span class="material-icons-round" style="font-size:20px;">save</span>
            Simpan Seluruh Pengaturan Registration Form
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
function admisiCompleteData() {
    return {
        saved: false,
        activeTab: 'header',
        tabs: [
            { id:'header',       label:'1. Header & Status', icon:'tune' },
            { id:'requirements', label:'2. Persyaratan',     icon:'fact_check' },
            { id:'fields',       label:'3. Field Form',      icon:'assignment' },
            { id:'contact',      label:'4. Kontak Helpdesk', icon:'support_agent' }
        ],
        header: {
            title: 'Daftar Sekarang & Mulai Perjalanan Anda',
            desc: 'Bergabunglah dengan komunitas pelajar hospitality profesional DHS. Kuota terbatas untuk tahun ajaran 2026/2027.',
            deadline: '2026-08-31',
            status: 'buka'
        },
        requirements: [
            'Lulusan SMA/SMK/MA/SMP (sederajat) atau sedang kelas 12/9',
            'Usia maksimal 22 tahun saat pendaftaran',
            'Pas foto terbaru ukuran 3×4 (2 lembar)',
            'Fotokopi kartu keluarga & ijazah/SKL',
            'Mengikuti tes wawancara & minat bakat'
        ],
        fields: [
            { label:'Nama Lengkap', placeholder:'Masukkan nama lengkap Anda', type:'text', required:true },
            { label:'Email', placeholder:'alamat@email.com', type:'email', required:true },
            { label:'No. WhatsApp', placeholder:'08xxxxxxxxxx', type:'tel', required:true },
            { label:'Asal Sekolah', placeholder:'Nama SMA/SMK/SMP asal', type:'text', required:true },
            { label:'Program Diminati', placeholder:'', type:'select', required:true },
            { label:'Pesan / Pertanyaan', placeholder:'Ada yang ingin ditanyakan?', type:'textarea', required:false }
        ],
        contact: {
            wa: '+62 81 246 319966',
            email: 'admisi@dhs.or.id',
            hours: 'Senin - Sabtu: 08:00 - 17:00 WITA'
        },
        saveAll() {
            this.saved = true;
            setTimeout(() => this.saved = false, 3500);
        }
    };
}
</script>
@endpush
