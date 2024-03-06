<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $names = ['HotelA','HotelB','HotelC','HotelD','HotelE','HotelF','HotelG','HotelH','HotelI','HotelJ','HotelK','HotelL',];

        foreach ($companys as $company) {
            Hotel::created(
                [
                    'company_id' => $company->id,
                    'name' => $names[$company->id],
                    'telephone' => fake()->phoneNumber(),
                    'description' => fake()->text(),
                    'adress'=> fake()->address(),
                    'prefecture_id' => $prefectures[random_int($prefectures[0]->id, count($prefectures))],
                    'capacity' => random_int(3, 10),
                ]
                );
        }
    }
}
