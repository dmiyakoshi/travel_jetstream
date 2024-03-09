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

        $names = [
            'Oriental Tide Hotel', 'Private Dawn Hotel & Spa', 'Winter Gulf Resort', 'Snowy Maple Motel', 'Autumn Rose Resort', 'Bronze Bluff Hotel & Spa', 'Remote Heirloom Hotel & Spa', 'HotelQ', 'HotelR', 'HotelS', 'HotelT', 'HotelU', 'HotelF', 'HotelG', 'HotelH', 'HotelI', 'HotelJ', 'HotelK', 'HotelL', 'HotelP', 'HotelO', 'HotelE', 'HotelD', 'HotelC', 'HotelB', 'HotelA',
        ];

        $counter = 0;
        $countMax = 3;

        $capacity_min = 3;
        $capacity_max = 15;

        foreach ($companys as $company) {
            while ($counter < $countMax) {
                $counter++;
                Hotel::create(
                    [
                        'company_id' => $company->id,
                        'name' => $names[random_int(0, count($names) - 1)],
                        'phonenumber' => fake()->phoneNumber(),
                        'description' => fake()->text(),
                        'adress' => fake()->address(),
                        'prefecture_id' => $prefectures[random_int(0, count($prefectures) - 1)]->id,
                        'capacity' => random_int($capacity_min, $capacity_max),
                    ]
                );
            }
            $counter = 0;
        }
    }
}
