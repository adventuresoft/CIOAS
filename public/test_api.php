<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/appointments/api/slots-by-date/163?date=2026-06-07', 'GET');
$response = $kernel->handle($request);
echo $response->getContent();
