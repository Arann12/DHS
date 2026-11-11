@php
    $payScope    = $payScope ?? 'piutangPay';
    $payRedirect = $payRedirect ?? '';
@endphp

<div class="bo-modal-backdrop"
     x-show="{{ $payScope }}.open"
     x-transition
     style="display:none;z-index:1200;"
     x-on:click.self="{{ $payScope }}.open = false"
     x-on:keydown.escape.window="{{ $payScope }}.open = false">
    <div class="bo-modal" style="max-width:480px;width:95%;padding:24px 26px;" x-on:click.stop>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:38px;height:38px;border-radius:10px;background:#fef3c7;color:#b45309;display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round">payments</span>
                </div>
                <div>
                    <h3 style="margin:0;font-size:1.05rem;font-weight:700;color:#0f172a;">Bayar / Lunasi Piutang</h3>
                    <div style="font-size:12px;color:#64748b;" x-text="{{ $payScope }}.kode || 'Tagihan Belum Lunas'"></div>
                </div>
            </div>
            <button type="button" class="btn-icon" x-on:click="{{ $payScope }}.open = false">
                <span class="material-icons-round">close</span>
            </button>
        </div>

        <form method="POST"
              :action="'/backoffice/kas/' + {{ $payScope }}.trxId + '/piutang-lunas'"
              x-data="{
                  payType: 'lunas',
                  get bayarNumeric() {
                      return window.DHSKasHelper.parseRupiah({{ $payScope }}.bayarDisplay);
                  },
                  get sisaSetelah() {
                      return Math.max(0, (parseFloat({{ $payScope }}.sisa) || 0) - this.bayarNumeric);
                  },
                  selectPayType(mode) {
                      this.payType = mode;
                      if (mode === 'lunas') {
                          {{ $payScope }}.bayarDisplay = window.DHSKasHelper.formatRupiahString(Math.round({{ $payScope }}.sisa));
                      } else {
                          if (this.bayarNumeric >= (parseFloat({{ $payScope }}.sisa) || 0)) {
                              {{ $payScope }}.bayarDisplay = '';
                          }
                      }
                  },
                  init() {
                      this.$watch('{{ $payScope }}.open', (val) => {
                          if (val) {
                              this.payType = 'lunas';
                              {{ $payScope }}.bayarDisplay = window.DHSKasHelper.formatRupiahString(Math.round({{ $payScope }}.sisa));
                          }
                      });
                  },
                  validatePay(e) {
                      const b = this.bayarNumeric;
                      const max = parseFloat({{ $payScope }}.sisa) || 0;
                      if (b <= 0) {
                          e.preventDefault();
                          alert('Nominal pembayaran harus lebih dari Rp 0.');
                          return;
                      }
                      if (b > max) {
                          e.preventDefault();
                          alert('Nominal pembayaran melebihi sisa piutang (Rp ' + window.DHSKasHelper.formatNumber(max) + ').');
                      }
                  }
              }"
              x-on:submit="validatePay($event)">
            @csrf
            <input type="hidden" name="nominal_bayar" :value="bayarNumeric">
            @if($payRedirect)
                <input type="hidden" name="redirect_to" value="{{ $payRedirect }}">
            @endif

            {{-- Info Tagihan --}}
            <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:12px 14px;margin-bottom:12px;">
                <div style="font-size:12.5px;font-weight:700;color:#0f172a;" x-text="{{ $payScope }}.deskripsi || 'Tagihan Piutang'"></div>
                <div style="font-size:12px;color:#92400e;margin-top:3px;" x-show="{{ $payScope }}.nama">
                    Penanggung / Siswa: <strong x-text="{{ $payScope }}.nama"></strong>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:8px;padding-top:8px;border-top:1px dashed #fcd34d;">
                    <span style="font-size:12px;color:#92400e;font-weight:600;">Sisa Piutang Saat Ini:</span>
                    <span style="font-size:16px;font-weight:800;color:#b45309;" x-text="'Rp ' + window.DHSKasHelper.formatNumber({{ $payScope }}.sisa)"></span>
                </div>
            </div>

            {{-- 2 Pilihan Utama: Bayar Lunas vs Cicil --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:12px;">
                <div x-on:click="selectPayType('lunas')"
                     style="border-radius:10px;padding:10px 12px;cursor:pointer;transition:all 0.15s ease;user-select:none;display:flex;align-items:center;gap:8px;"
                     :style="payType === 'lunas'
                         ? 'background:#f0fdf4;border:2px solid #16a34a;box-shadow:0 2px 6px rgba(22,163,74,0.12);'
                         : 'background:#ffffff;border:1.5px solid #cbd5e1;'">
                    <div style="width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;"
                         :style="payType === 'lunas' ? 'background:#16a34a;color:#ffffff;' : 'background:#f1f5f9;color:#94a3b8;'">
                        <span class="material-icons-round" style="font-size:15px;"
                              x-text="payType === 'lunas' ? 'check' : 'radio_button_unchecked'"></span>
                    </div>
                    <div>
                        <div style="font-size:12.5px;font-weight:700;" :style="payType === 'lunas' ? 'color:#15803d;' : 'color:#1e293b;'">
                            Bayar Lunas
                        </div>
                        <div style="font-size:10.5px;" :style="payType === 'lunas' ? 'color:#166534;' : 'color:#64748b;'">
                            100% Selesai
                        </div>
                    </div>
                </div>

                <div x-on:click="selectPayType('cicil')"
                     style="border-radius:10px;padding:10px 12px;cursor:pointer;transition:all 0.15s ease;user-select:none;display:flex;align-items:center;gap:8px;"
                     :style="payType === 'cicil'
                         ? 'background:#eff6ff;border:2px solid #2563eb;box-shadow:0 2px 6px rgba(37,99,235,0.12);'
                         : 'background:#ffffff;border:1.5px solid #cbd5e1;'">
                    <div style="width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;"
                         :style="payType === 'cicil' ? 'background:#2563eb;color:#ffffff;' : 'background:#f1f5f9;color:#94a3b8;'">
                        <span class="material-icons-round" style="font-size:15px;"
                              x-text="payType === 'cicil' ? 'check' : 'radio_button_unchecked'"></span>
                    </div>
                    <div>
                        <div style="font-size:12.5px;font-weight:700;" :style="payType === 'cicil' ? 'color:#1d4ed8;' : 'color:#1e293b;'">
                            Cicil
                        </div>
                        <div style="font-size:10.5px;" :style="payType === 'cicil' ? 'color:#1e40af;' : 'color:#64748b;'">
                            Bayar Sebagian
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:12px;">
                <div>
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;">
                        <label class="bo-label" style="margin-bottom:0;" x-text="payType === 'lunas' ? 'Nominal Pelunasan Penuh (Rp)' : 'Nominal Cicilan Dibayar Sekarang (Rp)'"></label>
                        <span style="font-size:11px;font-weight:600;" :style="payType === 'lunas' ? 'color:#15803d;' : 'color:#1e40af;'" x-text="payType === 'lunas' ? 'Otomatis Lunas Penuh' : 'Pembayaran Sebagian'"></span>
                    </div>
                    <div style="position:relative;display:flex;align-items:center;">
                        <span style="position:absolute;left:14px;font-weight:700;font-size:13.5px;color:#64748b;pointer-events:none;">Rp</span>
                        <input type="text"
                               class="bo-input"
                               x-model="{{ $payScope }}.bayarDisplay"
                               x-on:input="{{ $payScope }}.bayarDisplay = window.DHSKasHelper.formatRupiahString($event.target.value); if(bayarNumeric < parseFloat({{ $payScope }}.sisa)) { payType = 'cicil'; }"
                               placeholder="Contoh: 1.500.000"
                               inputmode="numeric"
                               style="padding-left:42px;font-weight:700;"
                               required>
                    </div>
                    <div style="font-size:11.5px;margin-top:6px;font-weight:600;padding:6px 10px;border-radius:6px;"
                         :style="sisaSetelah === 0 ? 'background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;' : 'background:#fffbeb;color:#92400e;border:1px solid #fde68a;'"
                         x-text="sisaSetelah === 0 ? '✓ Status akan menjadi LUNAS PENUH dan 100% sisa masuk ke kas DHS hari ini.' : '💳 Pembayaran cicilan: Rp ' + window.DHSKasHelper.formatNumber(bayarNumeric) + ' masuk kas, sisa piutang selanjutnya Rp ' + window.DHSKasHelper.formatNumber(sisaSetelah)"></div>
                </div>

                <div>
                    <label class="bo-label">Tanggal Pembayaran</label>
                    <input type="date" class="bo-input" name="tanggal_bayar" x-model="{{ $payScope }}.tanggal" required>
                </div>

                <div>
                    <label class="bo-label">Catatan (Opsional)</label>
                    <input type="text" class="bo-input" name="catatan" x-model="{{ $payScope }}.catatan" placeholder="Misal: Transfer BCA / Termin 2 / Tunai di Front Office">
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:18px;padding-top:14px;border-top:1px solid #f1f5f9;">
                <button type="button" class="btn-secondary" x-on:click="{{ $payScope }}.open = false">Batal</button>
                <button type="submit" class="btn-primary" style="background:#15803d;">
                    <span class="material-icons-round" style="font-size:17px;">check_circle</span>
                    <span x-text="sisaSetelah === 0 ? 'Simpan & Tandai Lunas' : 'Catat Cicilan Masuk Kas'"></span>
                </button>
            </div>
        </form>
    </div>
</div>

