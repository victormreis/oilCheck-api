<?php

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
});
