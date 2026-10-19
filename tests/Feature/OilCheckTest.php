<?php

test('Create a OilCheck record on database', function () {

    $oilCheck = [
        'current_odometer' => 6500,
        'odometer_at_last_change' => 5000,
        'date_at_last_change' => '2026-01-01'
    ];
    $response = $this->postJson(route('oilcheck.store', $oilCheck));

    $this->assertDatabaseCount('oil_checks', 1);

    $response->assertStatus(201);

    expect($response->getData())->toHaveKeys(['odometer_at_last_change', 'date_at_last_change', 'current_odometer']);

});

