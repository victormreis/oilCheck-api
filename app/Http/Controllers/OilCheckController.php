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

    public function check(OilCheck $oilCheck)
    {
        $kmSinceLastChange = $oilCheck->current_odometer - $oilCheck->odometer_at_last_change;
        $daysSinceLastChange = $oilCheck->date_at_last_change->diffInDays(today());
        $isDue = ($daysSinceLastChange > 180) || ($kmSinceLastChange > 5000);

        return response()->json([
            ...$oilCheck->toArray(),
            'days_since_last_change' => $daysSinceLastChange,
            'km_since_last_change' => $kmSinceLastChange,
            'isDue' => $isDue,
        ]);
    }
}
