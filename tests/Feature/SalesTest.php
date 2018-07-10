<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use DB;
use Sentinel;

class SalesTest extends TestCase
{
	private $admin;
	private $company;
	private $data;

	protected function prepare()
	{
		$user = Sentinel::findById(1);
		$this->admin = Sentinel::login($user);
	}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
    	$this->prepare();

    	$insert = Sales::create( $request->all() );
    	$actual->assertStatus(200);
    }
}
