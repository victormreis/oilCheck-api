<?php

use App\Models\Vehicle;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('Vehicle Controller Test', function () {
   test('it creates a vehicle record', function () {
       $data = [
           'brand' => 'honda',
           'model' => 'civic',
           'year' => 2025,
       ];

       $response = $this->postJson(route('vehicles.store'), $data);

       $response->assertCreated();

       $this->assertDatabaseHas('vehicles', $data);

       $response->assertJsonStructure([
           'id',
           'brand',
           'model',
           'year',
       ]);
   });
   test('it throws a 422 for when invalid data is provided', function () {
       $data = [
           'brand' => 'honda',
           'model' => 'civic',
       ];
       $response = $this->postJson(route('vehicles.store'), $data);
       $response->assertUnprocessable();

       $this->assertDatabaseCount('vehicles', 0);
   });
   test('it return a list of vehicles', function () {
       Vehicle::factory()->count(20)->create();

       $this->getJson(route('vehicles.index'))->assertOk();

       assertDatabaseCount('vehicles',20);

   });
   test('it shows a paginated response', function () {
       vehicle::factory()->count(20)->create();
      $response = $this->getJson(route('vehicles.index'))->assertOk();
      assertDatabaseCount('vehicles',20);

      $response->assertJsonCount(10, 'data');

   });
   test('it return a single vehicle', function () {
       $vehicle = Vehicle::factory()->create();
       $this->getJson(route('vehicles.show', $vehicle))->assertOk();
       assertDatabaseCount('vehicles', 1);
       assertDatabaseHas('vehicles', $vehicle->toArray());

   });
   test('it deletes a vehicle', function () {
       $vehicle = Vehicle::factory()->create();
       $this->deleteJson(route('vehicles.destroy', $vehicle))->assertNoContent();

       $this->assertDatabaseMissing('vehicles', $vehicle->toArray());

       $this->assertDatabaseCount('vehicles', 0);
   });
});
