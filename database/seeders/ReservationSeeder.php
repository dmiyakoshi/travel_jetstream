<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $plans = Plan::all();
        $reservatioed_plans = [];

        $counter = 0;
        $countMax = 5;

        foreach ($users as $user) {
            while ($counter < $countMax) {
                $counter++;
                $flag =  false;
                $plan = null;// whileで作成したplanを入れる

                while ($flag == false) {
                    $plan = $plans[random_int(0, count($plans) - 1)];
                    
                    if ($counter == 0) {
                        $reservatioed_plans[] = $plan->id;
                    } else {
                        foreach ($reservatioed_plans as $reservatioed_plan_id) {
                            if ($reservatioed_plan_id == $plan->id) {
                                break;
                            }
                        }

                        // foreachでIDがかぶらなければflag切り替え breakなら作り直し
                        $flag =true;
                    }
                }

                

                Reservation::create([
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'company_id' => $plan->hotel()->first()->company()->first()->id,
                    'reservation_date' => fake()->dateTimeBetween(Carbon::today(), $plan->due_date)
                ]);
            }
        }
    }
}
