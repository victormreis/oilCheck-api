<?php

use App\Http\Controllers\OilCheckController;
use Illuminate\Support\Facades\Route;

Route::resource('oilCheck',  OilCheckController::class)->only(['show', 'store']);
