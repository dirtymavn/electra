<?php

use Illuminate\Database\Seeder;

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
            'email' => $datas[ 'email' ],
            'password' => '12345678',
            'first_name' => $datas[ 'first_name' ],
            'last_name' => $datas[ 'last_name' ],
            'username' => 'superadmin',
            'status' => 1,
            'company_role' => 'super-admin'
        ] );
        Sentinel::findRoleBySlug( $datas[ 'role' ] )->users()->attach( $user );

        $users = array(
            // array(
            //     'email' => 'wit2@mailinator.com',
            //     'first_name' => 'Ilham',
            //     'last_name' => 'Ilham',
            //     'role' => 'subscriber-2',
            //     'address' => 'Wisma KEIAI, 22nd Floor  Jl. Jend. Sudirman Kav. 3 Jakarta 10210. Indonesia ',
            //     'phone'   => '622157905788',
            //     'username' => 'wit2',
            //     'status' => 1,
            //     'company_id' => 2
            
            // ),
            // array(
            //     'email' => 'wit1@mailinator.com',
            //     'first_name' => 'Arya',
            //     'last_name' => 'Nugraha',
            //     'role' => 'subscriber-1',
            //     'address' => 'Wisma KEIAI, 22nd Floor  Jl. Jend. Sudirman Kav. 3 Jakarta 10210. Indonesia ',
            //     'phone'   => '622157905788',
            //     'username' => 'wit1',
            //     'status' => 1,
            //     'company_id' => 1
                
            // ),
            array(
                'email' => 'adminwit@mailinator.com',
                'first_name' => 'Admin',
                'last_name' => 'WIT',
                'role' => 'admin',
                'username' => 'adminwit',
                'address' => 'Wisma KEIAI, 22nd Floor  Jl. Jend. Sudirman Kav. 3 Jakarta 10210. Indonesia ',
                'phone'   => '622157905788',
                'status' => 1,
                'company_id' => 1,
                'company_role' => 'admin'
                
            ),
            array(
                'email' => 'adminsabre@mailinator.com',
                'first_name' => 'Admin',
                'last_name' => 'Sabre',
                'role' => 'admin',
                'username' => 'adminsabre',
                'address' => 'Wisma KEIAI, 22nd Floor  Jl. Jend. Sudirman Kav. 3 Jakarta 10210. Indonesia ',
                'phone'   => '622157905788',
                'status' => 1,
                'company_id' => 2,
                'company_role' => 'admin'
                
            ),
        );

        foreach ($users as $user) {
            $sentinel = Sentinel::registerAndActivate([
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'username' => $user['username'],
                'status' => 1,
                'password' => '12345678',
                'company_id' => $user['company_id'],
                'company_role' => $user['company_role']
            ]);

            Sentinel::findRoleBySlug( $user[ 'role' ] )->users()->attach( $sentinel );
        }
        
        Schema::enableForeignKeyConstraints();
    }
}
