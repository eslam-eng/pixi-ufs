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
        AwbStatus::create(['name'=>'prepare shipment']);
    }
}
