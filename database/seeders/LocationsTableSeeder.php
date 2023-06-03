<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = $cities = [
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

        $parentNode =  Location::create([
            'title'=>"Egypt",
        ]);
        foreach ($cities as $city)
        {
            $childern = $parentNode->children()->create([
                'title'=>$city,
            ]);
            $childern->children()->create( [ 'title' => "$city ". 'areas']);
        }
    }
}
