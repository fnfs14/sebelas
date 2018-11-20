<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu')->delete();
        
        \DB::table('menu')->insert(array (
            0 => 
            array (
                'id' => '5b2863b0-e813-11e8-9f9d-411cfa79b1b0',
                'judul' => 'Poster',
                'url' => 'poster',
                'parent' => NULL,
                'menu' => 'admin',
                'created_at' => now()
            ),
            1 => 
            array (
                'id' => '90c34680-eb54-11e8-a66a-fb1ea29487ca',
                'judul' => 'Berita',
                'url' => 'berita',
                'parent' => NULL,
                'menu' => 'admin',
                'created_at' => now()
            ),
            2 => 
            array (
                'id' => 'b5fa0c70-ea30-11e8-b5a9-5ba9770443e4',
                'judul' => 'File',
                'url' => 'file',
                'parent' => NULL,
                'menu' => 'admin',
                'created_at' => now()
            ),
        ));
        
        
    }
}