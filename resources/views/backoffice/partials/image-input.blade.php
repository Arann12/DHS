{{-- 
    Reusable Image Input Component with Dual Option:
    1. Upload File
    2. Paste URL
    
    Usage:
    @include('backoffice.partials.image-input', [
        'name' => 'thumbnail_url',
        'label' => 'Thumbnail Berita',
        'currentValue' => $article->thumbnail_url ?? '',
        'required' => false
    ])
--}}

@php
    $inputId = $name ?? 'image_input';
    $inputLabel = $label ?? 'Gambar';
    $currentUrl = $currentValue ?? '';
    $isRequired = $required ?? false;
@endphp

<div class="form-group" x-data="imageInput('{{ $inputId }}', '{{ $currentUrl }}')">
    <label for="{{ $inputId }}">
        {{ $inputLabel }}
        @if($isRequired) <span style="color:#C53030;">*</span> @endif
    </label>
    
    {{-- Tab Switcher --}}
    <div style="display:flex;gap:8px;margin-bottom:12px;border-bottom:2px solid #e0e0e0;">
        <button 
            type="button" 
            @click="mode = 'upload'" 
            :style="mode === 'upload' ? 'border-bottom:3px solid #1A365D;color:#1A365D;font-weight:600;' : 'color:#888;'"
            style="background:none;border:none;padding:10px 16px;cursor:pointer;font-size:14px;transition:all 0.2s;margin-bottom:-2px;"
        >
            <span class="material-icons-round" style="vertical-align:middle;font-size:18px;margin-right:4px;">upload_file</span>
            Upload File
        </button>
        <button 
            type="button" 
            @click="mode = 'url'" 
            :style="mode === 'url' ? 'border-bottom:3px solid #1A365D;color:#1A365D;font-weight:600;' : 'color:#888;'"
            style="background:none;border:none;padding:10px 16px;cursor:pointer;font-size:14px;transition:all 0.2s;margin-bottom:-2px;"
        >
            <span class="material-icons-round" style="vertical-align:middle;font-size:18px;margin-right:4px;">link</span>
            Paste URL
        </button>
    </div>

    {{-- Upload File Mode --}}
    <div x-show="mode === 'upload'" x-transition>
        <input 
            type="file" 
            :id="'{{ $inputId }}_file'" 
            @change="handleFileUpload($event)"
            accept="image/*"
            style="width:100%;padding:10px;border:2px dashed #ccc;border-radius:8px;cursor:pointer;"
        >
        <small style="color:#888;font-size:12px;">Format: JPG, PNG, GIF. Max 2MB.</small>
    </div>

    {{-- Paste URL Mode --}}
    <div x-show="mode === 'url'" x-transition>
        <input 
            type="url" 
            :id="'{{ $inputId }}_url'" 
            x-model="imageUrl"
            placeholder="https://example.com/image.jpg"
            style="width:100%;padding:10px;border:1.5px solid #e0e0e0;border-radius:8px;font-size:14px;"
        >
        <small style="color:#888;font-size:12px;">Paste URL gambar dari internet atau storage Anda.</small>
    </div>

    {{-- Hidden Input untuk Form Submit --}}
    <input type="hidden" :name="'{{ $name }}'" :value="imageUrl">

    {{-- Preview Image --}}
    <div x-show="imageUrl" x-transition style="margin-top:12px;">
        <p style="font-size:13px;font-weight:600;color:#444;margin-bottom:6px;">Preview:</p>
        <div style="position:relative;display:inline-block;">
            <img :src="imageUrl" alt="Preview" style="max-width:200px;max-height:200px;border-radius:8px;border:2px solid #e0e0e0;">
            <button 
                type="button" 
                @click="clearImage()"
                style="position:absolute;top:8px;right:8px;background:#C53030;color:#fff;border:none;border-radius:50%;width:28px;height:28px;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.3);"
                title="Hapus gambar"
            >
                <span class="material-icons-round" style="font-size:16px;">close</span>
            </button>
        </div>
    </div>
</div>

<script>
function imageInput(inputId, initialUrl) {
    return {
        mode: initialUrl && initialUrl.startsWith('http') ? 'url' : 'upload',
        imageUrl: initialUrl || '',
        
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('File terlalu besar! Maksimal 2MB.');
                event.target.value = '';
                return;
            }
            
            // Create preview URL
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imageUrl = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        
        clearImage() {
            this.imageUrl = '';
            const fileInput = document.getElementById(inputId + '_file');
            const urlInput = document.getElementById(inputId + '_url');
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = '';
        }
    };
}
</script>

<style>
    [x-cloak] { display: none !important; }
</style>
