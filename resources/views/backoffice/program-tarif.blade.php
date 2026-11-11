@extends('backoffice.layouts.app')

@section('title', 'Atur Harga & Tarif Program — Academy DHS')
@section('page-title', 'Atur Harga & Tarif Program')

@push('styles')
<style>
    .tarif-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 2px 10px rgba(15,23,42,0.03);
        margin-bottom: 20px;
    }
    .tarif-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
        max-width: 240px;
    }
    .tarif-input-rp {
        position: absolute;
        left: 12px;
        font-size: 13px;
        font-weight: 700;
        color: #94a3b8;
        pointer-events: none;
        user-select: none;
    }
    .tarif-input-field {
        width: 100%;
        height: 38px;
        box-sizing: border-box;
        padding: 0 12px 0 38px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: #0F2440 !important;
        border-radius: 9px !important;
        border: 1.5px solid #cbd5e1 !important;
        background: #ffffff !important;
        outline: none;
        transition: all 0.15s;
    }
    .tarif-input-field:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.12) !important;
        background: #ffffff !important;
    }
    .tarif-save-btn {
        height: 38px;
        padding: 0 14px;
        border-radius: 9px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1.5px solid transparent;
        transition: all 0.15s;
    }
</style>
@endpush

@section('content')
<div x-data="programTarifManager()">

    {{-- Flash Success --}}
    @if(session('success'))
    <div style="background:#f0fdf4;border-left:4px solid #16a34a;border-radius:12px;padding:14px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#166534;font-weight:600;font-size:13.5px;">
        <span class="material-icons-round" style="color:#16a34a;font-size:22px;">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Header Banner & Navigasi Cepat --}}
    <div class="tarif-card" style="background:linear-gradient(135deg, #0F2440 0%, #1A365D 70%, #20457a 100%);color:#fff;border:none;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div style="max-width:680px;">
                <div style="display:inline-flex;align-items:center;gap:6px;padding:4px 10px;border-radius:99px;background:rgba(255,255,255,0.15);font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;margin-bottom:10px;">
                    <span class="material-icons-round" style="font-size:14px;">payments</span>
                    <span>Pengaturan Tarif Resmi Akademi DHS</span>
                </div>
                <h1 style="font-family:'Playfair Display',serif;font-size:22px;font-weight:700;margin:0 0 6px;color:#fff;">
                    Atur Biaya &amp; Tarif Setiap Program
                </h1>
                <p style="font-size:13px;color:rgba(255,255,255,0.85);margin:0;line-height:1.5;">
                    Tentukan biaya pendidikan resmi untuk setiap program studi di Denpasar Hotel School. Tarif yang disimpan di halaman ini <strong>otomatis terkunci dan tampil pada formulir pendaftaran online siswa</strong> saat memilih metode <em>Bayar Lunas</em> atau <em>Bayar DP</em>.
                </p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
                <a href="/backoffice/program" class="btn-secondary" style="font-size:12.5px;padding:9px 15px;background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.2);">
                    <span class="material-icons-round" style="font-size:17px;">school</span>
                    Editor Kategori Academy
                </a>
                <a href="/formulir-pendaftaran" target="_blank" class="btn-secondary" style="font-size:12.5px;padding:9px 15px;background:#ffffff;color:#0F2440;border:none;font-weight:700;">
                    <span class="material-icons-round" style="font-size:17px;color:#2563eb;">open_in_new</span>
                    Cek Form Pendaftaran
                </a>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;margin-bottom:20px;">
        <div class="tarif-card" style="margin-bottom:0;padding:16px 20px;border-left:4px solid #2563eb;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:4px;">Total Program Akademi</div>
            <div style="font-size:22px;font-weight:800;color:#0F2440;">{{ $totalPrograms }} <span style="font-size:13px;font-weight:500;color:#64748b;">Program</span></div>
            <div style="font-size:11.5px;color:#64748b;margin-top:2px;">Terdaftar di sistem DHS</div>
        </div>
        <div class="tarif-card" style="margin-bottom:0;padding:16px 20px;border-left:4px solid #16a34a;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:4px;">Sudah Memiliki Tarif</div>
            <div style="font-size:22px;font-weight:800;color:#16a34a;">{{ $pricedCount }} <span style="font-size:13px;font-weight:500;color:#64748b;">Program</span></div>
            <div style="font-size:11.5px;color:#15803d;margin-top:2px;">Tarif otomatis terkunci di formulir</div>
        </div>
        <div class="tarif-card" style="margin-bottom:0;padding:16px 20px;border-left:4px solid #f59e0b;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:4px;">Belum Diatur Tarif</div>
            <div style="font-size:22px;font-weight:800;color:#b45309;">{{ $unpricedCount }} <span style="font-size:13px;font-weight:500;color:#64748b;">Program</span></div>
            <div style="font-size:11.5px;color:#92400e;margin-top:2px;">Perlu diisi agar pendaftar tidak input manual</div>
        </div>
    </div>

    {{-- Filter & Action Bar --}}
    <div class="tarif-card" style="padding:16px 20px;margin-bottom:18px;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;flex:1;">
                {{-- Search --}}
                <div style="position:relative;min-width:240px;flex:1;max-width:340px;">
                    <span class="material-icons-round" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:18px;pointer-events:none;">search</span>
                    <input type="text"
                           x-model="searchQuery"
                           placeholder="Cari nama program..."
                           class="bo-input"
                           style="height:40px;box-sizing:border-box;padding-left:38px;padding-right:12px;font-size:13px;border-radius:10px;">
                </div>

                {{-- Filter Kategori --}}
                <div style="min-width:200px;">
                    <select class="bo-select" x-model="selectedCategory" style="height:40px;box-sizing:border-box;padding:0 12px;font-size:13px;border-radius:10px;">
                        <option value="">Semua Kategori ({{ $categories->count() }})</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <button type="button"
                        class="btn-primary"
                        x-on:click="submitAllFees()"
                        style="height:40px;padding:0 18px;font-size:13px;box-shadow:0 3px 12px rgba(26,54,93,0.2);">
                    <span class="material-icons-round" style="font-size:18px;">save</span>
                    <span>Simpan Semua Tarif</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Form Simpan Semua Tarif --}}
    <form id="form-update-all-tarif" method="POST" action="/backoffice/program-tarif/update-all">
        @csrf

        {{-- Daftar Program per Kategori --}}
        @foreach($categories as $cat)
        <div class="tarif-card"
             style="padding:0;overflow:hidden;"
             x-show="matchesCategory('{{ $cat->id }}')"
             x-transition>

            {{-- Header Kategori --}}
            <div style="background:#f8fafc;padding:14px 20px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="width:32px;height:32px;border-radius:8px;background:#e2e8f0;color:#1A365D;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;">
                        <span class="material-icons-round" style="font-size:18px;">folder</span>
                    </span>
                    <div>
                        <h3 style="margin:0;font-size:15px;font-weight:800;color:#0F2440;">{{ $cat->category_name }}</h3>
                        <div style="font-size:11.5px;color:#64748b;">{{ $cat->programs->count() }} program terdaftar</div>
                    </div>
                </div>

                <div>
                    <a href="/backoffice/program" style="font-size:12px;color:#2563eb;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:3px;">
                        <span>Edit Kategori</span>
                        <span class="material-icons-round" style="font-size:14px;">arrow_forward</span>
                    </a>
                </div>
            </div>

            {{-- Tabel Program dalam Kategori --}}
            <div style="overflow-x:auto;">
                <table class="bo-table" style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th style="width:45px;text-align:center;">#</th>
                            <th>Nama Program Studi</th>
                            <th style="white-space:nowrap;">Durasi</th>
                            <th style="text-align:center;white-space:nowrap;">Status Form</th>
                            <th style="min-width:240px;">Tarif Biaya Pendidikan (Rp)</th>
                            <th style="text-align:center;width:120px;">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cat->programs as $prog)
                        <tr x-show="matchesSearch('{{ strtolower(addslashes($prog->title)) }}')" x-transition>
                            <td style="text-align:center;color:#94a3b8;font-size:12px;font-weight:700;">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    @if($prog->thumbnail_url)
                                        <img src="{{ $prog->thumbnail_url }}" alt="" style="width:38px;height:38px;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;flex-shrink:0;">
                                    @else
                                        <div style="width:38px;height:38px;border-radius:8px;background:#f1f5f9;color:#94a3b8;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <span class="material-icons-round" style="font-size:20px;">school</span>
                                        </div>
                                    @endif
                                    <div>
                                        <div style="font-weight:700;color:#0F2440;font-size:13.5px;">{{ $prog->title }}</div>
                                        @if($prog->country_badge)
                                            <span style="font-size:10.5px;font-weight:700;padding:2px 7px;border-radius:6px;background:#eff6ff;color:#1d4ed8;display:inline-block;margin-top:2px;">
                                                {{ $prog->country_badge }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="white-space:nowrap;font-size:12.5px;color:#475569;">
                                {{ $prog->duration ?: '—' }}
                            </td>
                            <td style="text-align:center;white-space:nowrap;">
                                @if($prog->is_active)
                                    <span class="badge badge-green" style="font-size:11px;">Aktif</span>
                                @else
                                    <span class="badge badge-gray" style="font-size:11px;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="tarif-input-wrap">
                                    <span class="tarif-input-rp">Rp</span>
                                    <input type="text"
                                           name="fees[{{ $prog->id }}]"
                                           id="fee-input-{{ $prog->id }}"
                                           value="{{ $prog->tuition_fee ? number_format($prog->tuition_fee, 0, ',', '.') : '' }}"
                                           placeholder="Belum ada tarif"
                                           inputmode="numeric"
                                           oninput="formatRupiahInput(this)"
                                           class="tarif-input-field">
                                </div>
                                <div id="fee-status-{{ $prog->id }}" style="font-size:11px;color:#64748b;margin-top:3px;">
                                    @if($prog->tuition_fee)
                                        <span style="color:#16a34a;font-weight:600;">✓ Tarif aktif: Rp {{ number_format($prog->tuition_fee, 0, ',', '.') }}</span>
                                    @else
                                        <span style="color:#94a3b8;">Kosongkan jika gratis / belum ditentukan</span>
                                    @endif
                                </div>
                            </td>
                            <td style="text-align:center;white-space:nowrap;">
                                <button type="button"
                                        x-on:click="saveSingleFee({{ $prog->id }})"
                                        class="tarif-save-btn btn-secondary"
                                        title="Simpan tarif program ini">
                                    <span class="material-icons-round" style="font-size:16px;color:#2563eb;">save</span>
                                    <span>Simpan</span>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:24px;color:#94a3b8;font-size:13px;">
                                Belum ada program dalam kategori ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
        @endforeach

        {{-- Sticky Footer Bar Simpan Semua --}}
        <div style="position:sticky;bottom:16px;z-index:40;background:#ffffff;border:1.5px solid #0F2440;border-radius:14px;padding:14px 22px;box-shadow:0 8px 28px rgba(15,23,42,0.18);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <div style="display:flex;align-items:center;gap:10px;">
                <span class="material-icons-round" style="color:#2563eb;font-size:22px;">info</span>
                <span style="font-size:13px;font-weight:600;color:#0F2440;">
                    Setelah mengubah nominal tarif, klik <strong>Simpan Semua Perubahan</strong> agar seluruh tarif langsung tersinkron ke web.
                </span>
            </div>
            <button type="submit"
                    class="btn-primary"
                    style="font-size:13.5px;padding:9px 24px;box-shadow:0 4px 14px rgba(26,54,93,0.25);">
                <span class="material-icons-round" style="font-size:18px;">save</span>
                <span>Simpan Semua Perubahan</span>
            </button>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
function formatRupiahInput(el) {
    const raw = el.value.replace(/\D/g, '');
    el.value = raw ? parseInt(raw, 10).toLocaleString('id-ID') : '';
}

function programTarifManager() {
    return {
        searchQuery: '',
        selectedCategory: '',

        matchesCategory(catId) {
            if (!this.selectedCategory) return true;
            return String(this.selectedCategory) === String(catId);
        },

        matchesSearch(titleLower) {
            if (!this.searchQuery || this.searchQuery.trim() === '') return true;
            const q = this.searchQuery.toLowerCase().trim();
            return titleLower.includes(q);
        },

        submitAllFees() {
            document.getElementById('form-update-all-tarif').submit();
        },

        async saveSingleFee(progId) {
            const input = document.getElementById('fee-input-' + progId);
            const statusEl = document.getElementById('fee-status-' + progId);
            if (!input) return;

            const val = input.value;
            if (statusEl) {
                statusEl.innerHTML = '<span style="color:#2563eb;">Menyimpan...</span>';
            }

            try {
                const res = await fetch('/backoffice/program-tarif/update-single', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        program_id: progId,
                        tuition_fee: val
                    })
                });

                const json = await res.json();
                if (json.success) {
                    if (statusEl) {
                        if (json.tuition_fee) {
                            statusEl.innerHTML = '<span style="color:#16a34a;font-weight:600;">✓ Tersimpan: ' + json.fee_display + '</span>';
                        } else {
                            statusEl.innerHTML = '<span style="color:#64748b;">✓ Tarif dikosongkan</span>';
                        }
                    }
                } else {
                    if (statusEl) statusEl.innerHTML = '<span style="color:#dc2626;">Gagal menyimpan</span>';
                }
            } catch (e) {
                if (statusEl) statusEl.innerHTML = '<span style="color:#dc2626;">Error: gagal koneksi</span>';
            }
        }
    };
}
</script>
@endpush

