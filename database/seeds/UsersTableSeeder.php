<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $users = [
            [
                'name' 		=> 'Super Admin',
                'email' 	=>'superadmin@tsanepal.com',
                'password' 	=>Hash::make('tsanepal123@123'),
                'roles' 	=> 'admin',
                'status' 	=>'Active',
            ],
            [
                'name' 		=> 'tsanepal admin',
                'email' 	=> 'info@tsanepal.com',
                'password' 	=> Hash::make('info@tsanepal'),
                'roles' 	=> 'admin',
                'status' 	=>'Active',
            ],
           
           [
               'name'      => 'tsanepal staff',
               'email'     => 'staff@tsanepal.com',
               'password'  => Hash::make('secret'),
               'roles'     => 'staff',
               'status'    =>'Active',
           ],

        ]; 
        DB::table('users')->insert($users); 
    }
}
