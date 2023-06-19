<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions =config('permissions.super_admin');

        $user = User::find(1);

        foreach($permissions as $key=>$permission)
        {
            foreach ($permission as $item){
                Permission::create(['group_name'=>$key,'name'=>$item]);
                $user->givePermissionTo($item);
            }
        }
    }
}
