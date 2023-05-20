<?php

namespace Database\Seeders;

use App\Enums\ActivationStatus;
use App\Enums\UsersType;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company_id = Company::first()->id ;
        $department_id = Department::first()->id ;
        $branch_id = Branch::first()->id ;
        User::create([
            'name'=>'UFS test',
            'email'=>'ufs@gmail.com',
            'password'=>bcrypt('123456'),
            'phone'=>'01113622098',
            'type'=>UsersType::SUPERADMIN,
            'status'=>ActivationStatus::ACTIVE,
            'company_id'=>$company_id,
            'department_id'=>$department_id,
            'branch_id'=>$branch_id,
        ]);
    }
}
