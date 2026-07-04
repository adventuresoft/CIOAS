<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::find(218);
echo "User 218\n";
echo "institute_id: " . var_export($user->institute_id, true) . "\n";
echo "role_id: " . var_export($user->role_id, true) . "\n";
echo "user_type: " . var_export($user->user_type, true) . "\n";
