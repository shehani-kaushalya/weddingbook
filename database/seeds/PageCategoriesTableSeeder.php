<?php

use Illuminate\Database\Seeder;

class PageCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\PageCategory::insert(
        [
            'name' => "Main",
            'description' => "Main Category",
            'image' => "253775e8c530a15d10b15c3c5c21939f.png",
            'status' => 100
         
        ]);
    }
}
