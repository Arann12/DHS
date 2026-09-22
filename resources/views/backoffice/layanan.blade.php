@extends('backoffice.layouts.app')
@section('title', 'Kelola Pengajuan Layanan & Beasiswa')
@section('page-title', 'Kelola Pengajuan Beasiswa & Layanan Dokumen')

@section('content')
<div x-data="layananData()">

    {{-- Alert Banner --}}
    <div x-show="savedMessage" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> <span x-text="savedMessage"></span>
    </div>

    {{-- Top Action Bar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div style="font-size:13px;color:#718096;">
            Kelola data masuk dan atur isian opsi formulir pengajuan beasiswa & dokumen.
        </div>
        <a href="/backoffice/layanan-settings" class="btn-primary" style="padding:9px 16px;font-size:13px;">
            <span class="material-icons-round" style="font-size:18px;">tune</span> Editor Isian Formulir
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="bo-grid-stats" style="display:grid;grid-template-columns:repeat(5, 1fr);gap:16px;margin-bottom:24px;">
        <div class="bo-card" style="padding:16px;display:flex;align-items:center;gap:14px;">
            <div style="width:44px;height:44px;border-radius:12px;background:rgba(26,54,93,0.1);color:#1A365D;display:flex;align-items:center;justify-content:center;">
                <span class="material-icons-round" style="font-size:24px;">folder_shared</span>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;color:#718096;text-transform:uppercase;">Total Pengajuan</div>
                <div style="font-size:20px;font-weight:800;color:#0F2440;" x-text="stats.total"></div>
            </div>
        </div>
        <div class="bo-card" style="padding:16px;display:flex;align-items:center;gap:14px;">
            <div style="width:44px;height:44px;border-radius:12px;background:rgba(234,179,8,0.15);color:#ca8a04;display:flex;align-items:center;justify-content:center;">
                <span class="material-icons-round" style="font-size:24px;">pending_actions</span>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;color:#718096;text-transform:uppercase;">Menunggu (Pending)</div>
                <div style="font-size:20px;font-weight:800;color:#ca8a04;" x-text="stats.pending"></div>
            </div>
        </div>
        <div class="bo-card" style="padding:16px;display:flex;align-items:center;gap:14px;">
            <div style="width:44px;height:44px;border-radius:12px;background:rgba(34,197,94,0.15);color:#16a34a;display:flex;align-items:center;justify-content:center;">
                <span class="material-icons-round" style="font-size:24px;">verified</span>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;color:#718096;text-transform:uppercase;">Diterima</div>
                <div style="font-size:20px;font-weight:800;color:#16a34a;" x-text="stats.accepted"></div>
            </div>
        </div>
        <div class="bo-card" style="padding:16px;display:flex;align-items:center;gap:14px;">
            <div style="width:44px;height:44px;border-radius:12px;background:rgba(59,130,246,0.15);color:#2563eb;display:flex;align-items:center;justify-content:center;">
                <span class="material-icons-round" style="font-size:24px;">school</span>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;color:#718096;text-transform:uppercase;">Pengajuan Beasiswa</div>
                <div style="font-size:20px;font-weight:800;color:#2563eb;" x-text="stats.beasiswa"></div>
            </div>
        </div>
        <div class="bo-card" style="padding:16px;display:flex;align-items:center;gap:14px;">
            <div style="width:44px;height:44px;border-radius:12px;background:rgba(168,85,247,0.15);color:#9333ea;display:flex;align-items:center;justify-content:center;">
                <span class="material-icons-round" style="font-size:24px;">description</span>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;color:#718096;text-transform:uppercase;">Pengajuan Dokumen</div>
                <div style="font-size:20px;font-weight:800;color:#9333ea;" x-text="stats.dokumen"></div>
            </div>
        </div>
    </div>

    {{-- Tabs & Filters --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:14px;">
        {{-- Tipe Tabs --}}
        <div style="display:flex;background:#e2e8f0;padding:4px;border-radius:12px;gap:4px;">
            <button @click="filterTipe = 'semua'" :class="filterTipe === 'semua' ? 'btn-primary' : ''" style="border:none;padding:7px 16px;font-size:13px;border-radius:8px;font-weight:600;cursor:pointer;" class="btn-tab">
                Semua Tipe
            </button>
            <button @click="filterTipe = 'beasiswa'" :class="filterTipe === 'beasiswa' ? 'btn-primary' : ''" style="border:none;padding:7px 16px;font-size:13px;border-radius:8px;font-weight:600;cursor:pointer;" class="btn-tab">
                🎓 Beasiswa
            </button>
            <button @click="filterTipe = 'dokumen'" :class="filterTipe === 'dokumen' ? 'btn-primary' : ''" style="border:none;padding:7px 16px;font-size:13px;border-radius:8px;font-weight:600;cursor:pointer;" class="btn-tab">
                📄 Dokumen
            </button>
        </div>

        {{-- Filter & Search --}}
        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
            <div class="bo-search">
                <span class="material-icons-round" style="font-size:18px;color:#718096;">search</span>
                <input type="text" placeholder="Cari nama, email, HP, atau program..." x-model="search">
            </div>
            <select class="bo-select" style="width:auto;padding:8px 14px;font-size:13px;" x-model="filterStatus">
                <option value="semua">Semua Status</option>
                <option value="pending">Status: Menunggu (Pending)</option>
                <option value="verified">Status: Diproses (Verified)</option>
                <option value="accepted">Status: Diterima (Accepted)</option>
                <option value="rejected">Status: Ditolak (Rejected)</option>
            </select>
            <select class="bo-select" style="width:auto;padding:8px 14px;font-size:13px;" x-model="filterJawaban">
                <option value="semua">Semua Jawaban</option>
                <option value="sudah">Sudah Dijawab Admin</option>
                <option value="belum">Belum Dijawab Admin</option>
            </select>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bo-card" style="padding:0;overflow:hidden;">
        <div style="overflow-x:auto;">
            <table class="bo-table">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Tgl Pengajuan</th>
                        <th>Pemohon</th>
                        <th>Tipe & Program / Dokumen</th>
                        <th>Berkas Upload</th>
                        <th>Status Pengajuan</th>
                        <th>Jawaban Admin</th>
                        <th style="width:150px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(item, idx) in filteredItems" :key="item.id">
                        <tr>
                            <td style="font-weight:600;color:#718096;" x-text="idx + 1"></td>
                            <td style="white-space:nowrap;font-size:12px;color:#555;" x-text="item.tgl"></td>
                            <td>
                                <div style="font-weight:700;color:#0F2440;" x-text="item.nama"></div>
                                <div style="font-size:12px;color:#4a5568;" x-text="item.hp"></div>
                                <div style="font-size:11px;color:#718096;" x-text="item.email"></div>
                            </td>
                            <td>
                                <div style="margin-bottom:3px;">
                                    <span class="badge" :class="item.isBeasiswa ? 'badge-blue' : 'badge-gray'" style="font-size:10px;" x-text="item.isBeasiswa ? 'BEASISWA' : 'LAYANAN DOKUMEN'"></span>
                                </div>
                                <div style="font-weight:700;color:#1A365D;font-size:13px;" x-text="item.program"></div>
                                <div style="font-size:11px;color:#718096;" x-text="item.skemaOrTujuan"></div>
                            </td>
                            <td>
                                <template x-if="item.link_berkas">
                                    <a :href="item.link_berkas" target="_blank" class="badge badge-blue" style="font-size:11px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;" title="Buka Link Drive Berkas">
                                        <span class="material-icons-round" style="font-size:14px;">open_in_new</span> Buka Berkas (Drive)
                                    </a>
                                </template>
                                <template x-if="!item.link_berkas">
                                    <span style="font-size:11px;color:#aaa;font-style:italic;">Tidak ada link</span>
                                </template>
                            </td>
                            <td>
                                <select class="bo-select" style="padding:4px 8px;font-size:11px;font-weight:700;border-radius:6px;width:auto;"
                                    :class="{
                                        'badge-blue': item.status === 'pending',
                                        'badge-gray': item.status === 'verified',
                                        'badge-green': item.status === 'accepted',
                                        'badge-red': item.status === 'rejected'
                                    }"
                                    x-model="item.status"
                                    @change="updateStatus(item)">
                                    <option value="pending">Menunggu (Pending)</option>
                                    <option value="verified">Diproses (Verified)</option>
                                    <option value="accepted">Diterima (Accepted)</option>
                                    <option value="rejected">Ditolak (Rejected)</option>
                                </select>
                            </td>
                            <td>
                                <template x-if="item.admin_reply">
                                    <div>
                                        <span class="badge badge-green" style="font-size:10px;">✓ SUDAH DIJAWAB</span>
                                        <div style="font-size:11px;color:#555;margin-top:2px;max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" x-text="item.admin_reply"></div>
                                    </div>
                                </template>
                                <template x-if="!item.admin_reply">
                                    <span class="badge badge-red" style="font-size:10px;">BELUM DIJAWAB</span>
                                </template>
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;justify-content:center;gap:6px;">
                                    <button class="btn-primary" style="padding:5px 10px;font-size:12px;" title="Lihat & Jawab Pengajuan" @click="openModal(item)">
                                        <span class="material-icons-round" style="font-size:15px;">reply</span> Jawab
                                    </button>
                                    <a :href="getWaUrl(item)" target="_blank" class="btn-icon" style="color:#16a34a;background:#f0fdf4;" title="Kirim Pesan WA">
                                        <span class="material-icons-round" style="font-size:18px;">chat</span>
                                    </a>
                                    <button class="btn-icon danger" title="Hapus Data" @click="deleteItem(item.id)">
                                        <span class="material-icons-round" style="font-size:18px;">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredItems.length === 0">
                        <td colspan="8" style="text-align:center;padding:36px;color:#718096;">
                            Tidak ada pengajuan yang cocok dengan filter atau pencarian Anda.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL DETAIL & JAWAB ADMIN --}}
    <div class="bo-modal-backdrop" x-show="selectedItem" x-transition style="display:none;">
        <div class="bo-modal wide" @click.away="selectedItem = null" style="max-width:850px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;border-bottom:1px solid #eee;padding-bottom:12px;">
                <div>
                    <h3 style="margin:0;font-family:'Playfair Display',serif;color:#0F2440;">Detail & Jawaban Pengajuan</h3>
                    <div style="font-size:12px;color:#718096;" x-text="selectedItem ? 'ID Pengajuan #' + selectedItem.id + ' • ' + selectedItem.tgl : ''"></div>
                </div>
                <button class="btn-icon" @click="selectedItem = null"><span class="material-icons-round">close</span></button>
            </div>
            
            <template x-if="selectedItem">
                <div>
                    <div class="bo-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                        <div>
                            <label class="bo-label">Nama Pemohon</label>
                            <div class="bo-input" style="background:#fafafa;font-weight:700;" x-text="selectedItem.nama"></div>
                        </div>
                        <div>
                            <label class="bo-label">Status Pengajuan</label>
                            <select class="bo-select" x-model="selectedItem.status">
                                <option value="pending">Menunggu (Pending)</option>
                                <option value="verified">Diproses (Verified)</option>
                                <option value="accepted">Diterima (Accepted)</option>
                                <option value="rejected">Ditolak (Rejected)</option>
                            </select>
                        </div>
                        <div>
                            <label class="bo-label">Nomor WhatsApp</label>
                            <div class="bo-input" style="background:#fafafa;display:flex;align-items:center;justify-content:space-between;">
                                <span x-text="selectedItem.hp"></span>
                                <a :href="getWaUrl(selectedItem)" target="_blank" style="color:#16a34a;font-weight:700;font-size:12px;text-decoration:none;display:flex;align-items:center;gap:4px;">
                                    <span class="material-icons-round" style="font-size:16px;">chat</span> Kirim WA
                                </a>
                            </div>
                        </div>
                        <div>
                            <label class="bo-label">Email</label>
                            <div class="bo-input" style="background:#fafafa;" x-text="selectedItem.email"></div>
                        </div>
                        <div>
                            <label class="bo-label">Tipe Layanan</label>
                            <div class="bo-input" style="background:#fafafa;font-weight:700;color:#1A365D;" x-text="selectedItem.isBeasiswa ? 'Pengajuan Beasiswa' : 'Pengajuan Dokumen'"></div>
                        </div>
                        <div>
                            <label class="bo-label">Program / Jenis Dokumen</label>
                            <div class="bo-input" style="background:#fafafa;font-weight:700;" x-text="selectedItem.program"></div>
                        </div>

                        <div style="grid-column:1/-1;">
                            <label class="bo-label">Link Berkas (Google Drive / Cloud)</label>
                            <div style="display:flex;gap:10px;">
                                <input type="text" class="bo-input" style="background:#fafafa;" :value="selectedItem.link_berkas || 'Tidak ada link'" readonly>
                                <template x-if="selectedItem.link_berkas">
                                    <a :href="selectedItem.link_berkas" target="_blank" class="btn-primary" style="white-space:nowrap;padding:9px 16px;">
                                        <span class="material-icons-round" style="font-size:16px;">open_in_new</span> Buka Link
                                    </a>
                                </template>
                            </div>
                        </div>

                        <div style="grid-column:1/-1;">
                            <label class="bo-label">Rincian / Special Request Dari Form</label>
                            <div class="bo-textarea" style="background:#fafafa;min-height:90px;white-space:pre-line;font-size:13px;" x-text="selectedItem.special_request || 'Tidak ada catatan.'"></div>
                        </div>
                    </div>

                    {{-- FORM JAWABAN ADMIN --}}
                    <div style="border-top:2px solid #e2e8f0;padding-top:20px;margin-top:20px;background:#f8fafc;padding:20px;border-radius:14px;">
                        <h4 style="margin:0 0 12px;font-size:15px;font-weight:700;color:#0F2440;display:flex;align-items:center;gap:8px;">
                            <span class="material-icons-round" style="color:#2563eb;">rate_review</span>
                            Jawaban & Balasan Admin DHS
                        </h4>

                        {{-- Quick Templates --}}
                        <div style="margin-bottom:12px;">
                            <label class="bo-label" style="font-size:11px;color:#64748b;">Template Jawaban Cepat:</label>
                            <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                <button type="button" class="btn-secondary" style="padding:4px 10px;font-size:11px;" @click="applyTemplate('setuju')">
                                    ✓ Disetujui / Diterima
                                </button>
                                <button type="button" class="btn-secondary" style="padding:4px 10px;font-size:11px;" @click="applyTemplate('proses')">
                                    ⏳ Sedang Diproses / Verifikasi
                                </button>
                                <button type="button" class="btn-secondary" style="padding:4px 10px;font-size:11px;" @click="applyTemplate('berkas')">
                                    ⚠️ Perlu Perbaikan Berkas
                                </button>
                                <button type="button" class="btn-secondary" style="padding:4px 10px;font-size:11px;" @click="applyTemplate('tolak')">
                                    ✕ Belum Memenuhi Syarat
                                </button>
                            </div>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label class="bo-label">Isi Jawaban / Balasan Resmi Admin <span style="color:red;">*</span></label>
                            <textarea class="bo-textarea" style="min-height:120px;font-size:13.5px;" placeholder="Tuliskan jawaban atau status balasan untuk pemohon di sini..." x-model="selectedItem.admin_reply"></textarea>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label class="bo-label">Catatan Internal Admin (Hanya terlihat oleh tim backoffice)</label>
                            <input type="text" class="bo-input" placeholder="Contoh: Sudah dikonfirmasi via telepon tgl 20 Aug" x-model="selectedItem.notes">
                        </div>

                        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:20px;">
                            <a :href="getWaUrl(selectedItem)" target="_blank" class="btn-secondary" style="color:#16a34a;border-color:#16a34a;">
                                <span class="material-icons-round">chat</span> Kirim Jawaban via WhatsApp
                            </a>
                            <div style="display:flex;gap:10px;">
                                <button type="button" class="btn-secondary" @click="selectedItem = null">Batal</button>
                                <button type="button" class="btn-primary" @click="saveReply(selectedItem)" :disabled="saving">
                                    <span class="material-icons-round" x-text="saving ? 'hourglass_empty' : 'save'"></span>
                                    <span x-text="saving ? 'Menyimpan...' : 'Simpan Jawaban'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </template>
        </div>
    </div>

</div>

@php
    $initialData = collect($items ?? [])->map(function($reg) {
        $categoryKey = $reg->category_key ?? '';
        $isBeasiswa  = in_array($categoryKey, ['beasiswa', 'beasiswa-prestasi', 'beasiswa-stt', 'beasiswa-khusus']);
        
        // Extract link drive if available in special_request
        $linkDrive = '';
        if (preg_match('/Link Berkas \(Drive\):\s*(https?:\/\/[^\s]+)/i', $reg->special_request ?? '', $matches)) {
            $linkDrive = trim($matches[1]);
        }

        return [
            'id'              => $reg->id,
            'tgl'             => \Carbon\Carbon::parse($reg->created_at)->format('d M Y H:i'),
            'nama'            => $reg->full_name,
            'hp'              => $reg->phone,
            'email'           => $reg->email,
            'category_key'    => $categoryKey,
            'isBeasiswa'      => $isBeasiswa,
            'program'         => $reg->program_title ?? '-',
            'skemaOrTujuan'   => $isBeasiswa ? 'Pengajuan Beasiswa' : 'Pengajuan Dokumen',
            'special_request' => $reg->special_request ?? '',
            'link_berkas'     => $linkDrive,
            'status'          => $reg->status ?? 'pending',
            'admin_reply'     => $reg->admin_reply ?? '',
            'notes'           => $reg->notes ?? '',
            'replied_at'      => $reg->replied_at ? \Carbon\Carbon::parse($reg->replied_at)->format('d M Y H:i') : null,
        ];
    });
    $initialStats = $stats ?? ['total' => 0, 'pending' => 0, 'accepted' => 0, 'beasiswa' => 0, 'dokumen' => 0];
@endphp

@endsection

@push('scripts')
<script>
function layananData() {
    return {
        search: '{{ $search ?? "" }}',
        filterTipe: '{{ $tipe ?? "semua" }}',
        filterStatus: '{{ $status ?? "semua" }}',
        filterJawaban: 'semua',
        savedMessage: '',
        saving: false,
        selectedItem: null,
        stats: @json($initialStats),
        items: @json($initialData),

        get filteredItems() {
            return this.items.filter(item => {
                const searchLower = this.search.toLowerCase();
                const matchSearch = !this.search || 
                                    (item.nama || '').toLowerCase().includes(searchLower) ||
                                    (item.email || '').toLowerCase().includes(searchLower) ||
                                    (item.hp || '').includes(this.search) ||
                                    (item.program || '').toLowerCase().includes(searchLower);

                const matchTipe = this.filterTipe === 'semua' || 
                                 (this.filterTipe === 'beasiswa' && item.isBeasiswa) ||
                                 (this.filterTipe === 'dokumen' && !item.isBeasiswa);

                const matchStatus = this.filterStatus === 'semua' || item.status === this.filterStatus;

                const matchJawaban = this.filterJawaban === 'semua' ||
                                    (this.filterJawaban === 'sudah' && item.admin_reply) ||
                                    (this.filterJawaban === 'belum' && !item.admin_reply);

                return matchSearch && matchTipe && matchStatus && matchJawaban;
            });
        },

        openModal(item) {
            this.selectedItem = JSON.parse(JSON.stringify(item));
        },

        applyTemplate(type) {
            if (!this.selectedItem) return;
            const nama = this.selectedItem.nama;
            const prog = this.selectedItem.program;

            if (type === 'setuju') {
                this.selectedItem.admin_reply = `Halo Kak ${nama},\n\nHasil verifikasi pengajuan (${prog}) Anda di Denpasar Hotel School telah DISETUJUI / DITERIMA. Tim admisi DHS akan memproses tahap selanjutnya. Silakan hubungi kami untuk informasi lebih lanjut. Terima kasih.`;
                this.selectedItem.status = 'accepted';
            } else if (type === 'proses') {
                this.selectedItem.admin_reply = `Halo Kak ${nama},\n\nPengajuan (${prog}) Anda sedang dalam tahap VERIFIKASI & PROSES oleh tim administrasi DHS. Mohon bersabar, kami akan mengabari Anda kembali dalam 1-2 hari kerja. Terima kasih.`;
                this.selectedItem.status = 'verified';
            } else if (type === 'berkas') {
                this.selectedItem.admin_reply = `Halo Kak ${nama},\n\nPengajuan (${prog}) Anda memerlukan perbaikan / kelengkapan berkas pendukung. Mohon pastikan link Google Drive atau berkas dokumen yang diunggah dapat diakses publik. Terima kasih.`;
                this.selectedItem.status = 'verified';
            } else if (type === 'tolak') {
                this.selectedItem.admin_reply = `Halo Kak ${nama},\n\nMohon maaf, pengajuan (${prog}) Anda belum memenuhi kuota / persyaratan administrasi DHS pada periode ini. Terima kasih atas ketertarikan Anda pada program Denpasar Hotel School.`;
                this.selectedItem.status = 'rejected';
            }
        },

        updateStatus(item) {
            fetch(`/backoffice/layanan/${item.id}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: item.status })
            }).then(res => res.json()).then(data => {
                const original = this.items.find(i => i.id === item.id);
                if (original) original.status = item.status;
                this.savedMessage = `Status pengajuan ${item.nama} diperbarui menjadi: ${item.status}`;
                setTimeout(() => this.savedMessage = '', 3500);
            });
        },

        saveReply(item) {
            if (!item.admin_reply || !item.admin_reply.trim()) {
                alert('Silakan isi Jawaban Admin terlebih dahulu.');
                return;
            }

            this.saving = true;

            // Save reply
            fetch(`/backoffice/layanan/${item.id}/update-reply`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    admin_reply: item.admin_reply,
                    notes: item.notes
                })
            }).then(res => res.json()).then(data => {
                // Also update status
                return fetch(`/backoffice/layanan/${item.id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: item.status, notes: item.notes })
                });
            }).then(res => res.json()).then(data => {
                this.saving = false;
                const original = this.items.find(i => i.id === item.id);
                if (original) {
                    original.admin_reply = item.admin_reply;
                    original.notes = item.notes;
                    original.status = item.status;
                }
                this.savedMessage = `Jawaban resmi untuk ${item.nama} telah berhasil disimpan!`;
                this.selectedItem = null;
                setTimeout(() => this.savedMessage = '', 4000);
            }).catch(err => {
                this.saving = false;
                alert('Gagal menyimpan jawaban. Silakan coba lagi.');
            });
        },

        deleteItem(id) {
            if (confirm('Yakin ingin menghapus data pengajuan ini? Data tidak dapat dikembalikan.')) {
                fetch(`/backoffice/layanan/${id}/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => res.json()).then(data => {
                    this.items = this.items.filter(i => i.id !== id);
                    this.savedMessage = 'Data pengajuan berhasil dihapus dari sistem.';
                    setTimeout(() => this.savedMessage = '', 3500);
                });
            }
        },

        getWaUrl(item) {
            if (!item || !item.hp) return '#';
            const cleanHp = item.hp.replace(/[^0-9]/g, '');
            const formattedHp = cleanHp.startsWith('0') ? '62' + cleanHp.slice(1) : cleanHp;
            
            let msg = `Halo ${item.nama}, terkait pengajuan ${item.program} Anda di Denpasar Hotel School:\n\n`;
            if (item.admin_reply) {
                msg += item.admin_reply;
            } else {
                msg += `Pengajuan Anda saat ini berstatus: *${item.status.toUpperCase()}*. Terima kasih.`;
            }
            return `https://wa.me/${formattedHp}?text=${encodeURIComponent(msg)}`;
        }
    }
}
</script>
@endpush
