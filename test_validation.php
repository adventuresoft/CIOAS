<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/register', 'POST', [
    'name' => 'John Doe',
    'bn_name' => 'জন ডেন',
    'dob_day' => '1',
    'dob_month' => '1',
    'dob_year' => '1990',
    'gender' => '1',
    'nid_no' => '1234567890',
    'mobile' => '01711000000',
    'email' => 'john@example.com',
    'password' => '123456',
    'password_confirmation' => '123456',
    'father_name' => 'Father',
    'location_type' => 'union_type',
]);
$dob = sprintf('%04d-%02d-%02d', $request->dob_year, $request->dob_month, $request->dob_day);
$request->merge(['dob' => $dob]);

$validator = Illuminate\Support\Facades\Validator::make($request->all(), [
    'name' => 'required|string|max:191',
    'bn_name' => 'required|string|max:191',
    'dob_day' => 'required|integer|min:1|max:31',
    'dob_month' => 'required|integer|min:1|max:12',
    'dob_year' => 'required|integer|min:1900|max:' . date('Y'),
    'dob' => 'required|date',
    'gender' => 'required|in:1,2,3',
    'nid_no' => 'required|string|max:30|unique:people,nid',
    'mobile' => 'required|string|max:20|unique:users,mobile',
    'email' => 'required|email|max:191|unique:users,email',
    'password' => 'required|string|min:6|confirmed',
    'father_name' => 'required|string|max:191',
    'location_type' => 'nullable|in:city_type,pos_type,union_type',
    'division_id' => 'nullable|integer',
    'district_id' => 'nullable|integer',
    'thana_id' => 'nullable|integer',
    'city_id' => 'nullable|integer',
    'pos_id' => 'nullable|integer',
    'union_id' => 'nullable|integer',
    'post_office_id' => 'nullable|integer',
    'village_id' => 'nullable|integer',
    'ward_id' => 'nullable|integer',
    'road' => 'nullable|string|max:191',
    'house' => 'nullable|string|max:191',
]);

if ($validator->fails()) {
    echo "Fails!\n";
    print_r($validator->errors()->toArray());
} else {
    echo "Passes!\n";
}
