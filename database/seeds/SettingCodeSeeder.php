<?php

use Illuminate\Database\Seeder;
use App\Models\System\SettingCode;

class SettingCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('setting_codes')->truncate();

        SettingCode::insert([
        	[
        		'name' => 'Supplier',
        		'type' => 'SUP'
        	],
        	[
        		'name' => 'Tour Order',
        		'type' => 'TO'
        	]
        ]);
    }
}
