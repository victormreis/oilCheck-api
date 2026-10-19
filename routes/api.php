<?php

use App\Http\Controllers\OilCheckController;
use Illuminate\Support\Facades\Route;

Route::post('/oilcheck', [OilCheckController::class, 'store'])->name('oilcheck.store');
