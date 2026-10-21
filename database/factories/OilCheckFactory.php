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
        $LAST_ODOMETER = rand(0, 1000);
        return [
            'odometer_at_last_change' => $LAST_ODOMETER,
            'current_odometer' => rand($LAST_ODOMETER, $LAST_ODOMETER) + 10000,
            'date_at_last_change' => fake()->date(now()->subMonths(rand(3,12)))
        ];
    }
}
