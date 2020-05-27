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
        $role->role = 'admin';
        $role->description = 'Administrator';
        $role->save();
        $role = new Role();
        $role->role = 'owner';
        $role->description = 'Owner';
        $role->save();
        $role = new Role();
        $role->role = 'tennant';
        $role->description = 'Tennant';
        $role->save();
    }
}
