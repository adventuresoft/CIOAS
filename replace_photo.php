<?php
$file = 'c:\\xampp\\htdocs\\office\\CIOAS\\resources\\views\\backend\\pages\\license\\ownership\\form.blade.php';
$content = file_get_contents($file);

$search = '        <!-- Photo -->
        <div class="form-group row mt-3">
            <div class="col-sm-6">
                <label for="image">Photo</label>
                <input type="file" name="image[]" class="image form-control-file" id="image_{{ $index }}">
                <span class="error image-error text-danger"></span>
            </div>
            <div class="col-sm-6">
                <img class="img-fluid img-thumbnail"
                    src="{{ !empty($ownership->image) ? asset($ownership->image) : asset(\'no-image-found.jpeg\') }}"
                    id="preview_{{ $index }}" alt="Preview" width="100" height="100">
            </div>
        </div>';

$replace = '        <!-- Photo & Signature -->
        <div class="form-group row mt-3">
            <div class="col-sm-3">
                <label for="image_{{ $index }}">Photo</label>
                <input type="file" name="image[]" class="image form-control-file" id="image_{{ $index }}">
                <span class="error image-error text-danger"></span>
            </div>
            <div class="col-sm-3">
                <img class="img-fluid img-thumbnail"
                    src="{{ !empty($ownership->photo) ? asset($ownership->photo) : asset(\'no-image-found.jpeg\') }}"
                    id="preview_{{ $index }}" alt="Preview" width="100" height="100">
            </div>
            <div class="col-sm-3">
                <label for="signature_{{ $index }}">Signature</label>
                <input type="file" name="signature[]" class="signature form-control-file" id="signature_{{ $index }}">
                <span class="error signature-error text-danger"></span>
            </div>
            <div class="col-sm-3">
                <img class="img-fluid img-thumbnail"
                    src="{{ !empty($ownership->signature) ? asset($ownership->signature) : asset(\'no-image-found.jpeg\') }}"
                    id="sig_preview_{{ $index }}" alt="Preview" width="100" height="100">
            </div>
        </div>';

$newContent = str_replace($search, $replace, $content);
file_put_contents($file, $newContent);
echo "Done";
