<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$res = Illuminate\Support\Facades\DB::select("SELECT TABLE_NAME, COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA = 'cioas' AND COLUMN_NAME = 'institute_id' AND TABLE_NAME IN ('person_gun_applications', 'org_gun_applications', 'other_org_gun_applications')");
print_r($res);
