<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companys = Company::all();


        $names = ['HotelA','HotelB','HotelC','HotelD','HotelE','HotelF','HotelG','HotelH','HotelI','HotelJ','HotelK','HotelL',];

        foreach ($companys as $company) {
            Hotel::created(
                [
                    'company_id' => $company->id,
                    'name' => $names[$company->id],
                ]
                );
        }
    }
}
