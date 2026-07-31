

<?php
    $inputId = $name ?? 'image_input';
    $inputLabel = $label ?? 'Gambar';
    $currentUrl = $currentValue ?? '';
    $isRequired = $required ?? false;
?>

<div class="form-group" x-data="imageInput('<?php echo e($inputId); ?>', '<?php echo e($currentUrl); ?>')">
    <label for="<?php echo e($inputId); ?>">
        <?php echo e($inputLabel); ?>

        <?php if($isRequired): ?> <span style="color:#D4302A;">*</span> <?php endif; ?>
    </label>
    
    
    <div style="display:flex;gap:8px;margin-bottom:12px;border-bottom:2px solid #e0e0e0;">
        <button 
            type="button" 
            @click="mode = 'upload'" 
            :style="mode === 'upload' ? 'border-bottom:3px solid #1A1F6B;color:#1A1F6B;font-weight:600;' : 'color:#888;'"
            style="background:none;border:none;padding:10px 16px;cursor:pointer;font-size:14px;transition:all 0.2s;margin-bottom:-2px;"
        >
            <span class="material-icons-round" style="vertical-align:middle;font-size:18px;margin-right:4px;">upload_file</span>
            Upload File
        </button>
        <button 
            type="button" 
            @click="mode = 'url'" 
            :style="mode === 'url' ? 'border-bottom:3px solid #1A1F6B;color:#1A1F6B;font-weight:600;' : 'color:#888;'"
            style="background:none;border:none;padding:10px 16px;cursor:pointer;font-size:14px;transition:all 0.2s;margin-bottom:-2px;"
        >
            <span class="material-icons-round" style="vertical-align:middle;font-size:18px;margin-right:4px;">link</span>
            Paste URL
        </button>
    </div>

    
    <div x-show="mode === 'upload'" x-transition>
        <input 
            type="file" 
            :id="'<?php echo e($inputId); ?>_file'" 
            @change="handleFileUpload($event)"
            accept="image/*"
            style="width:100%;padding:10px;border:2px dashed #ccc;border-radius:8px;cursor:pointer;"
        >
        <small style="color:#888;font-size:12px;">Format: JPG, PNG, GIF. Max 2MB.</small>
    </div>

    
    <div x-show="mode === 'url'" x-transition>
        <input 
            type="url" 
            :id="'<?php echo e($inputId); ?>_url'" 
            x-model="imageUrl"
            placeholder="https://example.com/image.jpg"
            style="width:100%;padding:10px;border:1.5px solid #e0e0e0;border-radius:8px;font-size:14px;"
        >
        <small style="color:#888;font-size:12px;">Paste URL gambar dari internet atau storage Anda.</small>
    </div>

    
    <input type="hidden" :name="'<?php echo e($name); ?>'" :value="imageUrl">

    
    <div x-show="imageUrl" x-transition style="margin-top:12px;">
        <p style="font-size:13px;font-weight:600;color:#444;margin-bottom:6px;">Preview:</p>
        <div style="position:relative;display:inline-block;">
            <img :src="imageUrl" alt="Preview" style="max-width:200px;max-height:200px;border-radius:8px;border:2px solid #e0e0e0;">
            <button 
                type="button" 
                @click="clearImage()"
                style="position:absolute;top:8px;right:8px;background:#D4302A;color:#fff;border:none;border-radius:50%;width:28px;height:28px;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.3);"
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
<?php /**PATH D:\laragon\www\DHS\resources\views\backoffice\partials\image-input.blade.php ENDPATH**/ ?>