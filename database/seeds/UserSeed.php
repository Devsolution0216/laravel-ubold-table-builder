<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'customer_id' => '0',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123')
        ]);
        $user->assignRole('administrator');

    }
}
