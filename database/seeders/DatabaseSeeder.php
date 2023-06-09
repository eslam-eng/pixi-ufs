<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LocationsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ServiceTypesTableSeeder::class);
        $this->call(ShipmentTypesTableSeeder::class);
        $this->call(AwbStatusesTableSeeder::class);
        $this->call(PriceTableSeeder::class);
        $this->call(ReceiversTableSeeder::class);

    }
}
