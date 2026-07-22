@extends('backoffice.layouts.app')
@section('title', 'Data Pendaftaran Online')
@section('page-title', 'Data Pendaftaran Online (Registrasi Baru)')

@section('content')
<div x-data="pendaftarData()">

    {{-- Alert Banner --}}
    <div x-show="savedMessage" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> <span x-text="savedMessage"></span>
    </div>

    {{-- Header Actions & Filter --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
            <div class="bo-search">
                <span class="material-icons-round" style="font-size:18px;color:#8A8478;">search</span>
                <input type="text" placeholder="Cari nama, email, hp, atau program..." x-model="search">
            </div>
            <select class="bo-select" style="width:auto;padding:8px 14px;font-size:13px;" x-model="filterStatus">
                <option value="semua">Semua Status</option>
                <option value="Baru">Status: Baru</option>
                <option value="Diproses">Status: Diproses</option>
                <option value="Diterima">Status: Diterima</option>
                <option value="Ditolak">Status: Ditolak</option>
            </select>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <button class="btn-secondary" style="padding:9px 14px;font-size:13px;" @click="exportExcel()">
                <span class="material-icons-round" style="font-size:18px;">download</span>
                Export Excel
            </button>
            <span class="badge badge-blue" style="padding:8px 14px;font-size:12px;" x-text="filteredItems.length + ' Pendaftar'"></span>
        </div>
    </div>

    {{-- Table --}}
    <div class="bo-card" style="padding:0;overflow:hidden;">
        <div style="overflow-x:auto;">
            <table class="bo-table">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Tgl Daftar</th>
                        <th>Nama Lengkap</th>
                        <th>Kontak (HP/WA & Email)</th>
                        <th>Program Diminati</th>
                        <th>Berkas Upload</th>
                        <th>Status</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(item, idx) in filteredItems" :key="item.id">
                        <tr>
                            <td style="font-weight:600;color:#8A8478;" x-text="idx + 1"></td>
                            <td style="white-space:nowrap;font-size:12.5px;color:#555;" x-text="item.tgl"></td>
                            <td>
                                <div style="font-weight:700;color:#2B2494;" x-text="item.nama"></div>
                                <div style="font-size:11px;color:#8A8478;" x-text="'Sumber Info: ' + (item.sumber || '-')"></div>
                            </td>
                            <td>
                                <div style="font-weight:600;" x-text="item.hp"></div>
                                <div style="font-size:12px;color:#666;" x-text="item.email"></div>
                            </td>
                            <td>
                                <div style="font-weight:600;color:#0010B8;" x-text="item.program"></div>
                                <div style="font-size:11px;color:#8A8478;" x-text="'Kategori: ' + item.kategori"></div>
                            </td>
                            <td>
                                <div style="display:flex;flex-direction:column;gap:4px;">
                                    <template x-if="item.bukti_pendaftaran">
                                        <span class="badge badge-green" style="font-size:10px;cursor:pointer;" @click="alert('Membuka file: ' + item.bukti_pendaftaran)">✓ Bukti Daftar</span>
                                    </template>
                                    <template x-if="item.bukti_program">
                                        <span class="badge badge-blue" style="font-size:10px;cursor:pointer;" @click="alert('Membuka file: ' + item.bukti_program)">✓ Bukti Program</span>
                                    </template>
                                    <template x-if="!item.bukti_pendaftaran && !item.bukti_program">
                                        <span style="font-size:11px;color:#aaa;italic;">Tidak ada file</span>
                                    </template>
                                </div>
                            </td>
                            <td>
                                <select class="bo-select" style="padding:4px 8px;font-size:11px;font-weight:700;border-radius:6px;width:auto;"
                                    :class="{
                                        'badge-blue': item.status === 'Baru',
                                        'badge-green': item.status === 'Diterima',
                                        'badge-red': item.status === 'Ditolak',
                                        'badge-gray': item.status === 'Diproses'
                                    }"
                                    x-model="item.status"
                                    @change="updateStatus(item)">
                                    <option value="Baru">Baru</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;justify-content:center;gap:6px;">
                                    <button class="btn-icon" title="Detail Pendaftar" @click="viewDetail(item)">
                                        <span class="material-icons-round" style="font-size:18px;">visibility</span>
                                    </button>
                                    <button class="btn-icon danger" title="Hapus Data" @click="deleteItem(item.id)">
                                        <span class="material-icons-round" style="font-size:18px;">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredItems.length === 0">
                        <td colspan="8" style="text-align:center;padding:32px;color:#8A8478;">
                            Belum ada pendaftar yang cocok dengan pencarian atau filter.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div class="bo-modal-backdrop" x-show="selectedItem" x-transition style="display:none;">
        <div class="bo-modal wide" @click.away="selectedItem = null">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;border-bottom:1px solid #eee;padding-bottom:12px;">
                <h3 style="margin:0;">Detail Formulir Pendaftaran</h3>
                <button class="btn-icon" @click="selectedItem = null"><span class="material-icons-round">close</span></button>
            </div>
            
            <template x-if="selectedItem">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div>
                        <label class="bo-label">Nama Lengkap</label>
                        <div class="bo-input" style="background:#fafafa;" x-text="selectedItem.nama"></div>
                    </div>
                    <div>
                        <label class="bo-label">Tanggal Mendaftar</label>
                        <div class="bo-input" style="background:#fafafa;" x-text="selectedItem.tgl"></div>
                    </div>
                    <div>
                        <label class="bo-label">No. HP / WhatsApp</label>
                        <div class="bo-input" style="background:#fafafa;display:flex;align-items:center;justify-content:space-between;">
                            <span x-text="selectedItem.hp"></span>
                            <a :href="'https://wa.me/' + selectedItem.hp.replace(/[^0-9]/g,'')" target="_blank" style="color:#16a34a;font-weight:700;font-size:12px;text-decoration:none;display:flex;align-items:center;gap:4px;">
                                <span class="material-icons-round" style="font-size:16px;">chat</span> Chat WA
                            </a>
                        </div>
                    </div>
                    <div>
                        <label class="bo-label">Email</label>
                        <div class="bo-input" style="background:#fafafa;" x-text="selectedItem.email"></div>
                    </div>
                    <div>
                        <label class="bo-label">Kategori Durasi</label>
                        <div class="bo-input" style="background:#fafafa;" x-text="selectedItem.kategori"></div>
                    </div>
                    <div>
                        <label class="bo-label">Program Studi Diminati</label>
                        <div class="bo-input" style="background:#fafafa;font-weight:700;color:#0010B8;" x-text="selectedItem.program"></div>
                    </div>
                    <div style="grid-column:1/-1;">
                        <label class="bo-label">Special Request / Catatan Khusus</label>
                        <div class="bo-textarea" style="background:#fafafa;min-height:70px;" x-text="selectedItem.special_request || 'Tidak ada catatan khusus'"></div>
                    </div>
                    <div style="grid-column:1/-1;">
                        <label class="bo-label">Informasi Diperoleh Dari:</label>
                        <div class="bo-input" style="background:#fafafa;" x-text="selectedItem.sumber || '-'"></div>
                    </div>
                    <div>
                        <label class="bo-label">Bukti Biaya Pendaftaran</label>
                        <div class="bo-input" style="background:#fafafa;">
                            <span x-text="selectedItem.bukti_pendaftaran || 'Tidak diunggah'"></span>
                        </div>
                    </div>
                    <div>
                        <label class="bo-label">Bukti Biaya Program</label>
                        <div class="bo-input" style="background:#fafafa;">
                            <span x-text="selectedItem.bukti_program || 'Tidak diunggah'"></span>
                        </div>
                    </div>
                </div>
            </template>
            
            <div style="margin-top:24px;text-align:right;">
                <button class="btn-primary" @click="selectedItem = null">Tutup</button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function pendaftarData() {
    return {
        search: '',
        filterStatus: 'semua',
        savedMessage: '',
        selectedItem: null,
        items: [
            { id: 1, tgl: '22 Jul 2026 14:20', nama: 'I Gede Agus Pratama', hp: '081234567890', email: 'agus.pratama@gmail.com', kategori: 'Program Internasional', program: 'Program 1 Tahun + Ausbildung Jerman', special_request: 'Mohon info mengenai kelas bahasa Jerman dan tes bakat.', sumber: 'Media Sosial, Teman', bukti_pendaftaran: 'bukti_pendaftaran_1.pdf', bukti_program: '', status: 'Baru' },
            { id: 2, tgl: '22 Jul 2026 11:05', nama: 'Ni Luh Putu Kirana', hp: '085739201948', email: 'kirana.putu@yahoo.com', kategori: 'Vokasi 2 Tahun', program: 'Perhotelan (FO & HK) — 2 Tahun', special_request: 'Ingin memilih jadwal kelas pagi.', sumber: 'Situs Denpasar Hotel School', bukti_pendaftaran: 'bukti_pendaftaran_2.jpg', bukti_program: 'bukti_program_2.jpg', status: 'Diproses' },
            { id: 3, tgl: '21 Jul 2026 16:45', nama: 'Made Dwi Septiawan', hp: '081999888777', email: 'dwi.septiawan@outlook.com', kategori: '1 Tahun Kapal Pesiar', program: 'Waiter & Bartender — Kapal Pesiar', special_request: 'Tolong konfirmasi jadwal tes fisik.', sumber: 'Keluarga', bukti_pendaftaran: 'bukti_pendaftaran_3.pdf', bukti_program: '', status: 'Diterima' }
        ],
        get filteredItems() {
            return this.items.filter(item => {
                const matchSearch = item.nama.toLowerCase().includes(this.search.toLowerCase()) ||
                                    item.email.toLowerCase().includes(this.search.toLowerCase()) ||
                                    item.hp.includes(this.search) ||
                                    item.program.toLowerCase().includes(this.search.toLowerCase());
                const matchStatus = this.filterStatus === 'semua' || item.status === this.filterStatus;
                return matchSearch && matchStatus;
            });
        },
        viewDetail(item) {
            this.selectedItem = item;
        },
        updateStatus(item) {
            this.savedMessage = 'Status pendaftar ' + item.nama + ' diperbarui menjadi: ' + item.status;
            setTimeout(() => this.savedMessage = '', 3000);
        },
        deleteItem(id) {
            if (confirm('Yakin ingin menghapus data pendaftar ini?')) {
                this.items = this.items.filter(i => i.id !== id);
                this.savedMessage = 'Data pendaftar berhasil dihapus.';
                setTimeout(() => this.savedMessage = '', 3000);
            }
        },
        exportExcel() {
            alert('Mengunduh rekap pendaftar (Excel/CSV)...');
        }
    }
}
</script>
@endpush
