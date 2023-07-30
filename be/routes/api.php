<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JenisBarangController;
use App\Http\Controllers\API\StockBarangController;
use App\Http\Controllers\API\PrediksiController;

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

// generate url dokumen
Route::get('upload/{pathA}/{pathB}/{pathC?}', function ($pathA, $pathB, $pathC = null) {
    $path = "{$pathA}/{$pathB}";
    if ($pathC !== null) $path .= "/{$pathC}";
    $mime = Storage::mimeType($path);
    $allowedMime = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword', 'application/vnd.ms-excel'];

    if (!in_array($mime, $allowedMime))
        return response()->json(['error' => 'Tidak terpenuhi.'], 400);
    else
        return response()->file(storage_path("app/{$path}"));
});
// end generate url dokumen


Route::prefix('user')->controller(AuthController::class)->group(function () {
    Route::post('auth', 'issueToken');

    Route::get('', 'getMe')->middleware('auth:sanctum');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function() {

    Route::prefix('jenis-barang')->controller(JenisBarangController::class)->group(function() {
        Route::get('', 'index');
        Route::get('/{jenis}/show', 'show');
        Route::post('/', 'store');
        Route::post('/{jenis}/update', 'update');
        Route::delete('/{jenis}/delete', 'destroy');
    });

    Route::prefix('stock-barang')->controller(StockBarangController::class)->group(function() {
        Route::get('', 'index');
        Route::get('/{stock}/show', 'show');
        Route::post('/', 'store');
        Route::post('/{stock}/update', 'update');
        Route::delete('/{stock}/delete', 'destroy');
    });

    Route::prefix('prediksi')->controller(PrediksiController::class)->group(function() {
        Route::get('', 'index');
        Route::get('/{prediksi}/show', 'show');
        Route::post('/', 'store');
    });
});
