<?php

use Illuminate\Database\Seeder;

use Sentinel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('activations')->truncate();
        DB::table('persistences')->truncate();
        DB::table('reminders')->truncate();
        DB::table('role_users')->truncate();
        DB::table('throttle')->truncate();
        DB::table('users')->truncate();

        $datas = [
            'email' => 'electra@mailinator.com',
            'first_name' => 'Administrator',
            'last_name' => '',
            'role' => 'super-admin',
            'address' => 'Wisma KEIAI, 22nd Floor  Jl. Jend. Sudirman Kav. 3 Jakarta 10210. Indonesia ',
            'phone'   => '622157905788',
            'status' => 1
        ];

        $user = Sentinel::registerAndActivate( [
                'email' => $data[ 'email' ],
                'password' => User::DEFAULT_PASSWORD,
                'first_name' => $data[ 'first_name' ],
                'last_name' => $data[ 'last_name' ],
                'gender' => $data[ 'gender' ],
                'phone' => $data[ 'phone' ],
                'address' => $data[ 'address' ],
                'status' => 1
                ] );
            Sentinel::findRoleBySlug( $data[ 'role' ] )->users()->attach( $user );
        
        Schema::enableForeignKeyConstraints();
    }
}
