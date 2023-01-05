<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'package_id' => rand(1,10),
            'user_id' => rand(1,10),
            'schedule' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
            'quantity' => rand(1,10),
        ];
    }
}
