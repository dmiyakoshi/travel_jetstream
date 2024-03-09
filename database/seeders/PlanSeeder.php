<?php

namespace Database\Seeders;

use App\Consts\PlanConst;
use App\Models\Hotel;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = Hotel::all();

        $counter = 0;
        $countMax = 3;

        foreach ($hotels as $hotel) {
            while ($counter < $countMax) {
                $counter++;
                Plan::create([
                    'title' => fake()->text(maxNbChars: 10),
                    'price' => fake()->randomNumber(1) * 1000 + fake()->randomNumber(1) * 100,
                    'description' => fake()->paragraph(),
                    'due_date' => Carbon::today()->addMonth(random_int(0, 10))->addDay(random_int(0, 20)),
                    'hotel_id' => $hotel->id,
                    'meal' => random_int(0, 3),//PlanConst::MEAL_LIST[random_int(PlanConst::MEAL_LIST[0], count(PlanConst::MEAL_LIST)-1)],
                    'status' => 1, // 公開状態
                ]);
            }
            $counter = 0;
        }
    }
}
