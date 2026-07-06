import re

with open(r'c:\xampp\htdocs\office\CIOAS\resources\views\backend\pages\license\ownership\form.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

pattern = r'<!-- Photo -->.*?</div>\s*</div>\s*</div>\s*</div>\s*@push'
replacement = '''<!-- Photo & Signature -->
        <div class="form-group row mt-3">
            <div class="col-sm-3">
                <label for="image_{{ $index }}">Photo</label>
                <input type="file" name="image[]" class="image form-control-file" id="image_{{ $index }}">
                <span class="error image-error text-danger"></span>
            </div>
            <div class="col-sm-3">
                <img class="img-fluid img-thumbnail"
                    src="{{ !empty($ownership->photo) ? asset($ownership->photo) : asset('no-image-found.jpeg') }}"
                    id="preview_{{ $index }}" alt="Preview" width="100" height="100">
            </div>
            <div class="col-sm-3">
                <label for="signature_{{ $index }}">Signature</label>
                <input type="file" name="signature[]" class="signature form-control-file" id="signature_{{ $index }}">
                <span class="error signature-error text-danger"></span>
            </div>
            <div class="col-sm-3">
                <img class="img-fluid img-thumbnail"
                    src="{{ !empty($ownership->signature) ? asset($ownership->signature) : asset('no-image-found.jpeg') }}"
                    id="sig_preview_{{ $index }}" alt="Preview" width="100" height="100">
            </div>
        </div>

    </div>
</div>
</div>
@push'''

new_content = re.sub(pattern, replacement, content, flags=re.DOTALL)

with open(r'c:\xampp\htdocs\office\CIOAS\resources\views\backend\pages\license\ownership\form.blade.php', 'w', encoding='utf-8') as f:
    f.write(new_content)
