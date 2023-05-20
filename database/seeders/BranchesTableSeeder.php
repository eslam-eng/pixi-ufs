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
        $company_id = Company::first()->id ;
      $branch =   Branch::create([
            'name' => 'branch 1 test',
            'company_id' => $company_id,
            'phone'=>'01113622098'
        ]);

        $city_id = Location::withDepth()->having('depth', '=', 1)->first()->id; // المحافظات
        $area_id = Location::withDepth()->having('depth', '=', 2)->first()->id; //
      $branch->storeAddress([
          'city_id' => $city_id,
          'area_id' => $area_id,
          'address' => Str::random(10),
          'lat' => 12121.1212,
          'lng' =>12121.1212,
          'postal_code' => 12345,
          'is_default' => true
      ]);
    }
}
