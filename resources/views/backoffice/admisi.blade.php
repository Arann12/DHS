@extends('backoffice.layouts.app')
@section('title', 'Editor Registration Form & Admisi')
@section('page-title', 'Editor Lengkap Halaman Registration Form & Admisi')

@section('content')
<div x-data="admisiCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh pengaturan Halaman Registration Form berhasil disimpan ke database.
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
    {{-- TAB 1: FIELD FORM ONLINE --}}
    <div x-show="activeTab === 'fields'">
        <div class="bo-card" style="max-width:900px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <div>
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">1. Field Form Pendaftaran Online</h2>
                    <p style="font-size:13px;color:#718096;margin:0;">Lihat dan kelola field yang harus diisi calon mahasiswa di website.</p>
                </div>
                <button class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="fields.push({ label:'', placeholder:'', type:'text', required:false })">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Field
                </button>
            </div>

            <div style="display:grid;gap:10px;">
                <template x-for="(field, idx) in fields" :key="idx">
                    <div style="background:#fafafa;border-radius:12px;border:1.5px solid #eee;overflow:hidden;">
                        <div style="display:flex;align-items:center;gap:12px;padding:12px 14px;">
                            <span class="material-icons-round" style="color:#718096;flex-shrink:0;" title="Field">drag_indicator</span>
                            <div style="flex:1;display:grid;grid-template-columns:1fr 1fr 150px;gap:10px;" class="bo-grid-3">
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
                                        <option value="file">Upload File</option>
                                        <option value="checkbox">Checkbox Multi</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <label style="display:flex;align-items:center;gap:5px;cursor:pointer;font-size:12px;color:#555;">
                                    <input type="checkbox" x-model="field.required" style="accent-color:#1A365D;">
                                    Wajib
                                </label>
                                <button class="btn-icon danger" style="width:30px;height:30px;" @click="fields.splice(idx, 1)">
                                    <span class="material-icons-round" style="font-size:16px;">close</span>
                                </button>
                            </div>
                        </div>
                        {{-- Note row for select/checkbox/file --}}
                        <template x-if="field.note">
                            <div style="padding:8px 14px 10px 46px;border-top:1px dashed #e5e7eb;background:#f0f4ff;">
                                <span style="font-size:11px;color:#0F2440;font-weight:600;">
                                    <span x-text="field.type === 'select' ? '📋 Pilihan:' : (field.type === 'checkbox' ? '☑ Opsi:' : '📎 Info:')"></span>
                                </span>
                                <span style="font-size:11px;color:#555;margin-left:4px;" x-text="field.note"></span>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 2: KONTAK ADMISI --}}
    <div x-show="activeTab === 'contact'">
        <div class="bo-card" style="max-width:700px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 20px;">2. Kontak Helpdesk Admisi</h2>
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

    {{-- TAB 3: PREVIEW FORM --}}
    <div x-show="activeTab === 'preview'">
        <div class="bo-card" style="max-width:750px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <div>
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">5. Preview Form Pendaftaran</h2>
                    <p style="font-size:13px;color:#718096;margin:0;">Tampilan persis seperti yang dilihat calon mahasiswa di website.</p>
                </div>
                <a href="/formulir-pendaftaran" target="_blank" class="btn-secondary" style="padding:8px 14px;font-size:12.5px;display:flex;align-items:center;gap:6px;text-decoration:none;">
                    <span class="material-icons-round" style="font-size:16px;">open_in_new</span>
                    Buka Website Asli
                </a>
            </div>

            <div style="background:#f8f9fb;border:1.5px solid #e5e7eb;border-radius:12px;padding:24px;">
                <div style="text-align:center;margin-bottom:20px;">
                    <span style="font-size:10px;font-weight:700;letter-spacing:0.18em;color:#C3932F;text-transform:uppercase;">PENDAFTARAN ONLINE</span>
                    <h3 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:8px 0 6px;">FORMULIR PENDAFTARAN DENPASAR HOTEL SCHOOL</h3>
                    <p style="font-size:12px;color:#718096;">Silakan lengkapi formulir pendaftaran di bawah ini. Tim admisi DHS akan segera menghubungi Anda.</p>
                </div>

                <template x-for="field in fields" :key="field.label">
                    <div style="margin-bottom:16px;">
                        <label style="display:block;font-size:13px;font-weight:600;color:#222;margin-bottom:6px;">
                            <span x-text="field.label"></span>
                            <span x-show="field.required" style="color:#ef4444;"> *</span>
                        </label>
                        <template x-if="field.type === 'text' || field.type === 'email' || field.type === 'tel'">
                            <input disabled :placeholder="field.placeholder" style="width:100%;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:13px;color:#aaa;background:#fff;box-sizing:border-box;">
                        </template>
                        <template x-if="field.type === 'select'">
                            <select disabled style="width:100%;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:13px;color:#aaa;background:#fff;">
                                <option x-text="'-- ' + field.placeholder + ' --'"></option>
                            </select>
                        </template>
                        <template x-if="field.type === 'textarea'">
                            <textarea disabled :placeholder="field.placeholder" rows="3" style="width:100%;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:13px;color:#aaa;background:#fff;resize:none;box-sizing:border-box;"></textarea>
                        </template>
                        <template x-if="field.type === 'file'">
                            <div style="border:2px dashed #d1d5db;border-radius:8px;padding:14px;display:flex;align-items:center;gap:10px;">
                                <span class="material-icons" style="color:#aaa;">upload_file</span>
                                <span style="font-size:12px;color:#aaa;" x-text="field.placeholder"></span>
                            </div>
                        </template>
                        <template x-if="field.type === 'checkbox'">
                            <div class="bo-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                                <template x-if="field.note">
                                    <template x-for="opt in field.note.split(' | ')" :key="opt">
                                        <label style="display:flex;align-items:center;gap:8px;font-size:12px;color:#555;cursor:not-allowed;">
                                            <input type="checkbox" disabled style="accent-color:#0F2440;">
                                            <span x-text="opt"></span>
                                        </label>
                                    </template>
                                </template>
                            </div>
                        </template>
                    </div>
                </template>

                <div style="margin-top:20px;">
                    <button disabled style="width:100%;padding:14px;background:#0F2440;color:#fff;font-weight:700;font-size:13px;letter-spacing:0.1em;text-transform:uppercase;border:none;border-radius:8px;cursor:not-allowed;opacity:0.8;">DAFTAR SEKARANG</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Global Save --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()">
            <span class="material-icons-round" style="font-size:20px;">save</span>
            Simpan Seluruh Pengaturan Registration Form
        </button>
        <a href="/formulir-pendaftaran" target="_blank" class="btn-secondary" style="padding:12px 20px;font-size:13px;display:flex;align-items:center;gap:6px;text-decoration:none;">
            <span class="material-icons-round" style="font-size:18px;">open_in_new</span>
            Lihat Halaman Registration di Website
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
function admisiCompleteData() {
    return {
        saved: false,
        activeTab: 'fields',
        tabs: [
            { id:'fields',   label:'1. Field Form',      icon:'assignment' },
            { id:'contact',  label:'2. Kontak Helpdesk', icon:'support_agent' },
            { id:'preview',  label:'3. Preview Form',    icon:'visibility' }
        ],
        fields: [
            { label:'Nama Lengkap', placeholder:'Masukkan nama lengkap Anda', type:'text', required:true },
            { label:'HP / WA', placeholder:'08xxxxxxxxxx (aktif di WhatsApp)', type:'tel', required:true },
            { label:'Email', placeholder:'alamat@email.com', type:'email', required:true },
            { label:'Pilih Kategori Durasi', placeholder:'Pilih kategori', type:'select', required:true, note:'Program Internasional, Vokasi 2 Tahun, Vokasi 1 Tahun, 1 Tahun Kapal Pesiar, Short Course 6 Bulan, Program Eksekutif (6 Bln)' },
            { label:'Program Diminati', placeholder:'Muncul setelah kategori dipilih', type:'select', required:true, note:'Otomatis menyesuaikan pilihan kategori' },
            { label:'Special Request / Pertanyaan', placeholder:'tuliskan hal yang Denpasar Hotel School perlu tindak lanjuti, misalnya hari, waktu dan lainnya', type:'textarea', required:false },
            { label:'Unggah Bukti Biaya Pendaftaran', placeholder:'JPG, PNG, PDF — maks. 2MB', type:'file', required:false },
            { label:'Unggah Bukti Biaya Program', placeholder:'JPG, PNG, PDF — maks. 2MB', type:'file', required:false },
            { label:'Informasi DHS diperoleh dari', placeholder:'', type:'checkbox', required:false, note:'Keluarga | Teman | Lembaga Tempat Belajar atau Kerja | Media Sosial | Situs Denpasar Hotel School | Pameran Pendidikan | Lainnya' }
        ],
        contact: {
            wa: '{{ $helpdesk["helpdesk_wa"] ?? "+62 81 246 319966" }}',
            email: '{{ $helpdesk["helpdesk_email"] ?? "sahabat@dhs.or.id" }}',
            hours: '{{ $helpdesk["helpdesk_hours"] ?? "Senin – Sabtu: 08:00 – 17:00 WITA" }}'
        },
        saveAll() {
            fetch('/backoffice/admisi/update-helpdesk', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    helpdesk_wa: this.contact.wa,
                    helpdesk_email: this.contact.email,
                    helpdesk_hours: this.contact.hours
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.saved = true;
                    setTimeout(() => this.saved = false, 3500);
                } else {
                    alert('Gagal menyimpan pengaturan helpdesk.');
                }
            })
            .catch(() => alert('Terjadi kesalahan koneksi saat menyimpan.'));
        }
    };
}
</script>
@endpush
