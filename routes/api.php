<?php

use App\Http\Controllers\OilCheckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('oilCheck', OilCheckController::class);
