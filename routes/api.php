<?php

use App\Http\Controllers\OilCheckController;
use Illuminate\Support\Facades\Route;

Route::post('/oilcheck', [OilCheckController::class, 'store'])->name('oilcheck.store');

Route::get('/oilcheck/{oilCheck}', [OilCheckController::class, 'check'])->name('oilcheck.check');
