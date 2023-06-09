<?php

namespace Database\Seeders;

use App\Models\AwbStatus;
use App\Models\Company;
use App\Models\CompanyShipmentType;
use Illuminate\Database\Seeder;

class AwbStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AwbStatus::create(['name'=>'prepare shipment','code'=>1,'description'=>'Description create shipemnt']);
        AwbStatus::create(['name'=>'Calling Receiver','code'=>9 , 'description'=>'courier calling receiver']);
        AwbStatus::create(['name'=>'delivered','code'=>10,'description'=>'shipment delivered to receiver']);
    }
}
