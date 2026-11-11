@php
    $pmScope          = $pmScope ?? 'progModal';
    $pmRedirect       = $pmRedirect ?? '';
    $pmKategoriList   = $pmKategoriList ?? ($programKategori ?? collect());
    $pmScopedPrograms = $pmScopedPrograms ?? null; // Jika diset (mode kategori), hanya tampilkan program kategori tersebut
@endphp

<div class="bo-modal-backdrop"
     x-show="{{ $pmScope }}.open"
     x-transition
     style="display:none;z-index:1150;"
     x-on:click.self="{{ $pmScope }}.open = false"
     x-on:keydown.escape.window="{{ $pmScope }}.open = false">
    <div class="bo-modal wide" style="max-width:620px;width:95%;padding:26px 28px;" x-on:click.stop>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
            <h3 style="margin:0;font-size:1.15rem;font-weight:700;"
                x-text="{{ $pmScope }}.mode === 'add' ? 'Tambah Program Baru' : 'Edit Program'"></h3>
            <button type="button" class="btn-icon" x-on:click="{{ $pmScope }}.open = false">
                <span class="material-icons-round">close</span>
            </button>
        </div>

        <form method="POST"
              :action="{{ $pmScope }}.mode === 'add' ? '/backoffice/kas-program/store' : '/backoffice/kas-program/' + {{ $pmScope }}.editId + '/update'"
              x-data="{
                  get parsedNilai() {
                      return window.DHSKasHelper.parseRupiah({{ $pmScope }}.form.nilaiDisplay);
                  },
                  onProgPick(e) {
                      const val = e.target.value;
                      if (val === 'custom') {
                          {{ $pmScope }}.form.judul_program = '';
                          return;
                      }
                      const opt = e.target.options[e.target.selectedIndex];
                      {{ $pmScope }}.form.judul_program = (opt ? opt.getAttribute('data-title') : '') || '';
                  },
                  checkBeforeSubmit(e) {
                      if (!({{ $pmScope }}.form.nama_proyek || '').trim() || !({{ $pmScope }}.form.pic || '').trim()) {
                          e.preventDefault();
                          alert('Nama Program dan PIC wajib diisi.');
                      }
                  }
              }"
              x-on:submit="checkBeforeSubmit($event)">
            @csrf
            <input type="hidden" name="nilai_proyek" :value="parsedNilai">
            <input type="hidden" name="program_id" :value="{{ $pmScope }}.form.program_id === 'custom' ? '' : {{ $pmScope }}.form.program_id">
            @if($pmRedirect)
                <input type="hidden" name="redirect_to" value="{{ $pmRedirect }}">
            @endif

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">

                <div style="grid-column:1/-1;">
                    <label class="bo-label">Kategori / Program Akademi <span style="color:#dc2626">*</span></label>
                    <select class="bo-select" x-model="{{ $pmScope }}.form.program_id" x-on:change="onProgPick($event)" style="margin-bottom:6px;">
                        <option value="">-- Pilih Program Akademi DHS --</option>
                        @if($pmScopedPrograms && count($pmScopedPrograms) > 0)
                            @foreach($pmScopedPrograms as $prog)
                                <option value="{{ $prog->id }}" data-title="{{ $prog->title }}">{{ $prog->title }}</option>
                            @endforeach
                        @else
                            @foreach($pmKategoriList as $kat)
                                <optgroup label="── {{ $kat->category_name }} ──">
                                    @foreach($kat->programs as $prog)
                                        <option value="{{ $prog->id }}" data-title="{{ $prog->title }}">{{ $prog->title }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        @endif
                        <option value="custom">+ Tulis Nama / Kategori Program Manual</option>
                    </select>
                    <div x-show="{{ $pmScope }}.form.program_id === 'custom' || ({{ $pmScope }}.form.program_id === '' && {{ $pmScope }}.form.judul_program)" style="display:none;">
                        <input type="text" class="bo-input" x-model="{{ $pmScope }}.form.judul_program"
                               placeholder="Tulis judul / kategori program (misal: Program Pelatihan Barista)" maxlength="150">
                    </div>
                    <input type="hidden" name="judul_program" :value="{{ $pmScope }}.form.judul_program">
                </div>

                <div style="grid-column:1/-1;">
                    <label class="bo-label">Nama Program / Angkatan / Kegiatan <span style="color:#dc2626">*</span></label>
                    <input type="text" class="bo-input" name="nama_proyek" x-model="{{ $pmScope }}.form.nama_proyek"
                           placeholder="Misal: Kelas Culinary Batch 15 / Pelatihan Kapal Pesiar" maxlength="200" required>
                </div>

                <div style="grid-column:1/-1;">
                    <label class="bo-label">PIC / Penanggung Jawab <span style="color:#dc2626">*</span></label>
                    <input type="text" class="bo-input" name="pic" x-model="{{ $pmScope }}.form.pic"
                           placeholder="Nama penanggung jawab program" maxlength="150" required>
                </div>

                <div>
                    <label class="bo-label">Tanggal Mulai</label>
                    <input type="date" class="bo-input" name="tanggal_mulai" x-model="{{ $pmScope }}.form.tanggal_mulai">
                </div>
                <div>
                    <label class="bo-label">Tanggal Selesai</label>
                    <input type="date" class="bo-input" name="tanggal_selesai" x-model="{{ $pmScope }}.form.tanggal_selesai">
                </div>

                <div style="grid-column:1/-1;">
                    <label class="bo-label">Nilai / Target Biaya Program (Rp) <span style="color:#dc2626">*</span></label>
                    <div style="position:relative;display:flex;align-items:center;">
                        <span style="position:absolute;left:14px;font-weight:700;font-size:13.5px;color:#64748b;pointer-events:none;">Rp</span>
                        <input type="text" class="bo-input" x-model="{{ $pmScope }}.form.nilaiDisplay"
                               x-on:input="{{ $pmScope }}.form.nilaiDisplay = window.DHSKasHelper.formatRupiahString($event.target.value)"
                               placeholder="Contoh: 7.500.000" inputmode="numeric" style="padding-left:42px;font-weight:700;" required>
                    </div>
                </div>

                <div style="grid-column:1/-1;">
                    <label class="bo-label">Keterangan</label>
                    <textarea class="bo-textarea" name="keterangan" x-model="{{ $pmScope }}.form.keterangan" rows="2" style="min-height:72px;"
                              placeholder="Catatan atau keterangan tambahan program..."></textarea>
                </div>

            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px;padding-top:14px;border-top:1px solid #f1f5f9;">
                <button type="button" class="btn-secondary" x-on:click="{{ $pmScope }}.open = false">Batal</button>
                <button type="submit" class="btn-primary">
                    <span class="material-icons-round" style="font-size:18px;">save</span>
                    <span x-text="{{ $pmScope }}.mode === 'add' ? 'Simpan Program' : 'Update Program'"></span>
                </button>
            </div>
        </form>
    </div>
</div>

