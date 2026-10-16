<?php

use App\Http\Controllers\OilCheckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/checks', [OilCheckController::class, 'store'])->name('api.checks');
Route::get('/checks/{oilCheck}', [OilCheckController::class, 'show'])->name('api.check');
