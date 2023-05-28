<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\CompanyShipmentType;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShipmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();
        CompanyShipmentType::create(['company_id'=>$company->id,'name'=>'test shipment type','fixed_weight'=>'1', 'has_dimension'=>0]);
    }
}
