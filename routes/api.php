<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/oilCheck', fn () => response()->json([], 201))->name('oilCheck.store');
