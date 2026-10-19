<?php

namespace Database\Factories;

use App\Models\OilCheck;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $odometer_at_last_change = $this->faker->numberBetween(1, 10000);
        return [
            'odometer_at_last_change' => $odometer_at_last_change,
            'current_odometer' => fake()->numberBetween($odometer_at_last_change, $odometer_at_last_change + 5000),
            'date_at_last_change' => fake()->dateTimeBetween('-1 year', 'yesterday')->format('Y-m-d'),
        ];
    }
}
