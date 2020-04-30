<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'User']);
        $role->givePermissionTo('users');

        $role = Role::create(['name' => 'Administrator']);
        $role->givePermissionTo('users_manage');
    }
}
