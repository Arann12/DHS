@php
    $scope              = $scope ?? 'modal.form';
    $actionExpr         = $actionExpr ?? "'/backoffice/kas/store'";
    $programScopeMode   = $programScopeMode ?? 'umum'; // 'umum' | 'kategori' | 'locked'
    $lockedProgramRef   = $lockedProgramRef ?? '';
    $lockedProgramLabel = $lockedProgramLabel ?? '';
    $scopedPrograms     = $scopedPrograms ?? collect();
    $scopedCategoryName = $scopedCategoryName ?? '';
    $redirectValue      = $redirectValue ?? '';
    $submitText         = $submitText ?? 'Simpan Transaksi';
    $showCancel         = $showCancel ?? false;
    $cancelAction       = $cancelAction ?? 'modal.open = false';
    $btnBg              = $btnBg ?? '#1A365D';
    $catUmumMasuk       = $optUmumMasuk ?? ($optMasuk ?? []);
    $catUmumKeluar      = $optUmumKeluar ?? ($optKeluar ?? []);
    $catProgMasuk       = $optProgramMasuk ?? ($optMasuk ?? []);
    $catProgKeluar      = $optProgramKeluar ?? ($optKeluar ?? []);
@endphp

<form method="POST"
      :action="{{ $actionExpr }}"
      enctype="multipart/form-data"
      x-data="{
          unitOpen: false,
          newUnit: '',
          unitSaving: false,
          localFileName: '',
          localFilePreview: '',
          localIsPdf: false,
          get calcHarga() {
              return window.DHSKasHelper.parseRupiah({{ $scope }}.hargaSatuanDisplay);
          },
          get calcTotal() {
              const v = parseFloat({{ $scope }}.volume) || 0;
              return Math.round(v * this.calcHarga);
          },

          onFilePicked(e) {
              const file = e.target.files[0];
              if (!file) {
                  this.localFileName = '';
                  this.localFilePreview = '';
                  this.localIsPdf = false;
                  return;
              }
              this.localFileName = file.name;
              this.localIsPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');
              if (!this.localIsPdf && file.type.startsWith('image/')) {
                  const reader = new FileReader();
                  reader.onload = ev => { this.localFilePreview = ev.target.result; };
                  reader.readAsDataURL(file);
              } else {
                  this.localFilePreview = '';
              }
          },
          clearPickedFile() {
              if (this.$refs.fileInput) this.$refs.fileInput.value = '';
              this.localFileName = '';
              this.localFilePreview = '';
              this.localIsPdf = false;
              {{ $scope }}.bukti_gambar = '';
          },
          async submitNewUnit() {
              const clean = (this.newUnit || '').trim();
              if (!clean || this.unitSaving) return;
              this.unitSaving = true;
              const res = await window.DHSKasHelper.addUnit(clean, '{{ csrf_token() }}');
              this.unitSaving = false;
              if (res && res.units) {
                  unitsList = res.units;
              } else if (!unitsList.includes(clean)) {
                  unitsList.push(clean);
              }
              {{ $scope }}.satuan = clean;
              this.newUnit = '';
              this.unitOpen = false;
          },
          validateBeforeSubmit(e) {
              @if($programScopeMode === 'kategori')
                  if (!{{ $scope }}.program_ref) {
                      e.preventDefault();
                      alert('Silakan pilih Program di kategori {{ $scopedCategoryName }} terlebih dahulu.');
                      return;
                  }
              @endif
              if (!{{ $scope }}.type) {
                  e.preventDefault();
                  alert('Silakan pilih Jenis Transaksi (Pemasukan / Pengeluaran).');
                  return;
              }
              if (!{{ $scope }}.jenis) {
                  e.preventDefault();
                  alert('Silakan pilih Kategori transaksi.');
                  return;
              }
              if (this.calcTotal <= 0) {
                  e.preventDefault();
                  alert('Harga Satuan dan Volume harus menghasilkan Total lebih dari 0.');
                  return;
              }
          }
      }"
      x-on:submit="validateBeforeSubmit($event)">
    @csrf
    <input type="hidden" name="harga_satuan" :value="calcHarga">
    <input type="hidden" name="jumlah" :value="calcTotal">
    <input type="hidden" name="satuan" :value="{{ $scope }}.satuan || 'Paket'">
    <input type="hidden" name="bukti_gambar" :value="{{ $scope }}.bukti_gambar || ''">
    <input type="hidden" name="payment_mode" value="lunas">
    <input type="hidden" name="is_piutang" value="0">
    <input type="hidden" name="redirect_to" value="{{ $redirectValue }}">

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">

        {{-- 1. Ruang Lingkup Program / Umum --}}
        @if($programScopeMode === 'umum')
            {{-- Mode KEUANGAN UMUM: Tambah transaksi hanya untuk Umum; Edit mempertahankan scope aslinya --}}
            <div style="grid-column:1/-1;">
                <label class="bo-label">Jenis Kas / Ruang Lingkup</label>
                <div x-show="!{{ $scope }}.program_ref">
                    <input type="hidden" :name="!{{ $scope }}.program_ref ? 'program_ref' : ''" value="">
                    <div style="padding:10px 14px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:10px;display:flex;align-items:center;justify-content:space-between;gap:8px;">
                        <span style="font-weight:700;font-size:13.5px;color:#0f172a;display:flex;align-items:center;gap:6px;">
                            <span class="material-icons-round" style="font-size:18px;color:#0284c7;">domain</span>
                            Umum / Operasional Kampus (Non-Program)
                        </span>
                        <span style="font-size:11px;font-weight:600;padding:2px 8px;border-radius:99px;background:#e0f2fe;color:#0369a1;">Khusus Umum</span>
                    </div>
                    <div style="font-size:11px;color:#64748b;margin-top:4px;">
                        Input di Keuangan Umum khusus untuk kebutuhan umum (listrik, air, internet, ATK, perawatan gedung, dll). Transaksi program diinput di menu <a href="/backoffice/kas-keuangan-program" style="color:#1d4ed8;">Keuangan Program</a>.
                    </div>
                </div>
                <div x-show="!!{{ $scope }}.program_ref" style="display:none;">
                    <input type="hidden" :name="!!{{ $scope }}.program_ref ? 'program_ref' : ''" :value="{{ $scope }}.program_ref">
                    <div style="padding:10px 14px;background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;display:flex;align-items:center;justify-content:space-between;gap:8px;">
                        <span style="font-weight:700;font-size:13.5px;color:#1e3a8a;display:flex;align-items:center;gap:6px;">
                            <span class="material-icons-round" style="font-size:18px;color:#2563eb;">school</span>
                            <span x-text="{{ $scope }}.programLabel || 'Transaksi Program'"></span>
                        </span>
                        <span style="font-size:11px;font-weight:600;padding:2px 8px;border-radius:99px;background:#dbeafe;color:#1d4ed8;">Program Terpilih</span>
                    </div>
                </div>
            </div>
        @elseif($programScopeMode === 'kategori')
            {{-- Mode KEUANGAN PER KATEGORI PROGRAM: Hanya bisa memilih program yang ada di kategori terpilih --}}
            <div style="grid-column:1/-1;">
                <label class="bo-label">Pilih Program ({{ $scopedCategoryName }}) <span style="color:#dc2626">*</span></label>
                <select class="bo-select" name="program_ref" x-model="{{ $scope }}.program_ref" required>
                    <option value="">-- Pilih Program di {{ $scopedCategoryName }} --</option>
                    @foreach($scopedPrograms as $prog)
                        <option value="prog:{{ $prog->id }}">{{ $prog->title }}</option>
                    @endforeach
                </select>
                <div style="font-size:11px;color:#64748b;margin-top:4px;">
                    Hanya menampilkan daftar program yang termasuk dalam kategori <strong>{{ $scopedCategoryName }}</strong>.
                </div>
            </div>
        @elseif($programScopeMode === 'locked')
            {{-- Mode DETAIL PROGRAM TERPILIH: Terkunci pada program yang sedang dibuka --}}
            <div style="grid-column:1/-1;">
                <label class="bo-label">Program Terpilih</label>
                <input type="hidden" name="program_ref" value="{{ $lockedProgramRef }}">
                <div style="padding:10px 14px;background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;display:flex;align-items:center;justify-content:space-between;gap:8px;">
                    <span style="font-weight:700;font-size:13.5px;color:#1e3a8a;display:flex;align-items:center;gap:6px;">
                        <span class="material-icons-round" style="font-size:18px;color:#2563eb;">school</span>
                        {{ $lockedProgramLabel }}
                    </span>
                    <span style="font-size:11px;font-weight:600;padding:2px 8px;border-radius:99px;background:#dbeafe;color:#1d4ed8;">Khusus Program Ini</span>
                </div>
            </div>
        @endif

        {{-- 2. Tanggal Transaksi --}}
        <div>
            <label class="bo-label">Tanggal Transaksi <span style="color:#dc2626">*</span></label>
            <input type="date" class="bo-input" name="tanggal" x-model="{{ $scope }}.tanggal" required>
        </div>

        {{-- 3. Jenis Transaksi (Dropdown Pemasukan / Pengeluaran) --}}
        <div>
            <label class="bo-label">Jenis Transaksi <span style="color:#dc2626">*</span></label>
            <select class="bo-select" name="type" x-model="{{ $scope }}.type"
                    x-on:change="{{ $scope }}.jenis = ''">
                <option value="">-- Pilih Jenis Transaksi --</option>
                <option value="masuk">Pemasukan (Uang Masuk)</option>
                <option value="keluar">Pengeluaran (Uang Keluar)</option>
            </select>
        </div>

        {{-- 4. Kategori (Jenis Kas DHS sesuai Pemasukan / Pengeluaran & Umum / Program) --}}
        <div style="grid-column:1/-1;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;">
                <label class="bo-label" style="margin-bottom:0;">Kategori <span style="color:#dc2626">*</span></label>
                <a href="/backoffice/kas-kategori" target="_blank" style="font-size:11.5px;color:#1d4ed8;text-decoration:none;display:inline-flex;align-items:center;gap:3px;">
                    <span class="material-icons-round" style="font-size:14px;">settings</span>
                    Kelola Kategori Kas
                </a>
            </div>

            {{-- Belum pilih jenis transaksi --}}
            <div x-show="!{{ $scope }}.type">
                <select class="bo-select" disabled style="background:#f8fafc;color:#94a3b8;">
                    <option value="">-- Pilih Jenis Transaksi terlebih dahulu --</option>
                </select>
            </div>

            @if($programScopeMode === 'umum')
                {{-- Kategori Pemasukan Umum --}}
                <div x-show="{{ $scope }}.type === 'masuk' && !{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'masuk' && !{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'masuk' || !!{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Pemasukan Umum --</option>
                        @foreach($catUmumMasuk as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Pengeluaran Umum --}}
                <div x-show="{{ $scope }}.type === 'keluar' && !{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'keluar' && !{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'keluar' || !!{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Pengeluaran Umum --</option>
                        @foreach($catUmumKeluar as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Pemasukan Program (hanya aktif saat edit transaksi program) --}}
                <div x-show="{{ $scope }}.type === 'masuk' && !!{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'masuk' && !!{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'masuk' || !{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Pemasukan Program --</option>
                        @foreach($catProgMasuk as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Pengeluaran Program (hanya aktif saat edit transaksi program) --}}
                <div x-show="{{ $scope }}.type === 'keluar' && !!{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'keluar' && !!{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'keluar' || !{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Pengeluaran Program --</option>
                        @foreach($catProgKeluar as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                {{-- Kategori Pemasukan Program --}}
                <div x-show="{{ $scope }}.type === 'masuk'" style="display:none;">
                    <select class="bo-select" :name="{{ $scope }}.type === 'masuk' ? 'jenis' : ''" x-model="{{ $scope }}.jenis" :disabled="{{ $scope }}.type !== 'masuk'">
                        <option value="">-- Pilih Kategori Pemasukan Program --</option>
                        @foreach($catProgMasuk as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Pengeluaran Program --}}
                <div x-show="{{ $scope }}.type === 'keluar'" style="display:none;">
                    <select class="bo-select" :name="{{ $scope }}.type === 'keluar' ? 'jenis' : ''" x-model="{{ $scope }}.jenis" :disabled="{{ $scope }}.type !== 'keluar'">
                        <option value="">-- Pilih Kategori Pengeluaran Program --</option>
                        @foreach($catProgKeluar as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

        {{-- 5. Deskripsi / Uraian Transaksi --}}
        <div style="grid-column:1/-1;">
            <label class="bo-label">Deskripsi <span style="color:#dc2626">*</span></label>
            <input type="text" class="bo-input" name="deskripsi" x-model="{{ $scope }}.deskripsi"
                   placeholder="Uraian transaksi (misal: Pembayaran SPP Batch 12 / Honor Instruktur)" required>
        </div>

        {{-- 6. Satuan (Dropdown Dinamis Bisa Tambah Langsung) & Volume --}}
        <div style="position:relative;" x-on:click.away="unitOpen = false">
            <label class="bo-label">Satuan</label>
            <button type="button"
                    x-on:click="unitOpen = !unitOpen"
                    class="bo-input"
                    style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;text-align:left;background:#fff;">
                <span x-text="{{ $scope }}.satuan || 'Pilih Satuan'" :style="{{ $scope }}.satuan ? 'color:#0f172a;font-weight:500;' : 'color:#94a3b8;'"></span>
                <span class="material-icons-round" style="font-size:18px;color:#64748b;" x-text="unitOpen ? 'expand_less' : 'expand_more'"></span>
            </button>

            <div x-show="unitOpen" x-transition
                 style="display:none;position:absolute;top:100%;left:0;right:0;margin-top:4px;background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;box-shadow:0 12px 28px rgba(15,23,42,0.14);z-index:80;padding:8px;">
                {{-- Input Tambah Satuan Langsung --}}
                <div style="display:flex;gap:6px;margin-bottom:8px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;">
                    <input type="text"
                           x-model="newUnit"
                           x-on:keydown.enter.prevent="submitNewUnit()"
                           placeholder="Tambah satuan baru..."
                           style="flex:1;min-width:0;padding:6px 10px;font-size:12.5px;border:1px solid #cbd5e1;border-radius:7px;outline:none;">
                    <button type="button"
                            x-on:click="submitNewUnit()"
                            :disabled="!newUnit.trim() || unitSaving"
                            style="padding:6px 10px;background:#1A365D;color:#fff;border:none;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;white-space:nowrap;">
                        + Tambah
                    </button>
                </div>

                {{-- Pilihan Satuan --}}
                <div style="max-height:175px;overflow-y:auto;display:flex;flex-direction:column;gap:2px;">
                    <template x-for="u in unitsList" :key="u">
                        <button type="button"
                                x-on:click="{{ $scope }}.satuan = u; unitOpen = false"
                                style="display:flex;align-items:center;justify-content:space-between;padding:7px 10px;border:none;border-radius:6px;cursor:pointer;font-size:13px;text-align:left;"
                                :style="{{ $scope }}.satuan === u ? 'background:#eff6ff;color:#1d4ed8;font-weight:600;' : 'background:transparent;color:#334155;'">
                            <span x-text="u"></span>
                            <span class="material-icons-round" style="font-size:15px;" x-show="{{ $scope }}.satuan === u">check</span>
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <div>
            <label class="bo-label">Volume (Jumlah) <span style="color:#dc2626">*</span></label>
            <input type="number" class="bo-input" name="volume" x-model="{{ $scope }}.volume"
                   min="0.01" step="any" placeholder="1" required>
        </div>

        {{-- 7. Harga Satuan (Rp) format titik setiap 3 angka --}}
        <div style="grid-column:1/-1;">
            <label class="bo-label">Harga Satuan (Rp) <span style="color:#dc2626">*</span></label>
            <div style="position:relative;display:flex;align-items:center;">
                <span style="position:absolute;left:14px;font-weight:700;font-size:13.5px;color:#64748b;pointer-events:none;">Rp</span>
                <input type="text"
                       class="bo-input"
                       x-model="{{ $scope }}.hargaSatuanDisplay"
                       x-on:input="{{ $scope }}.hargaSatuanDisplay = window.DHSKasHelper.formatRupiahString($event.target.value)"
                       placeholder="Contoh: 500.000"
                       inputmode="numeric"
                       style="padding-left:42px;font-weight:600;"
                       required>
            </div>
        </div>

        {{-- 8. Total Transaksi (Otomatis) --}}
        <div style="grid-column:1/-1;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:10px;padding:12px 16px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
            <div>
                <div style="font-size:12px;color:#64748b;font-weight:600;">Total Transaksi (Otomatis)</div>
                <div style="font-size:11px;color:#94a3b8;" x-text="(parseFloat({{ $scope }}.volume) || 0) + ' ' + ({{ $scope }}.satuan || 'Paket') + ' × Rp ' + window.DHSKasHelper.formatNumber(calcHarga)"></div>
            </div>
            <div style="font-size:22px;font-weight:800;"
                 :style="{{ $scope }}.type === 'keluar' ? 'color:#b91c1c;' : 'color:#0f172a;'"
                 x-text="'Rp ' + window.DHSKasHelper.formatNumber(calcTotal)"></div>
        </div>

        {{-- 9. Keterangan --}}
        <div style="grid-column:1/-1;">
            <label class="bo-label">Keterangan</label>
            <textarea class="bo-textarea" name="keterangan" x-model="{{ $scope }}.keterangan" rows="2" style="min-height:70px;" placeholder="Catatan tambahan"></textarea>
        </div>

        {{-- 10. Kode Transaksi (Otomatis / Manual) --}}
        <div style="grid-column:1/-1;">
            <label class="bo-label">Kode Transaksi</label>
            <div style="display:grid;grid-template-columns:160px 1fr;gap:8px;">
                <select class="bo-select" x-model="{{ $scope }}.kodeMode"
                        x-on:change="if({{ $scope }}.kodeMode === 'auto') {{ $scope }}.kode = ''">
                    <option value="auto">Otomatis</option>
                    <option value="manual">Isi Manual</option>
                </select>
                <div x-show="{{ $scope }}.kodeMode === 'auto'">
                    <input type="text" class="bo-input" readonly style="background:#f1f5f9;color:#64748b;cursor:not-allowed;"
                           :value="({{ $scope }}.type === 'keluar' ? 'KK' : 'KM') + '-' + ({{ $scope }}.tanggal || '').replace(/-/g,'') + '-XXXX'">
                </div>
                <div x-show="{{ $scope }}.kodeMode === 'manual'" style="display:none;">
                    <input type="text" class="bo-input" :name="{{ $scope }}.kodeMode === 'manual' ? 'kode' : ''" x-model="{{ $scope }}.kode" placeholder="Masukkan kode transaksi manual" maxlength="50">
                </div>
            </div>
        </div>

        {{-- 11. Bukti Transaksi (Upload PDF, JPG, PNG) --}}
        <div style="grid-column:1/-1;">
            <label class="bo-label">Bukti Transaksi</label>
            <div x-on:click="$refs.fileInput.click()"
                 style="border:1.5px dashed #cbd5e1;border-radius:12px;padding:18px;text-align:center;cursor:pointer;background:#fafafa;transition:all .15s;">
                <span class="material-icons-round" style="font-size:28px;color:#475569;display:block;margin-bottom:4px;">upload_file</span>
                <div style="font-weight:700;font-size:13.5px;color:#0f172a;">Upload bukti transaksi</div>
                <div style="font-size:12px;color:#64748b;">PDF, JPG, PNG (maks. 5MB)</div>
            </div>
            <input type="file" x-ref="fileInput" name="bukti_file" accept=".pdf,.jpg,.jpeg,.png,.webp"
                   x-on:change="onFilePicked($event)" style="display:none;">

            {{-- File / Image Preview --}}
            <div x-show="localFileName || {{ $scope }}.bukti_gambar" style="display:none;margin-top:10px;padding:10px 12px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                    <div style="display:flex;align-items:center;gap:10px;min-width:0;">
                        <template x-if="localFilePreview || ({{ $scope }}.bukti_gambar && !window.DHSKasHelper.isPdf({{ $scope }}.bukti_gambar) && !localFileName)">
                            <img :src="localFilePreview || {{ $scope }}.bukti_gambar" style="width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #cbd5e1;">
                        </template>
                        <template x-if="localIsPdf || (!localFileName && window.DHSKasHelper.isPdf({{ $scope }}.bukti_gambar))">
                            <span class="material-icons-round" style="font-size:32px;color:#dc2626;">picture_as_pdf</span>
                        </template>
                        <div style="min-width:0;">
                            <div style="font-size:12.5px;font-weight:600;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"
                                 x-text="localFileName || ({{ $scope }}.bukti_gambar ? {{ $scope }}.bukti_gambar.split('/').pop() : '')"></div>
                            <div style="font-size:11px;color:#64748b;" x-text="localFileName ? 'Siap diupload' : 'File tersimpan'"></div>
                        </div>
                    </div>
                    <button type="button" x-on:click="clearPickedFile()"
                            style="background:none;border:none;color:#dc2626;cursor:pointer;font-size:12px;font-weight:600;">
                        Hapus
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{-- Form Action Footer --}}
    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:18px;padding-top:14px;border-top:1px solid #f1f5f9;">
        @if($showCancel)
            <button type="button" class="btn-secondary" x-on:click="{{ $cancelAction }}">Batal</button>
        @endif
        <button type="submit" class="btn-primary" style="background:{{ $btnBg }};">
            <span class="material-icons-round" style="font-size:18px;">save</span>
            <span x-text="{{ $scope }}.editMode ? 'Simpan Perubahan' : '{{ $submitText }}'"></span>
        </button>
    </div>
</form>

