<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\User', 5)->create();
        $admin = factory('App\User')->states('silnex')->create();
        $role = Role::create(['name' => 'Admin']);
        $admin->assignRole($role);
    }
}
