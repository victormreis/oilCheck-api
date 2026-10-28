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

    public function show(OilCheck $oilCheck) {

        $kmSinceLastchange = $oilCheck->current_odometer - $oilCheck->odometer_at_last_change;
        $daysSinceLast = $oilCheck->date_at_last_change->diffInDays(today());
        $isDueForOilChange = ($daysSinceLast > 180) || ($kmSinceLastchange > 5000);
        $km_remaining = 5000 - $kmSinceLastchange;

        return response()->json([
            ...$oilCheck->toArray(),
            'date_at_last_change'=> $oilCheck->date_at_last_change->format('Y-m-d'),
            'km_since_last_change' => $kmSinceLastchange,
            'days_since_last_change' => $daysSinceLast,
            'km_remaining' => max($km_remaining, 0),
            'days_remaining' => 180 - $daysSinceLast,
            'is_due_for_oil_change' => $isDueForOilChange,

        ]);
    }
}
