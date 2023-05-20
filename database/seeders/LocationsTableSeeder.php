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

        $node = Location::create([
            'title' => 'Egypt',
            'children' => [
                [
                    'title' => 'Cairo',
                    'children' => [
                        [ 'title' => 'naser city'],
                    ],
                ],
                [
                    'title' => 'Giza',
                    'children' => [
                        [ 'title' => 'ramsis'],
                    ],
                ],
            ],
        ]);
    }
}
