<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PageCategoriesTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(BusinessCategoriesTableSeeder::class);

    }
}