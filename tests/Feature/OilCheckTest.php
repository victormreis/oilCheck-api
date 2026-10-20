<?php

use App\Models\OilCheck;

describe('Create Oil Check', function () {
    test('Create a OilCheck record on database', function () {

        $oilCheck = [
            'current_odometer' => 6500,
            'odometer_at_last_change' => 5000,
            'date_at_last_change' => '2026-01-01'
        ];
        $response = $this->postJson(route('oilcheck.store'), $oilCheck);

        $this->assertDatabaseCount('oil_checks', 1);

        $response->assertStatus(201);

        expect($response->getData())->toHaveKeys(['odometer_at_last_change', 'date_at_last_change', 'current_odometer']);
    })->skip();

    test('Should return validation error when a required data is wrong or missing', function () {
        $oilCheck = [
            'current_odometer' => 500,
            'odometer_at_last_change' => 5000,
            'date_at_last_change' => now()->addMonths(2)->format('Y-m-d')
        ];

        $response = $this->postJson(route('oilcheck.store'), $oilCheck);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['current_odometer', 'date_at_last_change']);
    });

    test('should check if a vehicle is due for oil change', function () {
        $oilCheck = OilCheck::factory()->create([
            'current_odometer' => 6500,
            'odometer_at_last_change' => 0,
            'date_at_last_change' => '2026-01-01'
        ]);

        $response = $this->getJson(route('oilcheck.check', ['oilCheck' => $oilCheck]));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'isDue',
            'km_since_last_change',
            'days_since_last_change',
        ]);

        $response->assertJson([
            'isDue' => true,
            'days_since_last_change' => $oilCheck->date_at_last_change->diffInDays(today()),
            'km_since_last_change' => $oilCheck->current_odometer - $oilCheck->odometer_at_last_change,
        ]);
    });
});
