<?php

use Illuminate\Database\Seeder;

class BusinessCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BusinessCategories::insert([
            [
                'name' => "Florist",
                'description' => "Florist Supplires",
                'image' => "253775e8c530a15d10b15c3c5c21939f.png",
                'status' => 100,

            ], [
                'name' => "Hotels",
                'description' => "Hotels Supplires",
                'image' => "253775e8c530a15d10b15c3c5c21939f.png",
                'status' => 100,

            ], [
                'name' => "Photographers",
                'description' => "Photography Supplires",
                'image' => "253775e8c530a15d10b15c3c5c21939f.png",
                'status' => 100,

            ], [
                'name' => "Salons",
                'description' => "Salons Supplires",
                'image' => "253775e8c530a15d10b15c3c5c21939f.png",
                'status' => 100,

            ], [
                'name' => "Cakes and Cards",
                'description' => "Cakes and Cards Supplires",
                'image' => "253775e8c530a15d10b15c3c5c21939f.png",
                'status' => 100,

            ],
        ]);
    }
}