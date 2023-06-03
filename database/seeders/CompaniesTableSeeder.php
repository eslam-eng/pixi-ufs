<?php

namespace Database\Seeders;

use App\Enums\ActivationStatus;
use App\Enums\ImportTypeEnum;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city_id = Location::withDepth()->having('depth', '=', 1)->first()->id; // المحافظات
        $area_id = Location::withDepth()->having('depth', '=', 2)->first()->id; //
        Company::create([
                'name'=>'UFS test',
                'email'=>'ufs@gmail.com',
                'ceo'=>'eslam',
                'phone'=>'01112322098',
                'show_dashboard'=>1,
                'status'=>ActivationStatus::ACTIVE(),
                'address'=>Str::random(20),
                'city_id'=>$city_id,
                'area_id'=>$area_id,
                'importation_type'=>ImportTypeEnum::AWBWITHOUTREFERENCE(),
            ]
        );
    }
}
