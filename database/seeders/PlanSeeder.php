<?php

namespace Database\Seeders;

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
                'due_date',
                'hotel_id',
                'meal',
                'status',
            ]);
        }
    }
}
