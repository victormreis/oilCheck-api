<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOilCheckRequest;
use App\Http\Requests\UpdateOilCheckRequest;
use App\Models\OilCheck;

class OilCheckController extends Controller
{




    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOilCheckRequest $request)
    {
        $oilCheck = OilCheck::create($request->all());

        return response()->json(['oilCheck' => $oilCheck], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(OilCheck $oilCheck)
    {


    }
}
