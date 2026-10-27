<?php

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('Validate oilcheck creation', function () {
   test('create an oilCheck record on database', function () {
       $data = [
           'current_odometer' => 6500,
           'odometer_at_last_change' => 1000,
           'date_at_last_change' => now()->subMonths(7)->format('Y-m-d'),
       ];

        $this->postJson(route('oilCheck.store'), $data)->assertCreated();


        assertDatabaseCount('oil_checks', 1);
   });
});
