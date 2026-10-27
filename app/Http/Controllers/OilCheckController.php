<?php

namespace App\Http\Controllers;

use App\Http\Requests\OilCheckStoreRequest;
use App\Models\OilCheck;

class OilCheckController extends Controller
{
    public function store(OilCheckStoreRequest $request) {

        $oilCheck = OilCheck::create($request->validated());

        return response()->json($oilCheck, 201);
    }
}
