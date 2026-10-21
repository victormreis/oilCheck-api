<?php

use App\Models\OilCheck;

describe('OilCheck', function () {
    test('Should create a new oilCheck record', function () {
        $oilCheck = [
            'odometer_at_last_change' => 4500,
            'current_odometer' => 9000,
            'date_at_last_change' => '2026-01-01',
        ];

        $response = $this->postJson(route('oilCheck.store'), $oilCheck);

        $response->assertCreated();

        expect(OilCheck::count())->toBe(1);
    });

    test('Should reject current odometer greater than last odometer change when creating a oilCheck record', function () {
        $oilCheck = [
            'odometer_at_last_change' => 10500,
            'current_odometer' => 9000,
            'date_at_last_change' => '2026-01-01',
        ];
        $response = $this->postJson(route('oilCheck.store'), $oilCheck);
        $response->assertUnprocessable();
    });

    test('Should reject any today or future date_at_last_change when creating a oilCheck record', function () {
        $oilCheck = [
            'odometer_at_last_change' => 500,
            'current_odometer' => 5000,
            'date_at_last_change' => '2026-12-12',
        ];
        $response = $this->postJson(route('oilCheck.store'), $oilCheck);
        $response->assertUnprocessable();
    });

    test('Should return an oil check record with isDue field', function () {
        $oilCheck = OilCheck::factory()->create();

        $response = $this->getjson(route('oilCheck.show', $oilCheck));
        $response->assertOk();

        expect($oilCheck)->toBeInstanceOf(OilCheck::class);

        $response->assertJsonStructure([
            'isDue',
            'km_since_last_change',
            'days_since_last_change',
        ]);
    });

    test('Should return return a not found when an invalid id is given', function () {

        $response = $this->getjson(route('oilCheck.show', 1));
        $response->assertNotFound();
    });

});
