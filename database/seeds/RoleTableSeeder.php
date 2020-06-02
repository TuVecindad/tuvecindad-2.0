<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $role = new Role();
        $role->name = 'superadmin';
        $role->description = 'Super Administrator';
        $role->save();
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();
        $role = new Role();
        $role->name = 'owner';
        $role->description = 'Owner';
        $role->save();
        $role = new Role();
        $role->name = 'tennant';
        $role->description = 'Tennant';
        $role->save();
    }
}
