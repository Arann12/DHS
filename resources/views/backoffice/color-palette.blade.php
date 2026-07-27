@extends('backoffice.layouts.app')
@section('title', 'Pengaturan Warna Website')
@section('page-title', 'Color Palette Manager')

@section('content')
<div x-data="colorPaletteManager()">

    {{-- Success Message --}}
    @if(session('success'))
    <div style="background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> {{ session('success') }}
    </div>
    @endif

    {{-- Page Description --}}
    <div class="bo-card" style="margin-bottom:24px;background:linear-gradient(135deg, #F6F2EA 0%, #EFE7D8 100%);">
        <div style="display:flex;align-items:start;gap:16px;">
            <div style="width:50px;height:50px;background:#0E06B4;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="color:#fff;font-size:28px;">palette</span>
            </div>
            <div>
                <h3 style="margin:0 0 8px;font-family:'Playfair Display',serif;font-size:20px;color:#2B2494;">Kelola Palet Warna Website</h3>
                <p style="margin:0;color:#666;font-size:13.5px;line-height:1.6;">
                    Ubah skema warna utama website DHS secara real-time. Gunakan color picker atau masukkan kode HEX warna (contoh: #0E06B4). 
                    Perubahan akan diterapkan ke seluruh halaman website publik.
                </p>
            </div>
        </div>
    </div>

    {{-- Color Management Form --}}
    <form method="POST" action="/backoffice/color-palette/update" @submit.prevent="submitForm">
        @csrf
        
        <div class="bo-card">
            <h3 style="margin:0 0 20px;font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;border-bottom:2px solid #eee;padding-bottom:12px;">
                Warna Utama Website
            </h3>

            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(280px, 1fr));gap:20px;">
                
                {{-- Color Primary (Navy) --}}
                <div class="color-item" x-data="{ color: '{{ $colors['color_primary']->setting_value ?? '#0E06B4' }}' }">
                    <input type="hidden" name="colors[0][setting_key]" value="color_primary">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
                        <div class="color-preview" :style="'background:' + color"></div>
                        <div style="flex:1;">
                            <label class="bo-label" style="margin-bottom:4px;">Primary Color (Navy)</label>
                            <p style="margin:0;font-size:11px;color:#888;">Warna utama tombol & heading</p>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <input type="color" x-model="color" style="width:60px;height:42px;border:2px solid #e0e0e0;border-radius:8px;cursor:pointer;">
                        <input type="text" x-model="color" name="colors[0][setting_value]" 
                            class="bo-input" placeholder="#0E06B4" 
                            style="flex:1;font-family:monospace;text-transform:uppercase;"
                            pattern="^#[A-Fa-f0-9]{6}$"
                            required>
                    </div>
                </div>

                {{-- Color Secondary (Red) --}}
                <div class="color-item" x-data="{ color: '{{ $colors['color_secondary']->setting_value ?? '#D62828' }}' }">
                    <input type="hidden" name="colors[1][setting_key]" value="color_secondary">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
                        <div class="color-preview" :style="'background:' + color"></div>
                        <div style="flex:1;">
                            <label class="bo-label" style="margin-bottom:4px;">Secondary Color (Red)</label>
                            <p style="margin:0;font-size:11px;color:#888;">Warna aksen & highlight</p>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <input type="color" x-model="color" style="width:60px;height:42px;border:2px solid #e0e0e0;border-radius:8px;cursor:pointer;">
                        <input type="text" x-model="color" name="colors[1][setting_value]" 
                            class="bo-input" placeholder="#D62828" 
                            style="flex:1;font-family:monospace;text-transform:uppercase;"
                            pattern="^#[A-Fa-f0-9]{6}$"
                            required>
                    </div>
                </div>

                {{-- Color Navy --}}
                <div class="color-item" x-data="{ color: '{{ $colors['color_navy']->setting_value ?? '#2B2494' }}' }">
                    <input type="hidden" name="colors[2][setting_key]" value="color_navy">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
                        <div class="color-preview" :style="'background:' + color"></div>
                        <div style="flex:1;">
                            <label class="bo-label" style="margin-bottom:4px;">Navy Color</label>
                            <p style="margin:0;font-size:11px;color:#888;">Warna navy untuk elemen dekoratif</p>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <input type="color" x-model="color" style="width:60px;height:42px;border:2px solid #e0e0e0;border-radius:8px;cursor:pointer;">
                        <input type="text" x-model="color" name="colors[2][setting_value]" 
                            class="bo-input" placeholder="#2B2494" 
                            style="flex:1;font-family:monospace;text-transform:uppercase;"
                            pattern="^#[A-Fa-f0-9]{6}$"
                            required>
                    </div>
                </div>

                {{-- Color Cream --}}
                <div class="color-item" x-data="{ color: '{{ $colors['color_cream']->setting_value ?? '#F6F2EA' }}' }">
                    <input type="hidden" name="colors[3][setting_key]" value="color_cream">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
                        <div class="color-preview" :style="'background:' + color"></div>
                        <div style="flex:1;">
                            <label class="bo-label" style="margin-bottom:4px;">Cream Background</label>
                            <p style="margin:0;font-size:11px;color:#888;">Warna background section</p>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <input type="color" x-model="color" style="width:60px;height:42px;border:2px solid #e0e0e0;border-radius:8px;cursor:pointer;">
                        <input type="text" x-model="color" name="colors[3][setting_value]" 
                            class="bo-input" placeholder="#F6F2EA" 
                            style="flex:1;font-family:monospace;text-transform:uppercase;"
                            pattern="^#[A-Fa-f0-9]{6}$"
                            required>
                    </div>
                </div>

                {{-- Color Beige --}}
                <div class="color-item" x-data="{ color: '{{ $colors['color_beige']->setting_value ?? '#EFE7D8' }}' }">
                    <input type="hidden" name="colors[4][setting_key]" value="color_beige">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
                        <div class="color-preview" :style="'background:' + color"></div>
                        <div style="flex:1;">
                            <label class="bo-label" style="margin-bottom:4px;">Beige Surface</label>
                            <p style="margin:0;font-size:11px;color:#888;">Warna permukaan alternatif</p>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <input type="color" x-model="color" style="width:60px;height:42px;border:2px solid #e0e0e0;border-radius:8px;cursor:pointer;">
                        <input type="text" x-model="color" name="colors[4][setting_value]" 
                            class="bo-input" placeholder="#EFE7D8" 
                            style="flex:1;font-family:monospace;text-transform:uppercase;"
                            pattern="^#[A-Fa-f0-9]{6}$"
                            required>
                    </div>
                </div>

            </div>

            {{-- Action Buttons --}}
            <div style="margin-top:32px;padding-top:20px;border-top:2px solid #eee;display:flex;align-items:center;justify-content:space-between;gap:12px;">
                <button type="button" @click="resetToDefault()" class="btn-secondary">
                    <span class="material-icons-round" style="font-size:18px;">restart_alt</span>
                    Reset ke Warna Default
                </button>
                <button type="submit" class="btn-primary" :disabled="saving">
                    <span class="material-icons-round" style="font-size:18px;" x-show="!saving">save</span>
                    <span class="spinner" x-show="saving" style="width:16px;height:16px;border:2px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:spin 0.6s linear infinite;"></span>
                    <span x-text="saving ? 'Menyimpan...' : 'Simpan Perubahan'">Simpan Perubahan</span>
                </button>
            </div>
        </div>

    </form>

    {{-- Preview Section --}}
    <div class="bo-card" style="margin-top:24px;">
        <h3 style="margin:0 0 16px;font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;">
            <span class="material-icons-round" style="vertical-align:middle;font-size:22px;margin-right:6px;">visibility</span>
            Preview Warna
        </h3>
        <p style="margin:0 0 20px;color:#666;font-size:13px;">
            Pratinjau bagaimana warna yang dipilih akan terlihat pada elemen website:
        </p>
        
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:16px;">
            <div style="padding:20px;border-radius:12px;background:{{ $colors['color_primary']->setting_value ?? '#0E06B4' }};color:#fff;text-align:center;font-weight:600;">
                Primary Button
            </div>
            <div style="padding:20px;border-radius:12px;background:{{ $colors['color_secondary']->setting_value ?? '#D62828' }};color:#fff;text-align:center;font-weight:600;">
                Secondary Button
            </div>
            <div style="padding:20px;border-radius:12px;background:{{ $colors['color_navy']->setting_value ?? '#2B2494' }};color:#fff;text-align:center;font-weight:600;">
                Navy Element
            </div>
            <div style="padding:20px;border-radius:12px;background:{{ $colors['color_cream']->setting_value ?? '#F6F2EA' }};border:2px solid #e0e0e0;text-align:center;font-weight:600;color:#333;">
                Cream Background
            </div>
        </div>
    </div>

