<?php

namespace Database\Seeders;

use App\Enums\AwbStatuses;
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
        AwbStatus::create(['name'=>'prepare shipment','code'=>AwbStatuses::CREATE_SHIPMENT->value,'description'=>'Description create shipemnt']);
        AwbStatus::create(['name'=>'Calling Receiver','code'=>AwbStatuses::CALLING_RECEIVER->value , 'description'=>'courier calling receiver']);
        AwbStatus::create(['name'=>'delivered','code'=>AwbStatuses::DELIVERED->value,'description'=>'shipment delivered to receiver']);
    }
}
