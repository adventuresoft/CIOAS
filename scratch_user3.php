<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::find(218);
echo "Roles: " . implode(', ', $user->roles->pluck('name')->toArray()) . "\n";
