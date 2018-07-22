<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //inserting first admin
    	DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@kvisko.com', 
                'password' => '$2y$10$XugKMhUXHt0xLIv48Xgy9OVkpe7c6u019TeOs0iD5rOoEGWYfUmRK', 
                'active' => 1,
                'remember_token' => '',
                'is_admin' => 1
            ]
        ]);

    }
}

