<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city_id = Location::withDepth()->having('depth', '=', 1)->first()->id; // المحافظات
        $area_id = Location::withDepth()->having('depth', '=', 2)->first()->id; //
        $company_id = Company::first()->id;
        Branch::create([
            'name' => 'branch 1 test',
            'company_id' => $company_id,
            'phone' => '01113622098',
            'address' => Str::random(20),
            'city_id' => $city_id,
            'area_id' => $area_id,
        ]);
    }
}
