<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();

      $menus = [
            // parent_id = 1
            [
            'parent_id' => 0,
            'name'      => 'Dashboard',
            'icon'      => 'fa-home',
            'url'       => '/',
            'is_active' => true
            ]
        ];

        foreach ( $menus as $key => $data ) {
            Menu::create( $data );
        }
    }
}
