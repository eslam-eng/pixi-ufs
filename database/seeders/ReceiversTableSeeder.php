<?php

namespace Database\Seeders;

use App\Enums\ActivationStatus;
use App\Enums\ImportTypeEnum;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Location;
use App\Models\Receiver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReceiversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city_id = Location::withDepth()->having('depth', '=', 1)->first()->id; // المحافظات
        $area_id = Location::withDepth()->having('depth', '=', 2)->first()->id; //
        $company_id = Company::first()->id;
        $branch_id = Branch::query()->where('company_id',$company_id)->first()->id;
        Receiver::create([
                'name'=>Str::random(10),
                'phone1'=>'01112622098',
                'phone2'=>01011111111,
                'receiving_company'=>'test receiving company',
                'receiving_branch'=>'receiving_branch',
                'company_id'=>$company_id,
                'branch_id'=>$branch_id,
                'address1'=>Str::random(20),
                'address2'=>Str::random(20),
                'city_id'=>$city_id,
                'area_id'=>$area_id,
                'reference'=>time(),
                'title'=>'test title',
                'notes'=>'test notes'
            ]
        );
    }
}
