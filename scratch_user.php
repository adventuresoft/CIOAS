<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$request = \Illuminate\Http\Request::create('/dashboard/user/218', 'PATCH', [
    'name' => 'RAHIM',
    'email' => 'rahim@example.com',
    'user_type' => 'admin',
    'mobile' => '01712345678',
    'institute_id' => 3,
    'role_id' => 1,
    'status' => 1,
]);

try {
    app(\App\Http\Controllers\UserController::class)->update($request, 218);
    echo "Success\n";
} catch (\Illuminate\Validation\ValidationException $e) {
    echo "Validation Failed: \n";
    print_r($e->errors());
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
