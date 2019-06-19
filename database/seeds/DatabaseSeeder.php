<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->insert([
            'description' 	=> 'Owner Of Application',
            'label' 		=> 'admin',
        ]);

        DB::table('roles')->insert([
            'description' 	=> 'Person Who Applies',
            'label' 		=> 'applicant',
        ]);
        
        DB::table('users')->insert([
            'email' 	=> 'admin@rareiio.com',
            'password' 	=> bcrypt('123456'),
            'roleId' 	=> 1,
        ]);
    }
}
