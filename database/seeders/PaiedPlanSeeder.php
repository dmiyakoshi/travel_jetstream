<?php

namespace Database\Seeders;

use App\Models\PaiedPlan;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaiedPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = Reservation::all();
    
        foreach ($reservations as $reservation) {
            $randomInt = random_int(0, 1);

            if($randomInt == 1) {
                PaiedPlan::create([
                    'reservation_id' => $reservation->id,
                ]);
            } else {
                // none
            }
        }
    }
}
