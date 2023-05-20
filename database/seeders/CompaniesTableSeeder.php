<?php

namespace Database\Seeders;

use App\Enums\ActivationStatus;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
                'name'=>'UFS test',
                'email'=>'ufs@gmail.com',
                'ceo'=>'eslam',
                'phone'=>'01112322098',
                'show_dashboard'=>1,
                'status'=>ActivationStatus::ACTIVE
            ]
        );
    }
}
