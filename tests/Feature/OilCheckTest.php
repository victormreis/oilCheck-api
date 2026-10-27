<?php

use App\Models\OilCheck;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('Validate oil Check creation', function () {
   test('create an oilCheck record on database', function () {
       $data = [
           'current_odometer' => 6500,
           'odometer_at_last_change' => 1000,
           'date_at_last_change' => now()->subMonths(7)->format('Y-m-d'),
       ];

        $this->postJson(route('oilCheck.store'), $data)->assertCreated();


        assertDatabaseCount('oil_checks', 1);
   });

   test('should return a 422 for current odometer lower than odometer at last change', function () {
       $data = [
           'current_odometer' => 5000,
           'odometer_at_last_change' => 10000,
           'date_at_last_change' => now()->subMonths(7)->format('Y-m-d'),
       ];

       $this->postJson(route('oilCheck.store'), $data)->assertUnprocessable();

       assertDatabaseCount('oil_checks', 0);

   });

   test('return a oilCheck status within id', function () {
       $oilCheck = OilCheck::factory()->create();

       assertDatabaseCount('oil_checks', 1);

       $response = $this->getJson(route('oilCheck.show', $oilCheck))->assertOk();


   });
});
