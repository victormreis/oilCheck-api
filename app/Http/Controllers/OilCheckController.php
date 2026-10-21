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
        $kmSinceLastChange = $oilCheck->current_odometer - $oilCheck->odometer_at_last_change;
        $daysSinceLastChange = $oilCheck->date_at_last_change->diffInDays(today());
        $isDue = ($kmSinceLastChange > 5000) || ($daysSinceLastChange > 180);


        return response()->json([
            ...$oilCheck->toArray(),
            'isDue' => $isDue,
            'km_since_last_change' => $kmSinceLastChange,
            'days_since_last_change' => $daysSinceLastChange,
        ]);

    }
}
