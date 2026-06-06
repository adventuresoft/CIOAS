<?php
$file = 'resources/views/backend/pages/inquiry/show.blade.php';
$content = file_get_contents($file);

$content = str_replace('application-form.assign', 'inquiry.assign', $content);
$content = str_replace('application-form.receive', 'inquiry.receive', $content);
$content = str_replace('application-form.approve', 'inquiry.update', $content);
$content = str_replace('$inquiry->sender', '$inquiry->applicant_name', $content);
$content = str_replace('$inquiry->mobile', '$inquiry->mobile_number', $content);
$content = str_replace('$inquiry->nid_no', '$inquiry->nid_number', $content);
$content = str_replace('Inquiry ??', "'Inquiry'", $content);
$content = str_replace('{{ asset($inquiry->attachment) }}', '{{ asset($inquiry->proof_file) }}', $content);
$content = str_replace('$inquiry->attachment', '$inquiry->proof_file', $content);
$content = str_replace('<form id="approveForm" method="POST">', '<form id="approveForm" method="POST">' . "\n" . '                                            @method("PUT")', $content);

file_put_contents($file, $content);
echo "Replaced";
