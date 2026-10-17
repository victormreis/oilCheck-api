<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOilCheckRequest;
use App\Models\OilCheck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OilCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOilCheckRequest $request)
    {
        $oilCheck = OilCheck::create($request->validated());

        return response()->json($oilCheck, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(OilCheck $oilCheck)
    {
        $kmSinceLastChange = $oilCheck->current_odometer - $oilCheck->odometer_at_previous;
        $daysSinceLastChange = (int)$oilCheck->previous_oil_change_date->diffInDays(now());
        $isDueForOilChange = ($kmSinceLastChange > 5000) || ($daysSinceLastChange > 180);

        return response()->json([
            'id' => $oilCheck->id,
            'currentOdometer' => $oilCheck->current_odometer,
            'odometerAtPreviousChange' => $oilCheck->odometer_at_previous,
            'lastChangeDate' => $oilCheck->previous_oil_change_date->format('Y-m-d'),
            'isDueForOilChange' => $isDueForOilChange,
            'daysSinceLastChange' => $daysSinceLastChange,
            'kmSinceLastChange' => $kmSinceLastChange,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OilCheck $oilCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OilCheck $oilCheck)
    {
        //
    }
}
