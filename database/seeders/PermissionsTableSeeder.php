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
        $permissions = [

            //start country permissions
           'locations'=>[
               'create_country',
               'edit_country',
               'delete_country',
               'view_country',
               'create_city',
               'edit_city',
               'delete_city',
               'view_city',
               'create_governorate',
               'edit_governorate',
               'delete_governorate',
               'view_governorate'
           ],
            //end country permissions


            //start settings permissions
            'settings'=>[
                'view_settings',
                'edit_general_settings',
                ],
            //end settings permissions

        ];
        $user = User::find(1);
        foreach($permissions as $key=>$permission)
        {
            foreach ($permission as $item){
                Permission::create(['guard_name'=>'web','group_name'=>$key,'name'=>$item]);
                $user->givePermissionTo($item);
            }
        }
    }
}
