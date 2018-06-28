<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('role_users')->truncate();
        DB::table('roles')->truncate();

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'super-admin',
            'name' => 'Super Administrator',
            'permissions' => [
                'admin' => true
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'admin',
            'name' => 'Administrator',
            'permissions' => [
                'admin.company' => true
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'subscriber',
            'name' => 'Subscriber',
            'permissions' => [],
        ]);

    }
}
