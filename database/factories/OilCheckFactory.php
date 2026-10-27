<?php

namespace Database\Factories;

use App\Models\OilCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OilCheck>
 */
class OilCheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $odometer = random_int(1, 15000);
        return [
            'odometer_at_last_change' => $odometer,
            'current_odometer' => $odometer + random_int($odometer, 15000),
            'date_at_last_change' => now()->submonths(rand(1, 12)),
        ];
    }
}
