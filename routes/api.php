<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BasicSettings\VillageController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\ThanaController;
use App\Http\Controllers\UnionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('application-store', [ApplicationController::class, 'store']);
Route::get('/house-options/{id}', [HouseController::class, 'options']);
Route::get('/get-villages-by-union/{unionID}', [VillageController::class, 'villagesByUnion']);
Route::get('/get-districts-by-division/{divisionID}', [DistrictController::class, 'districtsByDivision']);
Route::get('/get-thanas-by-district/{districtID}', [ThanaController::class, 'thanasByDistrict']);
Route::get('/get-unions-by-thana/{thanaID}', [UnionController::class, 'unionsByThana']);

