<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOilCheckRequest;
use App\Models\OilCheck;
class OilCheckController extends Controller
{
    //
    public function store(StoreOilCheckRequest $request)
    {
       $oilCheck =  OilCheck::create($request->validated());

        return response()->json($oilCheck, 201);
    }
}
