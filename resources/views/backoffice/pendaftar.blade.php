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
                                <div style="font-weight:700;color:#101340;" x-text="item.nama"></div>
                                <div style="font-size:11px;color:#8A8478;" x-text="'Sumber Info: ' + (item.sumber || '-')"></div>
                            </td>
                            <td>
                                <div style="font-weight:600;" x-text="item.hp"></div>
                                <div style="font-size:12px;color:#666;" x-text="item.email"></div>
                            </td>
                            <td>
                                <div style="font-weight:600;color:#1A1F6B;" x-text="item.program"></div>
                                <div style="font-size:11px;color:#8A8478;" x-text="'Kategori: ' + item.kategori"></div>
                            </td>
                            <td>
                                <div style="display:flex;flex-direction:column;gap:4px;">
                                    <template x-if="item.bukti_pendaftaran_url">
                                        <a :href="item.bukti_pendaftaran_url" target="_blank" class="badge badge-green" style="font-size:10.5px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;" title="Klik untuk membuka Bukti Pendaftaran">
                                            <span class="material-icons-round" style="font-size:13px;">visibility</span> Bukti Daftar
                                        </a>
                                    </template>
                                    <template x-if="item.bukti_program_url">
                                        <a :href="item.bukti_program_url" target="_blank" class="badge badge-blue" style="font-size:10.5px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;" title="Klik untuk membuka Bukti Program">
                                            <span class="material-icons-round" style="font-size:13px;">visibility</span> Bukti Program
                                        </a>
                                    </template>
                                    <template x-if="!item.bukti_pendaftaran_url && !item.bukti_program_url">
                                        <span style="font-size:11px;color:#aaa;font-style:italic;">Tidak ada file</span>
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
                                    <button class="btn-icon" title="Detail & Gambar Pendaftar" @click="viewDetail(item)">
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
        <div class="bo-modal wide" @click.away="selectedItem = null" style="max-width:850px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;border-bottom:1px solid #eee;padding-bottom:12px;">
                <h3 style="margin:0;font-family:'Playfair Display',serif;color:#101340;">Detail Formulir Pendaftaran</h3>
                <button class="btn-icon" @click="selectedItem = null"><span class="material-icons-round">close</span></button>
            </div>
            
            <template x-if="selectedItem">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div>
                        <label class="bo-label">Nama Lengkap</label>
                        <div class="bo-input" style="background:#fafafa;font-weight:700;" x-text="selectedItem.nama"></div>
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
                        <div class="bo-input" style="background:#fafafa;font-weight:700;color:#1A1F6B;" x-text="selectedItem.program"></div>
                    </div>
                    <div style="grid-column:1/-1;">
                        <label class="bo-label">Special Request / Catatan Khusus</label>
                        <div class="bo-textarea" style="background:#fafafa;min-height:60px;" x-text="selectedItem.special_request || 'Tidak ada catatan khusus'"></div>
                    </div>
                    <div style="grid-column:1/-1;">
                        <label class="bo-label">Informasi Diperoleh Dari:</label>
                        <div class="bo-input" style="background:#fafafa;" x-text="selectedItem.sumber || '-'"></div>
                    </div>

                    {{-- Section Preview Gambar / Berkas Upload --}}
                    <div style="grid-column:1/-1;border-top:1px solid #eee;padding-top:16px;margin-top:4px;">
                        <h4 style="font-size:14px;font-weight:700;color:#101340;margin:0 0 14px;">Berkas Upload & Bukti Pembayaran</h4>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                            {{-- Bukti Pendaftaran --}}
                            <div>
                                <label class="bo-label">Bukti Biaya Pendaftaran</label>
                                <template x-if="selectedItem.bukti_pendaftaran_url">
                                    <div style="border:1.5px solid #e5e7eb;border-radius:12px;padding:12px;background:#fafafa;">
                                        <template x-if="isImage(selectedItem.bukti_pendaftaran_url)">
                                            <div style="text-align:center;">
                                                <a :href="selectedItem.bukti_pendaftaran_url" target="_blank" title="Klik untuk memperbesar">
                                                    <img :src="selectedItem.bukti_pendaftaran_url" alt="Bukti Pendaftaran" style="max-height:220px;width:auto;max-width:100%;border-radius:8px;object-fit:contain;margin:0 auto 10px;display:block;border:1px solid #ddd;box-shadow:0 3px 10px rgba(0,0,0,0.08);">
                                                </a>
                                                <a :href="selectedItem.bukti_pendaftaran_url" target="_blank" class="btn-secondary" style="font-size:11.5px;padding:6px 14px;text-decoration:none;display:inline-flex;align-items:center;gap:5px;">
                                                    <span class="material-icons-round" style="font-size:15px;">open_in_new</span> Lihat Gambar Ukuran Penuh
                                                </a>
                                            </div>
                                        </template>
                                        <template x-if="!isImage(selectedItem.bukti_pendaftaran_url)">
                                            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                                                <span style="font-size:12px;color:#333;font-weight:600;word-break:break-all;" x-text="selectedItem.bukti_pendaftaran_name"></span>
                                                <a :href="selectedItem.bukti_pendaftaran_url" target="_blank" class="btn-primary" style="font-size:11.5px;padding:6px 14px;text-decoration:none;display:inline-flex;align-items:center;gap:5px;flex-shrink:0;">
                                                    <span class="material-icons-round" style="font-size:15px;">picture_as_pdf</span> Buka / Unduh File
                                                </a>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="!selectedItem.bukti_pendaftaran_url">
                                    <div class="bo-input" style="background:#fafafa;color:#8A8478;font-style:italic;">Tidak ada file diunggah</div>
                                </template>
                            </div>

                            {{-- Bukti Program --}}
                            <div>
                                <label class="bo-label">Bukti Biaya Program</label>
                                <template x-if="selectedItem.bukti_program_url">
                                    <div style="border:1.5px solid #e5e7eb;border-radius:12px;padding:12px;background:#fafafa;">
                                        <template x-if="isImage(selectedItem.bukti_program_url)">
                                            <div style="text-align:center;">
                                                <a :href="selectedItem.bukti_program_url" target="_blank" title="Klik untuk memperbesar">
                                                    <img :src="selectedItem.bukti_program_url" alt="Bukti Program" style="max-height:220px;width:auto;max-width:100%;border-radius:8px;object-fit:contain;margin:0 auto 10px;display:block;border:1px solid #ddd;box-shadow:0 3px 10px rgba(0,0,0,0.08);">
                                                </a>
                                                <a :href="selectedItem.bukti_program_url" target="_blank" class="btn-secondary" style="font-size:11.5px;padding:6px 14px;text-decoration:none;display:inline-flex;align-items:center;gap:5px;">
                                                    <span class="material-icons-round" style="font-size:15px;">open_in_new</span> Lihat Gambar Ukuran Penuh
                                                </a>
                                            </div>
                                        </template>
                                        <template x-if="!isImage(selectedItem.bukti_program_url)">
                                            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                                                <span style="font-size:12px;color:#333;font-weight:600;word-break:break-all;" x-text="selectedItem.bukti_program_name"></span>
                                                <a :href="selectedItem.bukti_program_url" target="_blank" class="btn-primary" style="font-size:11.5px;padding:6px 14px;text-decoration:none;display:inline-flex;align-items:center;gap:5px;flex-shrink:0;">
                                                    <span class="material-icons-round" style="font-size:15px;">picture_as_pdf</span> Buka / Unduh File
                                                </a>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="!selectedItem.bukti_program_url">
                                    <div class="bo-input" style="background:#fafafa;color:#8A8478;font-style:italic;">Tidak ada file diunggah</div>
                                </template>
                            </div>
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
@php
    $initialData = collect($pendaftarList ?? [])->map(function($reg) {
        $sources = [];
        if (is_array($reg->info_sources)) {
            $sources = $reg->info_sources;
        } elseif (is_string($reg->info_sources) && !empty($reg->info_sources)) {
            $decoded = json_decode($reg->info_sources, true);
            $sources = is_array($decoded) ? $decoded : [$reg->info_sources];
        }

        $statusMap = [
            'pending' => 'Baru',
            'verified' => 'Diproses',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
            'cancelled' => 'Ditolak'
        ];

        return [
            'id' => $reg->id,
            'tgl' => \Carbon\Carbon::parse($reg->created_at)->format('d M Y H:i'),
            'nama' => $reg->full_name,
            'hp' => $reg->phone,
            'email' => $reg->email,
            'kategori' => $reg->category_key ?? '-',
            'program' => $reg->program_title ?? '-',
            'special_request' => $reg->special_request ?? '',
            'sumber' => count($sources) > 0 ? implode(', ', $sources) : '-',
            'bukti_pendaftaran_url' => $reg->registration_fee_proof ? asset($reg->registration_fee_proof) : null,
            'bukti_pendaftaran_name' => $reg->registration_fee_proof ? basename($reg->registration_fee_proof) : '',
            'bukti_program_url' => $reg->program_fee_proof ? asset($reg->program_fee_proof) : null,
            'bukti_program_name' => $reg->program_fee_proof ? basename($reg->program_fee_proof) : '',
            'status' => $statusMap[$reg->status] ?? 'Baru',
        ];
    });
