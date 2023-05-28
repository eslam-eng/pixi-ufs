<?php

namespace Database\Seeders;

use App\Models\AwbServiceType;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AwbServiceType::create(['name'=>'normal delivery']);

    }
}
