<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::query()->paginate(10);

        return response()->json($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->validated());

        return response()->json($vehicle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return response()->json($vehicle);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return response()->json(null, 204);
    }
}
