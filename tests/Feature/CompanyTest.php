<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Master\Company;
use DB;
use Sentinel;

class CompanyTest extends TestCase
{

	private $admin;
	private $company;
	private $data;

	protected function prepare()
	{
		$user = Sentinel::findById(1);
		$this->admin = Sentinel::login($user);
		// $company = Company::create([
		// 	'name' => 'WIT',
		// 	'address' => 'Bandung',
		// 	'phone' => '082219230981',
		// 	'tax' => '2321312',
		// 	'npwp' => '321343',
		// ]);

		// $this->company = $company;
	}

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
    	$this->prepare();
    	$actual = $this->call('GET', 'system/company');

    	$actual->assertStatus(200);
    }
}
