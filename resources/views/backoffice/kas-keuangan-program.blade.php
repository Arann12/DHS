@extends('backoffice.layouts.app')

@section('title', 'Keuangan Program')
@section('page-title', 'Keuangan Program')

@push('styles')
<style>
    .kas-cat-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 18px 20px;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        background: #ffffff;
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .kas-cat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1A365D, #3b82f6);
        opacity: 0.85;
        transition: opacity 0.2s;
    }
    .kas-cat-card:hover {
        transform: translateY(-3px);
        border-color: #93c5fd;
        box-shadow: 0 12px 28px rgba(26, 54, 93, 0.09);
    }
    .kas-cat-card:hover .kas-cat-arrow {
        transform: translateX(4px);
        color: #1d4ed8;
    }
    .kas-cat-arrow {
        transition: transform 0.2s ease, color 0.2s ease;
    }
    .kas-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .kas-input-icon {
        position: absolute;
        left: 13px;
        font-size: 18px !important;
        color: #94a3b8;
        pointer-events: none;
    }
    .kas-input-with-icon {
        padding-left: 40px !important;
    }
</style>
@endpush

@section('content')
<div x-data="kasKeuanganProgramPage()">

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="bo-card" style="border-left:4px solid #22c55e;margin-bottom:1.15rem;padding:.9rem 1.25rem;color:#166534;background:#f0fdf4;display:flex;align-items:center;gap:10px;font-weight:600;border-radius:12px;">
        <span class="material-icons-round" style="font-size:21px;color:#16a34a;">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Top Bar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:1.35rem;">
        <div style="font-size:13.5px;color:#64748b;">
            Pilih kategori program akademi Denpasar Hotel School yang diinginkan untuk mengelola keuangan program, atau tambah kategori program baru.
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="/backoffice/kas" class="btn-secondary" style="font-size:13px;padding:8px 14px;">
                <span class="material-icons-round" style="font-size:17px;">arrow_back</span>
                Keuangan Umum
            </a>
            <a href="/backoffice/program-kategori" class="btn-primary" style="font-size:13px;padding:9px 18px;box-shadow:0 4px 14px rgba(26,54,93,0.2);">
                <span class="material-icons-round" style="font-size:18px;">account_tree</span>
                Kelola Kategori &amp; Program
            </a>
        </div>
    </div>

    {{-- Kategori Program Akademi DHS --}}
    <div class="bo-card" style="padding:22px 24px;border:1px solid #e2e8f0;border-radius:18px;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid #f1f5f9;">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:40px;height:40px;border-radius:11px;background:linear-gradient(135deg,#eff6ff,#dbeafe);color:#1d4ed8;display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:21px;">school</span>
                </div>
                <div>
                    <h3 style="margin:0;font-size:16px;font-weight:800;color:#0f172a;font-family:'Inter',sans-serif;">Kategori Program Akademi DHS</h3>
                    <div style="font-size:12.5px;color:#64748b;">Klik kategori di bawah untuk membuka halaman transaksi &amp; input khusus program dalam kategori tersebut</div>
                </div>
            </div>
            <button type="button" class="btn-secondary" style="font-size:12.5px;padding:8px 14px;" x-on:click="openModal('program')">
                <span class="material-icons-round" style="font-size:16px;">playlist_add</span>
                Tambah Program ke Kategori
            </button>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:16px;">
            @foreach($programKategori as $kat)
                <a href="/backoffice/kas-kategori-kas/{{ $kat->id }}" class="kas-cat-card">
                    <div>
                        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:8px;margin-bottom:6px;padding-top:4px;">
                            <div style="display:flex;align-items:center;gap:8px;min-width:0;">
                                <span style="width:32px;height:32px;border-radius:9px;background:#f1f5f9;color:#1A365D;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <span class="material-icons-round" style="font-size:17px;">folder_special</span>
                                </span>
                                <span style="font-size:15px;font-weight:800;color:#0f172a;line-height:1.3;">{{ $kat->category_name }}</span>
                            </div>
                            <div style="display:flex;align-items:center;gap:4px;flex-shrink:0;">
                                @if(!$kat->is_active)
                                    <span style="font-size:10px;font-weight:700;padding:3px 7px;border-radius:99px;background:#fef3c7;color:#b45309;">Keuangan</span>
                                @endif
                                <span style="font-size:11px;font-weight:700;padding:3px 9px;border-radius:99px;background:#eff6ff;color:#1d4ed8;">
                                    {{ $kat->programs->count() }} Program
                                </span>
                            </div>
                        </div>
                        @if($kat->subtitle)
                            <div style="font-size:11.5px;color:#64748b;margin-bottom:10px;padding-left:40px;">{{ $kat->subtitle }}</div>
                        @else
                            <div style="height:6px;"></div>
                        @endif
                        <div style="display:flex;flex-wrap:wrap;gap:6px;">
                            @foreach($kat->programs as $prog)
                                <span style="font-size:11.5px;padding:4px 9px;border-radius:7px;background:#f8fafc;border:1px solid #e2e8f0;color:#334155;font-weight:500;">
                                    {{ $prog->title }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div style="margin-top:14px;padding-top:11px;border-top:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;color:#1A365D;font-size:12.5px;font-weight:700;">
                        <span>Buka Halaman Kategori</span>
                        <span class="material-icons-round kas-cat-arrow" style="font-size:17px;">arrow_forward</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Modal Tambah Kategori Program Akademi DHS / Tambah Program ke Kategori --}}
    <div class="bo-modal-backdrop"
         x-show="modalOpen"
         x-transition
         style="display:none;z-index:1150;backdrop-filter:blur(4px);background:rgba(15,23,42,0.55);"
         x-on:click.self="modalOpen = false"
         x-on:keydown.escape.window="modalOpen = false">
        <div class="bo-modal"
             style="max-width:560px;width:95%;padding:0;border-radius:20px;overflow:hidden;box-shadow:0 24px 60px rgba(15,23,42,0.28);"
             x-on:click.stop>

            {{-- Gradient Header --}}
            <div style="background:linear-gradient(135deg,#0F2440 0%,#1A365D 65%,#254b82 100%);padding:22px 26px;color:#fff;position:relative;">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,0.14);border:1px solid rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-icons-round" style="font-size:23px;color:#fff;" x-text="modalTab === 'kategori' ? 'create_new_folder' : 'playlist_add'"></span>
                        </div>
                        <div>
                            <h3 style="margin:0;font-size:1.15rem;font-weight:800;color:#fff;font-family:'Inter',sans-serif;"
                                x-text="modalTab === 'kategori' ? 'Tambah Kategori Program Akademi' : 'Tambah Program ke Kategori'"></h3>
                            <div style="font-size:12px;color:rgba(255,255,255,0.78);margin-top:3px;"
                                 x-text="modalTab === 'kategori' ? 'Buat kategori baru untuk mengelompokkan program & transaksi kas DHS' : 'Tambahkan jurusan atau program baru ke dalam kategori yang sudah ada'"></div>
                        </div>
                    </div>
                    <button type="button"
                            x-on:click="modalOpen = false"
                            style="width:32px;height:32px;border-radius:9px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.18);color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <span class="material-icons-round" style="font-size:18px;">close</span>
                    </button>
                </div>
            </div>

            {{-- Body --}}
            <div style="padding:22px 26px 24px;background:#fff;">

                {{-- Segmented Mode Switcher --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;background:#f1f5f9;padding:4px;border-radius:12px;gap:4px;margin-bottom:20px;border:1px solid #e2e8f0;">
                    <button type="button" x-on:click="modalTab = 'kategori'"
                            style="border:none;padding:9px 12px;border-radius:9px;font-size:12.5px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .15s;"
                            :style="modalTab === 'kategori' ? 'background:#ffffff;color:#0f172a;box-shadow:0 2px 8px rgba(15,23,42,0.08);' : 'background:transparent;color:#64748b;'">
                        <span class="material-icons-round" style="font-size:16px;" :style="modalTab === 'kategori' ? 'color:#1d4ed8;' : ''">category</span>
                        <span>Kategori Baru</span>
                    </button>
                    <button type="button" x-on:click="modalTab = 'program'"
                            style="border:none;padding:9px 12px;border-radius:9px;font-size:12.5px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .15s;"
                            :style="modalTab === 'program' ? 'background:#ffffff;color:#0f172a;box-shadow:0 2px 8px rgba(15,23,42,0.08);' : 'background:transparent;color:#64748b;'">
                        <span class="material-icons-round" style="font-size:16px;" :style="modalTab === 'program' ? 'color:#1d4ed8;' : ''">playlist_add</span>
                        <span>Program di Kategori Ada</span>
                    </button>
                </div>

                {{-- Form 1: Tambah Kategori Program Akademi Baru --}}
                <form x-show="modalTab === 'kategori'" method="POST" action="/backoffice/kas-kategori-program/store">
                    @csrf
                    <div style="display:flex;flex-direction:column;gap:15px;">

                        <div>
                            <label class="bo-label" style="font-size:12.5px;font-weight:700;color:#1e293b;">
                                Nama Kategori Program <span style="color:#dc2626">*</span>
                            </label>
                            <div class="kas-input-wrap">
                                <span class="material-icons-round kas-input-icon">folder_special</span>
                                <input type="text"
                                       class="bo-input kas-input-with-icon"
                                       name="category_name"
                                       x-model="catForm.category_name"
                                       placeholder="Misal: Program Sertifikasi Profesi / Kursus Barista"
                                       maxlength="255"
                                       style="border-radius:11px;background:#f8fafc;"
                                       :required="modalTab === 'kategori'">
                            </div>
                        </div>

                        <div>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;">
                                <label class="bo-label" style="margin-bottom:0;font-size:12.5px;font-weight:700;color:#1e293b;">Nama Program Awal</label>
                                <span style="font-size:11px;font-weight:600;color:#64748b;background:#f1f5f9;padding:2px 8px;border-radius:99px;">Opsional</span>
                            </div>
                            <div class="kas-input-wrap">
                                <span class="material-icons-round kas-input-icon">school</span>
                                <input type="text"
                                       class="bo-input kas-input-with-icon"
                                       name="program_title"
                                       x-model="catForm.program_title"
                                       placeholder="Kosongkan jika sama dengan nama kategori"
                                       maxlength="255"
                                       style="border-radius:11px;background:#f8fafc;">
                            </div>
                            <div style="font-size:11px;color:#64748b;margin-top:5px;">
                                Dibuatkan otomatis agar kategori baru langsung siap dipilih saat input transaksi pemasukan/pengeluaran.
                            </div>
                        </div>

                        <div>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;">
                                <label class="bo-label" style="margin-bottom:0;font-size:12.5px;font-weight:700;color:#1e293b;">Subjudul / Keterangan Singkat</label>
                                <span style="font-size:11px;font-weight:600;color:#64748b;background:#f1f5f9;padding:2px 8px;border-radius:99px;">Opsional</span>
                            </div>
                            <div class="kas-input-wrap">
                                <span class="material-icons-round kas-input-icon">short_text</span>
                                <input type="text"
                                       class="bo-input kas-input-with-icon"
                                       name="subtitle"
                                       x-model="catForm.subtitle"
                                       placeholder="Misal: Pelatihan intensif bersertifikat resmi"
                                       maxlength="255"
                                       style="border-radius:11px;background:#f8fafc;">
                            </div>
                        </div>

                        {{-- Live Mini Preview Kartu Kategori --}}
                        <div style="background:linear-gradient(135deg,#f8fafc,#eff6ff);border:1.5px dashed #bfdbfe;border-radius:12px;padding:12px 14px;">
                            <div style="font-size:10.5px;font-weight:700;letter-spacing:.05em;color:#2563eb;text-transform:uppercase;margin-bottom:6px;">
                                Pratinjau Kartu Kategori
                            </div>
                            <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
                                <span style="font-weight:800;font-size:14px;color:#0f172a;"
                                      x-text="(catForm.category_name || '').trim() || 'Nama Kategori Baru'"></span>
                                <span style="font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:99px;"
                                      :style="catForm.is_active ? 'background:#dcfce7;color:#15803d;' : 'background:#fef3c7;color:#b45309;'"
                                      x-text="catForm.is_active ? 'Publik + Keuangan' : 'Khusus Keuangan'"></span>
                            </div>
                            <div x-show="(catForm.subtitle || '').trim()" style="font-size:11.5px;color:#64748b;margin-top:2px;" x-text="catForm.subtitle"></div>
                            <div style="margin-top:7px;">
                                <span style="display:inline-block;font-size:11px;padding:3px 9px;border-radius:6px;background:#fff;border:1px solid #dbeafe;color:#1e40af;font-weight:600;"
                                      x-text="(catForm.program_title || '').trim() || (catForm.category_name || '').trim() || 'Program Awal'"></span>
                            </div>
                        </div>

                        {{-- Toggle Publik vs Khusus Keuangan --}}
                        <div x-on:click="catForm.is_active = !catForm.is_active"
                             style="display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 14px;border-radius:12px;cursor:pointer;transition:all .15s;"
                             :style="catForm.is_active ? 'background:#f0fdf4;border:1.5px solid #86efac;' : 'background:#f8fafc;border:1.5px solid #e2e8f0;'">
                            <input type="hidden" name="is_active" :value="catForm.is_active ? '1' : '0'">
                            <div>
                                <div style="font-size:12.5px;font-weight:700;color:#0f172a;">Tampilkan di Halaman Publik Website</div>
                                <div style="font-size:11px;color:#64748b;margin-top:2px;"
                                     x-text="catForm.is_active ? 'Kategori ikut tampil di halaman Academy & Formulir Pendaftaran.' : 'Hanya muncul di Manajemen Keuangan backoffice (direkomendasikan).'"></div>
                            </div>
                            <div style="width:42px;height:24px;border-radius:99px;padding:2px;transition:background .2s;flex-shrink:0;display:flex;align-items:center;"
                                 :style="catForm.is_active ? 'background:#16a34a;' : 'background:#cbd5e1;'">
                                <div style="width:20px;height:20px;border-radius:50%;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.2);transition:transform .2s;"
                                     :style="catForm.is_active ? 'transform:translateX(18px);' : 'transform:translateX(0);'"></div>
                            </div>
                        </div>

                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;">
                        <button type="button" class="btn-secondary" style="border-radius:10px;padding:9px 18px;" x-on:click="modalOpen = false">Batal</button>
                        <button type="submit" class="btn-primary" style="border-radius:10px;padding:9px 20px;box-shadow:0 4px 12px rgba(26,54,93,0.22);">
                            <span class="material-icons-round" style="font-size:18px;">save</span>
                            Simpan Kategori Program
                        </button>
                    </div>
                </form>

                {{-- Form 2: Tambah Sub-Program ke Kategori yang Sudah Ada --}}
                <form x-show="modalTab === 'program'" style="display:none;" method="POST" action="/backoffice/kas-program-item/store">
                    @csrf
                    <input type="hidden" name="redirect_to" value="/backoffice/kas-keuangan-program">
                    <div style="display:flex;flex-direction:column;gap:15px;">

                        <div>
                            <label class="bo-label" style="font-size:12.5px;font-weight:700;color:#1e293b;">
                                Pilih Kategori Program <span style="color:#dc2626">*</span>
                            </label>
                            <div class="kas-input-wrap">
                                <span class="material-icons-round kas-input-icon">folder_open</span>
                                <select class="bo-select kas-input-with-icon"
                                        name="category_id"
                                        x-model="progForm.category_id"
                                        style="border-radius:11px;background:#f8fafc;"
                                        :required="modalTab === 'program'">
                                    <option value="">-- Pilih Kategori Program --</option>
                                    @foreach($programKategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="bo-label" style="font-size:12.5px;font-weight:700;color:#1e293b;">
                                Nama Program Baru <span style="color:#dc2626">*</span>
                            </label>
                            <div class="kas-input-wrap">
                                <span class="material-icons-round kas-input-icon">school</span>
                                <input type="text"
                                       class="bo-input kas-input-with-icon"
                                       name="title"
                                       x-model="progForm.title"
                                       placeholder="Misal: Pastry & Bakery — 1 Tahun"
                                       maxlength="255"
                                       style="border-radius:11px;background:#f8fafc;"
                                       :required="modalTab === 'program'">
                            </div>
                        </div>

                        <div>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;">
                                <label class="bo-label" style="margin-bottom:0;font-size:12.5px;font-weight:700;color:#1e293b;">Durasi Program</label>
                                <span style="font-size:11px;font-weight:600;color:#64748b;background:#f1f5f9;padding:2px 8px;border-radius:99px;">Opsional</span>
                            </div>
                            <div class="kas-input-wrap">
                                <span class="material-icons-round kas-input-icon">schedule</span>
                                <input type="text"
                                       class="bo-input kas-input-with-icon"
                                       name="duration"
                                       x-model="progForm.duration"
                                       placeholder="Misal: 1 Tahun / 6 Bulan"
                                       maxlength="100"
                                       style="border-radius:11px;background:#f8fafc;">
                            </div>
                        </div>

                        {{-- Toggle Publik vs Khusus Keuangan --}}
                        <div x-on:click="progForm.is_active = !progForm.is_active"
                             style="display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 14px;border-radius:12px;cursor:pointer;transition:all .15s;"
                             :style="progForm.is_active ? 'background:#f0fdf4;border:1.5px solid #86efac;' : 'background:#f8fafc;border:1.5px solid #e2e8f0;'">
                            <input type="hidden" name="is_active" :value="progForm.is_active ? '1' : '0'">
                            <div>
                                <div style="font-size:12.5px;font-weight:700;color:#0f172a;">Tampilkan di Halaman Publik Website</div>
                                <div style="font-size:11px;color:#64748b;margin-top:2px;"
                                     x-text="progForm.is_active ? 'Program ikut tampil di halaman Academy & Formulir Pendaftaran.' : 'Hanya muncul di Manajemen Keuangan backoffice (direkomendasikan).'"></div>
                            </div>
                            <div style="width:42px;height:24px;border-radius:99px;padding:2px;transition:background .2s;flex-shrink:0;display:flex;align-items:center;"
                                 :style="progForm.is_active ? 'background:#16a34a;' : 'background:#cbd5e1;'">
                                <div style="width:20px;height:20px;border-radius:50%;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.2);transition:transform .2s;"
                                     :style="progForm.is_active ? 'transform:translateX(18px);' : 'transform:translateX(0);'"></div>
                            </div>
                        </div>

                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;">
                        <button type="button" class="btn-secondary" style="border-radius:10px;padding:9px 18px;" x-on:click="modalOpen = false">Batal</button>
                        <button type="submit" class="btn-primary" style="border-radius:10px;padding:9px 20px;box-shadow:0 4px 12px rgba(26,54,93,0.22);">
                            <span class="material-icons-round" style="font-size:18px;">save</span>
                            Simpan Program
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function kasKeuanganProgramPage() {
    return {
        modalOpen: false,
        modalTab: 'kategori',
        catForm: {
            category_name: '',
            program_title: '',
            subtitle: '',
            is_active: false,
        },
        progForm: {
            category_id: '',
            title: '',
            duration: '',
            is_active: false,
        },
        openModal(tab) {
            this.modalTab = tab || 'kategori';
            this.catForm = {
                category_name: '',
                program_title: '',
                subtitle: '',
                is_active: false,
            };
            this.progForm = {
                category_id: '',
                title: '',
                duration: '',
                is_active: false,
            };
            this.modalOpen = true;
        }
    };
}
</script>
@endpush
