<?php
$files = [
    'resources/views/backend/pages/staff/create.blade.php' => [
        'prev' => null,
        'next' => 'family'
    ],
    'resources/views/backend/pages/staff/tabs/family.blade.php' => [
        'prev' => ['label' => 'Personal', 'route' => 'staff.edit'],
        'next' => ['label' => 'Address', 'route' => 'staff.address']
    ],
    'resources/views/backend/pages/staff/tabs/address.blade.php' => [
        'prev' => ['label' => 'Family', 'route' => 'staff.family'],
        'next' => ['label' => 'Education', 'route' => 'staff.education']
    ],
    'resources/views/backend/pages/staff/tabs/educational.blade.php' => [
        'prev' => ['label' => 'Address', 'route' => 'staff.address'],
        'next' => ['label' => 'Profession', 'route' => 'staff.professional']
    ],
    'resources/views/backend/pages/staff/tabs/professional.blade.php' => [
        'prev' => ['label' => 'Education', 'route' => 'staff.education'],
        'next' => ['label' => 'Financial', 'route' => 'staff.financial']
    ],
    'resources/views/backend/pages/staff/tabs/financial.blade.php' => [
        'prev' => ['label' => 'Profession', 'route' => 'staff.professional'],
        'next' => ['label' => 'Property', 'route' => 'staff.property']
    ],
    'resources/views/backend/pages/staff/tabs/property.blade.php' => [
        'prev' => ['label' => 'Financial', 'route' => 'staff.financial'],
        'next' => ['label' => 'Disability', 'route' => 'staff.disability']
    ],
    'resources/views/backend/pages/staff/tabs/disability.blade.php' => [
        'prev' => ['label' => 'Property', 'route' => 'staff.property'],
        'next' => ['label' => 'Freedom', 'route' => 'staff.freedom']
    ],
    'resources/views/backend/pages/staff/tabs/freedom.blade.php' => [
        'prev' => ['label' => 'Disability', 'route' => 'staff.disability'],
        'next' => ['label' => 'July 24 Fighter', 'route' => 'staff.health'] // Placeholder route
    ],
    // Let's also do health as the last one if it exists
    'resources/views/backend/pages/staff/tabs/health.blade.php' => [
        'prev' => ['label' => 'Freedom', 'route' => 'staff.freedom'],
        'next' => ['label' => 'Complete', 'route' => 'staff.index']
    ]
];

$baseDir = __DIR__ . '/';

foreach ($files as $filepath => $data) {
    $fullPath = $baseDir . $filepath;
    if (!file_exists($fullPath)) continue;

    $content = file_get_contents($fullPath);
    
    // Find the start of the card-footer div
    $footerStart = strpos($content, '<div class="card-footer">');
    if ($footerStart === false) {
        $footerStart = strpos($content, '<div class="card-footer');
    }
    
    if ($footerStart !== false) {
        // Find the closing div for card-footer (we assume it ends with <!-- /.card-footer -->)
        $footerEnd = strpos($content, '<!-- /.card-footer -->', $footerStart);
        if ($footerEnd === false) {
            // Alternatively, find the next </form>
            $footerEnd = strpos($content, '</form>', $footerStart);
        }
        
        if ($footerEnd !== false) {
            $existingFooter = substr($content, $footerStart, $footerEnd - $footerStart);
            
            if ($filepath == 'resources/views/backend/pages/staff/create.blade.php') {
                $newFooter = <<<HTML
<div class="card-footer bg-white mt-3" style="border-top: none;">
    <div class="text-right">
        <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary mr-2 px-4">Cancel</a>
        <button type="submit" class="btn btn-primary px-4" style="background-color: #5b4bdf; border-color: #5b4bdf;">Save & Next <i class="fas fa-arrow-right ml-1"></i></button>
    </div>
</div>
HTML;
            } else {
                $prevUrl = isset($data['prev']) ? "{{ route('{$data['prev']['route']}', \$user->id) }}" : "#";
                $prevLabel = isset($data['prev']) ? $data['prev']['label'] : "Previous";
                
                $nextUrl = isset($data['next']) && $data['next']['route'] != 'staff.index' ? "{{ route('{$data['next']['route']}', \$user->id) }}" : "{{ route('staff.index') }}";
                $nextLabel = isset($data['next']) ? $data['next']['label'] : "Next";

                $newFooter = <<<HTML
<div class="card-footer bg-white mt-3" style="border-top: none;">
    <div class="row">
        <div class="col-md-4">
            <a href="{$prevUrl}" class="btn btn-outline-secondary btn-block"><i class="fas fa-arrow-left mr-1"></i> {$prevLabel}</a>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #5b4bdf; border-color: #5b4bdf;"><i class="fas fa-save mr-1"></i> Save & Next</button>
        </div>
        <div class="col-md-4">
            <a href="{$nextUrl}" class="btn btn-outline-primary btn-block" style="color: #5b4bdf; border-color: #5b4bdf;">{$nextLabel} <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
</div>
HTML;
            }
            
            $content = str_replace($existingFooter, $newFooter . "\n                            ", $content);
            file_put_contents($fullPath, $content);
            echo "Updated $filepath\n";
        }
    }
}
