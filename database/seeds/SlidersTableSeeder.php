<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Sliders::insert([

            [
                'image' => 'slider_banner.png',
                'title' => 'My Wedding Book',
                'description' => 'My Weddingbook Manager',
                'is_default' => 1,
            ],
            [
                'image' => 'slider_wedding_show.png',
                'title' => 'My Wedding Book',
                'description' => 'My Weddingbook Manager',
                'is_default' => 1,
            ],
            [
                'image' => 'slider_wedding_couple.png',
                'title' => 'My Wedding Book',
                'description' => 'My Weddingbook Manager',
                'is_default' => 1,
            ],
        ]);
    }
}