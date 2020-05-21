<?php

use App\Permissions;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Permissions();
        $role->role = 'admin';
        $role->description = 'Administrator';
        $role->save();
        $role = new Permissions();
        $role->role = 'owner';
        $role->description = 'Owner';
        $role->save();
        $role->role = 'tennant';
        $role->description = 'Tennant';
        $role->save();
    }
}
