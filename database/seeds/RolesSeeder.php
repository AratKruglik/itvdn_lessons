<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create(['name' => 'Administrator', 'slug' => 'administrator']);
        \App\Role::create(['name' => 'User', 'slug' => 'user']);
    }
}
