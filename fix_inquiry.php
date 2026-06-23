<?php
$f = "c:/xampp/htdocs/office/CIOAS/resources/views/frontend/pages/inquiry/index.blade.php";
$content = file_get_contents($f);

// Remove custom file css
$content = preg_replace("/\/\* Custom File Input \*\/(.*?)\.section-title/s", ".section-title", $content);

// Replace the custom file HTML
$old_html = <<<HTML
                <h5 class="section-title"><i class="fas fa-file-upload"></i> ?????? ?????? ???? ????</h5>
                <div class="row align-items-center mb-4">
                    <div class="col-md-12">
                        <div class="custom-file">
                            <input type="file" name="proof_file" class="custom-file-input" id="proof_file">
                            <label class="custom-file-label" for="proof_file">Choose file...</label>
                        </div>
                    </div>
                </div>
HTML;

$new_html = <<<HTML
                <h5 class="section-title"><i class="fas fa-file-upload"></i> ?????? ?????? ???? ????</h5>
                <div class="row align-items-center mb-4">
                    <div class="col-md-12">
                        <input type="file" name="proof_file" class="form-control" id="proof_file" style="padding-top: 9px;">
                    </div>
                </div>
HTML;

$content = str_replace($old_html, $new_html, $content);
$content = preg_replace("/\/\/ Custom file input label.*?\}\);/s", "", $content);
$content = str_replace(":not(.custom-file-label)", "", $content);
$content = str_replace(":not(.custom-file-input)", "", $content);

file_put_contents($f, $content);
echo "Fixed $f\n";

