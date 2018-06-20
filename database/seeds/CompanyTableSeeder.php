<?php

use Illuminate\Database\Seeder;
use App\Models\Master\Company;
class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('companies')->truncate();

    	Company::create([
    		'name' => 'WIT',
    		'address' => 'Bandung',
    		'phone' => '12345678',
    		'tax' => 0,
    		'npwp' => 0,
    	]);

    	Company::create([
    		'name' => 'Sabre',
    		'address' => 'Jakarta',
    		'phone' => '12345678',
    		'tax' => 0,
    		'npwp' => 0,
    	]);
    }
}
