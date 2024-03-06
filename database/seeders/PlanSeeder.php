<?php

namespace Database\Seeders;

use App\Consts\PlanConst;
use App\Models\Hotel;
use App\Models\Plan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            Plan::create([
                'name' => fake()->text(maxNbChars: 10),
                'title',
                'price',
                'description',
                'due_date' ,
                'hotel_id' => $hotels[random_int($hotels[0]->id, count($hotels))],
                'meal' => PlanConst::MEAL_LIST[random_int(PlanConst::MEAL_LIST[0], count(PlanConst::MEAL_LIST))],
                'status' => 1, // 公開状態
            ]);
        }
    }
}
