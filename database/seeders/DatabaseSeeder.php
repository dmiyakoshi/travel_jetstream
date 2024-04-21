<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Company::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(HotelSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(PaiedPlanSeeder::class);

        // factoryはあまりうまくないかも seederでやったほうがよい
        // \App\Models\Reservation::factory(30)->create();
        // \App\Models\PaiedPlan::factory(10)->create();
    }
}
