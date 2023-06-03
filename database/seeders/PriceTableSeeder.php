<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Location;
use App\Models\PriceTable;
use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first()?->id;
        $base_city = Location::query()->where('title', "cairo")->first()->id;
        $cities = [
            'Cairo',
            'New Cities',
            'Alex',
            'Delta Cities',
            'Canal Cities',
            'Upper Egypt 1',
            'Upper Egypt 2',
            'Upper Egypt 3',
            'North Sinaa',
            'South Sinaa',
            'Remote Area Cairo',
            'Remote Area Delta Cities',
            'Remote Area Canal Cities',
            'Remote Area Alex',
            'Remote Area Upper Egypt',
            'Other'
        ];
        foreach ($cities as $city)
        {

            $location_to = Location::query()->where('title',$city)->first()->id;
            PriceTable::create(
                [
                    'company_id' => $company,
                    'location_from' => $base_city,
                    'location_to'=>$location_to,
                    'price'=>30,
                    'basic_kg'=>1,
                    'additional_kg_price'=>5,
                    'return_price'=>3,
                    'special_price'=>40
                ]
            );
        }
    }
}
