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

});