@endphp

@endsection

@push('scripts')
<script>
function pendaftarData() {
    return {
        search: '',
        filterStatus: 'semua',
        savedMessage: '',
        selectedItem: null,
        items: @json($initialData),
        get filteredItems() {
            return this.items.filter(item => {
                const matchSearch = (item.nama || '').toLowerCase().includes(this.search.toLowerCase()) ||
                                    (item.email || '').toLowerCase().includes(this.search.toLowerCase()) ||
                                    (item.hp || '').includes(this.search) ||
                                    (item.program || '').toLowerCase().includes(this.search.toLowerCase());
                const matchStatus = this.filterStatus === 'semua' || item.status === this.filterStatus;
                return matchSearch && matchStatus;
            });
        },
        isImage(url) {
            if (!url) return false;
            const cleanUrl = url.split('?')[0];
            const ext = cleanUrl.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(ext);
        },
        viewDetail(item) {
            this.selectedItem = item;
        },
        updateStatus(item) {
            fetch('/backoffice/pendaftar/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: item.id, status: item.status })
            }).then(res => res.json()).then(data => {
                this.savedMessage = 'Status pendaftar ' + item.nama + ' diperbarui di database: ' + item.status;
                setTimeout(() => this.savedMessage = '', 3000);
            });
        },
        deleteItem(id) {
            if (confirm('Yakin ingin menghapus data pendaftar ini dari database?')) {
                fetch('/backoffice/pendaftar/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id })
                }).then(res => res.json()).then(data => {
                    this.items = this.items.filter(i => i.id !== id);
                    this.savedMessage = 'Data pendaftar berhasil dihapus dari database.';
                    setTimeout(() => this.savedMessage = '', 3000);
                });
            }
        },
        exportExcel() {
            window.location.href = '/backoffice/pendaftar/export';
        }
    }
}
</script>
@endpush