</div>

<style>
    .color-preview {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15), inset 0 0 0 1px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    
    .color-item {
        padding: 16px;
        border: 2px solid #f0f0f0;
        border-radius: 12px;
        transition: all 0.2s;
    }
    
    .color-item:hover {
        border-color: #0E06B4;
        box-shadow: 0 4px 12px rgba(14,6,180,0.1);
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<script>
function colorPaletteManager() {
    return {
        saving: false,
        
        submitForm(event) {
            this.saving = true;
            event.target.submit();
        },
        
        resetToDefault() {
            if (confirm('Reset semua warna ke pengaturan default DHS?')) {
                // Set default colors
                const defaults = {
                    'color_primary': '#0E06B4',
                    'color_secondary': '#D62828',
                    'color_navy': '#2B2494',
                    'color_cream': '#F6F2EA',
                    'color_beige': '#EFE7D8'
                };
                
                // Update all color inputs
                document.querySelectorAll('input[type="text"][name*="setting_value"]').forEach(input => {
                    const key = input.name.match(/colors\[\d+\]\[setting_value\]/);
                    const hiddenInput = input.closest('.color-item').querySelector('input[type="hidden"]');
                    const colorKey = hiddenInput ? hiddenInput.value : null;
                    
                    if (colorKey && defaults[colorKey]) {
                        input.value = defaults[colorKey];
                        input.dispatchEvent(new Event('input'));
                    }
                });
            }
        }
    }
}
</script>
@endsection
