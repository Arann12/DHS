<?php $__env->startSection('title', 'Editor Form Layanan & Beasiswa'); ?>
<?php $__env->startSection('page-title', 'Editor Lengkap Halaman Pengajuan Layanan & Beasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="layananSettingsCompleteData()">

    
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh pengaturan Halaman Form Pengajuan Layanan & Beasiswa berhasil disimpan ke database.
    </div>

    
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

    
    <div x-show="activeTab === 'fields'">
        <div class="bo-card" style="max-width:900px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <div>
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">1. Field Form Pengajuan Online</h2>
                    <p style="font-size:13px;color:#718096;margin:0;">Lihat dan kelola struktur field yang harus diisi pemohon beasiswa / dokumen di website.</p>
                </div>
                <button type="button" class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="fields.push({ label:'', placeholder:'', type:'text', required:false })">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Field
                </button>
            </div>

            
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;margin-bottom:20px;">
                <h4 style="margin:0 0 12px;font-size:14px;color:#0F2440;font-weight:700;">Teks Context & Header Form</h4>
                <div class="bo-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div>
                        <label class="bo-label" style="font-size:11px;">Badge Tag</label>
                        <input type="text" class="bo-input" style="padding:7px 10px;font-size:13px;" x-model="header.badge">
                    </div>
                    <div>
                        <label class="bo-label" style="font-size:11px;">Judul Main Header</label>
                        <input type="text" class="bo-input" style="padding:7px 10px;font-size:13px;" x-model="header.title">
                    </div>
                    <div style="grid-column:1/-1;">
                        <label class="bo-label" style="font-size:11px;">Petunjuk Pengisian / Instruksi Drive</label>
                        <input type="text" class="bo-input" style="padding:7px 10px;font-size:13px;" x-model="header.notice">
                    </div>
                    <div style="grid-column:1/-1;">
                        <label class="bo-label" style="font-size:11px;">Gambar Hero Background Halaman Form</label>
                        <div style="display:flex;gap:10px;align-items:center;">
                            <input type="text" class="bo-input" style="padding:7px 10px;font-size:13px;" x-model="header.hero_image" placeholder="URL Gambar / Klik tombol Pilih Gambar untuk upload (public/uploads/hero)">
                            <button type="button" class="btn-secondary" style="padding:7px 14px;font-size:12.5px;white-space:nowrap;display:flex;align-items:center;gap:4px;" @click="$store.imageUpload.open(url => header.hero_image = url, 'hero')">
                                <span class="material-icons-round" style="font-size:16px;">cloud_upload</span> Pilih / Upload Gambar
                            </button>
                        </div>
                        <template x-if="header.hero_image">
                            <div style="margin-top:8px;">
                                <img :src="header.hero_image" style="max-height:100px;border-radius:8px;border:1px solid #ddd;">
                            </div>
                        </template>
                    </div>
                </div>
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
                                        <option value="url">URL Link Drive</option>
                                        <option value="file">Upload File</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <label style="display:flex;align-items:center;gap:5px;cursor:pointer;font-size:12px;color:#555;">
                                    <input type="checkbox" x-model="field.required" style="accent-color:#1A365D;">
                                    Wajib
                                </label>
                                <button type="button" class="btn-icon danger" style="width:30px;height:30px;" @click="fields.splice(idx, 1)">
                                    <span class="material-icons-round" style="font-size:16px;">close</span>
                                </button>
                            </div>
                        </div>
                        <template x-if="field.note">
                            <div style="padding:8px 14px 10px 46px;border-top:1px dashed #e5e7eb;background:#f0f4ff;">
                                <span style="font-size:11px;color:#0F2440;font-weight:600;">📋 Catatan Field:</span>
                                <span style="font-size:11px;color:#555;margin-left:4px;" x-text="field.note"></span>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>

    
    <div x-show="activeTab === 'options'">
        <div style="display:grid;gap:24px;max-width:950px;">

            
            <div class="bo-card">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div>
                        <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">2A. Opsi Skema Beasiswa</h2>
                        <p style="font-size:12.5px;color:#718096;margin:0;">Pilihan beasiswa yang dapat dipilih pemohon pada dropdown formulir.</p>
                    </div>
                    <button type="button" class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="beasiswaOptions.push({ name:'Beasiswa Baru', desc:'Keterangan beasiswa...', is_active:true })">
                        <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Skema Beasiswa
                    </button>
                </div>

                <div style="display:grid;gap:10px;">
                    <template x-for="(opt, idx) in beasiswaOptions" :key="idx">
                        <div style="background:#fafafa;border:1.5px solid #eee;border-radius:12px;padding:12px 14px;display:grid;grid-template-columns:1fr 1fr 100px 40px;gap:12px;align-items:center;">
                            <div>
                                <label class="bo-label" style="font-size:11px;">Nama Beasiswa</label>
                                <input type="text" class="bo-input" style="padding:7px;font-weight:600;" x-model="opt.name">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Potongan / Deskripsi</label>
                                <input type="text" class="bo-input" style="padding:7px;" x-model="opt.desc">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Status</label>
                                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:12px;font-weight:600;margin-top:4px;">
                                    <input type="checkbox" x-model="opt.is_active" style="accent-color:#1A365D;">
                                    <span x-text="opt.is_active ? 'Aktif' : 'Off'" :style="opt.is_active ? 'color:#16a34a;' : 'color:#dc2626;'"></span>
                                </label>
                            </div>
                            <div style="text-align:right;">
                                <button type="button" class="btn-icon danger" style="width:30px;height:30px;" @click="beasiswaOptions.splice(idx, 1)">
                                    <span class="material-icons-round" style="font-size:16px;">close</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            
            <div class="bo-card">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div>
                        <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">2B. Opsi Layanan Dokumen & Sertifikasi</h2>
                        <p style="font-size:12.5px;color:#718096;margin:0;">Pilihan pengurusan dokumen yang tampil pada dropdown pengajuan dokumen.</p>
                    </div>
                    <button type="button" class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="dokumenOptions.push({ name:'Dokumen Baru', issuer:'DHS', duration:'1-3 hari', is_active:true })">
                        <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Jenis Dokumen
                    </button>
                </div>

                <div style="display:grid;gap:10px;">
                    <template x-for="(opt, idx) in dokumenOptions" :key="idx">
                        <div style="background:#fafafa;border:1.5px solid #eee;border-radius:12px;padding:12px 14px;display:grid;grid-template-columns:1.5fr 1fr 1fr 90px 40px;gap:12px;align-items:center;">
                            <div>
                                <label class="bo-label" style="font-size:11px;">Nama Dokumen</label>
                                <input type="text" class="bo-input" style="padding:7px;font-weight:600;" x-model="opt.name">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Lembaga / Penerbit</label>
                                <input type="text" class="bo-input" style="padding:7px;" x-model="opt.issuer">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Estimasi Waktu</label>
                                <input type="text" class="bo-input" style="padding:7px;" x-model="opt.duration">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Status</label>
                                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:12px;font-weight:600;margin-top:4px;">
                                    <input type="checkbox" x-model="opt.is_active" style="accent-color:#1A365D;">
                                    <span x-text="opt.is_active ? 'Aktif' : 'Off'" :style="opt.is_active ? 'color:#16a34a;' : 'color:#dc2626;'"></span>
                                </label>
                            </div>
                            <div style="text-align:right;">
                                <button type="button" class="btn-icon danger" style="width:30px;height:30px;" @click="dokumenOptions.splice(idx, 1)">
                                    <span class="material-icons-round" style="font-size:16px;">close</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>

    
    <div x-show="activeTab === 'contact'">
        <div class="bo-card" style="max-width:700px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 20px;">3. Kontak Helpdesk Layanan</h2>
            <div class="form-group">
                <label class="bo-label">No. WhatsApp Panitia Layanan & Beasiswa</label>
                <input type="text" class="bo-input" x-model="contact.wa">
            </div>
            <div class="form-group">
                <label class="bo-label">Email Helpdesk</label>
                <input type="text" class="bo-input" x-model="contact.email">
            </div>
            <div class="form-group">
                <label class="bo-label">Jam Operasional Pelayanan</label>
                <input type="text" class="bo-input" x-model="contact.hours">
            </div>
        </div>
    </div>

    
    <div x-show="activeTab === 'preview'">
        <div class="bo-card" style="max-width:750px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <div>
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">4. Preview Form Pengajuan</h2>
                    <p style="font-size:13px;color:#718096;margin:0;">Tampilan persis seperti yang dilihat pengisi form di website.</p>
                </div>
                <a href="/layanan" target="_blank" class="btn-secondary" style="padding:8px 14px;font-size:12.5px;display:flex;align-items:center;gap:6px;text-decoration:none;">
                    <span class="material-icons-round" style="font-size:16px;">open_in_new</span>
                    Buka Website Asli
                </a>
            </div>

            <div style="background:#f8f9fb;border:1.5px solid #e5e7eb;border-radius:12px;padding:24px;">
                <div style="text-align:center;margin-bottom:20px;">
                    <span style="font-size:10px;font-weight:700;letter-spacing:0.18em;color:#C3932F;text-transform:uppercase;" x-text="header.badge"></span>
                    <h3 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:8px 0 6px;" x-text="header.title"></h3>
                    <p style="font-size:12px;color:#718096;" x-text="header.notice"></p>
                </div>

                <template x-for="field in fields" :key="field.label">
                    <div style="margin-bottom:16px;">
                        <label style="display:block;font-size:13px;font-weight:600;color:#222;margin-bottom:6px;">
                            <span x-text="field.label"></span>
                            <span x-show="field.required" style="color:#ef4444;"> *</span>
                        </label>
                        <template x-if="field.type === 'text' || field.type === 'email' || field.type === 'tel' || field.type === 'url'">
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
                    </div>
                </template>

                <div style="margin-top:20px;">
                    <button disabled style="width:100%;padding:14px;background:#0F2440;color:#fff;font-weight:700;font-size:13px;letter-spacing:0.1em;text-transform:uppercase;border:none;border-radius:8px;cursor:not-allowed;opacity:0.8;">KIRIM PENGAJUAN SEKARANG</button>
                </div>
            </div>
        </div>
    </div>

    
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()">
            <span class="material-icons-round" style="font-size:20px;">save</span>
            Simpan Seluruh Pengaturan Form Layanan & Beasiswa
        </button>
        <a href="/layanan" target="_blank" class="btn-secondary" style="padding:12px 20px;font-size:13px;display:flex;align-items:center;gap:6px;text-decoration:none;">
            <span class="material-icons-round" style="font-size:18px;">open_in_new</span>
            Lihat Halaman Layanan di Website
        </a>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function layananSettingsCompleteData() {
    const rawSettings = <?php echo json_encode($settings, 15, 512) ?>;

    return {
        saved: false,
        activeTab: 'fields',
        tabs: [
            { id:'fields',   label:'1. Field Form',        icon:'assignment' },
            { id:'options',  label:'2. Opsi Beasiswa & Dokumen', icon:'list_alt' },
            { id:'contact',  label:'3. Kontak Helpdesk',   icon:'support_agent' },
            { id:'preview',  label:'4. Preview Form',      icon:'visibility' }
        ],
        header: {
            badge: rawSettings.badge_text || 'PENGAJUAN ONLINE DHS',
            title: rawSettings.header_title || 'Formulir Pengajuan Beasiswa & Dokumen',
            notice: rawSettings.notice_text || 'Silakan pilih jenis pengajuan yang diinginkan dan lengkapi data di bawah ini. Tim DHS akan segera memproses pengajuan Anda.',
            hero_image: rawSettings.hero_image || '/image/hero_registration.jpg'
        },
        fields: rawSettings.fields || [
            { label:'Pilih Jenis Pengajuan Utama', placeholder:'Pilih Beasiswa atau Dokumen', type:'select', required:true, note:'Pilih Beasiswa / Dokumen' },
            { label:'Nama Lengkap Pemohon', placeholder:'Masukkan nama lengkap sesuai KTP / Ijazah', type:'text', required:true },
            { label:'HP / WA (WhatsApp Aktif)', placeholder:'08xxxxxxxxxx', type:'tel', required:true },
            { label:'Alamat Email', placeholder:'alamat@email.com', type:'email', required:true },
            { label:'Program Studi / Dokumen', placeholder:'Pilih program atau jenis dokumen', type:'select', required:true, note:'Daftar menyesuaikan pilihan jenis pengajuan' },
            { label:'Link Berkas Berkas (Google Drive / Cloud)', placeholder:'https://drive.google.com/...', type:'url', required:true, note:'Instruksi pengunggahan berkas ke cloud storage' },
            { label:'Motivasi / Catatan Pengajuan', placeholder:'Tuliskan alasan atau catatan tambahan pengajuan Anda...', type:'textarea', required:false }
        ],
        beasiswaOptions: rawSettings.beasiswa_options || [
            { name: 'Beasiswa Prestasi', desc: 'Keringanan Biaya Pendidikan s/d 50%', is_active: true },
            { name: 'Beasiswa STT / Desa', desc: 'Utusan Sekaa Teruna & Desa Adat Bali', is_active: true },
            { name: 'Beasiswa Khusus', desc: 'Keluarga Kurang Mampu / KIP', is_active: true }
        ],
        dokumenOptions: rawSettings.dokumen_options || [
            { name: 'Passport', issuer: 'Ditjen Imigrasi & Dephub RI', duration: '7 – 14 hari kerja', is_active: true },
            { name: 'BST', issuer: 'STCW 2010 / Dephub RI', duration: '5 – 7 hari pelatihan', is_active: true },
            { name: 'SDSD', issuer: 'ISPS Code & STCW VI/6', duration: '2 – 3 hari pelatihan', is_active: true },
            { name: 'CCM', issuer: 'STCW V/2 (Passenger Ships)', duration: '2 – 3 hari pelatihan', is_active: true },
            { name: 'SSAT', issuer: 'STCW VI/6', duration: '1 – 2 hari pelatihan', is_active: true },
            { name: 'PSCRB', issuer: 'STCW VI/2', duration: '3 – 5 hari pelatihan', is_active: true },
            { name: 'C1/D Visa', issuer: 'US Embassy Jakarta & Surabaya', duration: '3 – 6 minggu', is_active: true }
        ],
        contact: {
            wa: rawSettings.helpdesk_wa || '+62 81 246 319966',
            email: rawSettings.helpdesk_email || 'sahabat@dhs.or.id',
            hours: rawSettings.helpdesk_hours || 'Senin – Sabtu: 08:00 – 17:00 WITA'
        },
        saveAll() {
            const payload = {
                settings: {
                    badge_text: this.header.badge,
                    header_title: this.header.title,
                    notice_text: this.header.notice,
                    hero_image: this.header.hero_image,
                    fields: this.fields,
                    beasiswa_options: this.beasiswaOptions,
                    dokumen_options: this.dokumenOptions,
                    helpdesk_wa: this.contact.wa,
                    helpdesk_email: this.contact.email,
                    helpdesk_hours: this.contact.hours
                }
            };

            fetch('/backoffice/layanan-settings/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.saved = true;
                    setTimeout(() => this.saved = false, 3500);
                } else {
                    alert('Gagal menyimpan pengaturan form.');
                }
            })
            .catch(() => alert('Terjadi kesalahan koneksi saat menyimpan.'));
        }
    };
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/layanan-settings.blade.php ENDPATH**/ ?>