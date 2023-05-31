<?php

namespace Database\Seeders;

use App\DTO\Awb\AwbDTO;
use App\Services\AwbService;
use Illuminate\Database\Seeder;

class AwbsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $awbDto = new AwbDTO(user_id: 1, branch_id: 1, department_id: 1, receiver_id: 1, receiver_data: 'test', payment_type: 1, service_type: 'service type', is_return: false, shipment_type: 'test shipment type', zone_price: 10, additional_kg_price: 0, custom_field1: 'test custom fields', weight: 1, pieces: 1, custom_field2: 'test note',collection: null,custom_field3: null,custom_field4: null,custom_field5: null);
        for ($start = 0; $start < 10; $start++) {
            app()->make(AwbService::class)->store($awbDto);

        }
    }
}

