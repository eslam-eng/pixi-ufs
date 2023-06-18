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

            //start locations permissions
           'locations'=>[
               'create_city',
               'edit_city',
               'delete_city',
               'view_city',
               'create_area',
               'edit_area',
               'delete_area',
               'view_area'
           ],

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
