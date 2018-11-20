<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@sebelas.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$NuoafArN62d.ctiQNVmhqeyMxjULFVlkIcEeEA8eTu9HmN0hQJ8Pq',
                'remember_token' => NULL,
                'created_at' => now()
            ),
        ));
        
        
    }
}