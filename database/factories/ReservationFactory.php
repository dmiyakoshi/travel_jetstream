<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $plans = Plan::all();
        
        return [
            'user_id' => $users,
            'plan_id' => $plan = $plans[random_int(0, count($plans))],
            'company_id' => $plan->hotel()->first()->company()->get()->id,
            'reservation_date'
        ];
    }
}
