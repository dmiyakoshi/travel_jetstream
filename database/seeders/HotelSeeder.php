<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Hotel;
use App\Models\Prefecture;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companys = Company::all();
        $prefectures = Prefecture::all();

        // $names = ['HotelA','HotelB','HotelC','HotelD','HotelE','HotelF','HotelG','HotelH','HotelI','HotelJ','HotelK','HotelL',];

        $counter = 0;
        $countMax = 3;

        foreach ($companys as $company) {
            while ($counter < $countMax) {
                $counter++;
                Hotel::created(
                    [
                        'company_id' => $company->id,
                        'name' => $company->name,
                        'telephone' => fake()->phoneNumber(),
                        'description' => fake()->text(),
                        'adress' => fake()->address(),
                        'prefecture_id' => $prefectures[random_int(0, count($prefectures) -1)],
                        'capacity' => random_int(3, 15),
                    ]
                );
            }
        }
    }
}
