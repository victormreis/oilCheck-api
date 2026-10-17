<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/oilcheck', fn () => response()->json(['status' => 'ok']))->name('oilcheck.store');
