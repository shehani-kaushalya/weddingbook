<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Supplier::insert([ [
            'name' => 'AMAZON UK',
            'website' => 'www.amazon.co.uk',
            'logo' => 'b55e097e2c3c3e546d0d1c1c5bf880d4.png',
            'status' => \App\Supplier::ACTIVE
        ],

				 [
                'name' => 'EBAY',
                'website' => 'www.ebay.com',
                'logo' => '0a227bd04d08d408bb30b275ea416498.png',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'AMAZON INDIA',
                'website' => 'www.amazon.in',
                'logo' => '87d7134a9f3570733df645e7fc1c1e0d.png',
                'status' => \App\Supplier::ACTIVE,
            ],


            [
                'name' => 'SPORT SHOES UK',
                'website' => 'www.sportsshoes.com',
                'logo' => '03bec48af9a58d8907f25c647b997dd2.png',
                'status' => \App\Supplier::ACTIVE,
            ],

            [
                'name' => 'B&Q Club',
                'website' => 'www.diy.com',
                'logo' => '55dd3d856d4df17b7517cf27eacc06fc.png',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'CLARKS',
                'website' => 'www.clarks.co.uk',
                'logo' => 'c1ce507e5ec28eb076d7b0c74c1772fd.png',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'EURO CAR PARTS',
                'website' => 'www.eurocarparts.com',
                'logo' => '23df18aeadd4f73a7da242fb3e037fff.png',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'JOHN LEWIS',
                'website' => 'www.johnlewis.com',
                'logo' => '1ed7083c2ac4d7c0736510e34400ea4f.png',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'SPORTS DIRECT',
                'website' => 'www.sportsdirect.com',
                'logo' => 'f171b6968e11531861a528cf99bd8d5e.png',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'SMEG UK',
                'website' => 'www.smeguk.com',
                'logo' => '0c36ec09b3f7dd6360922a205cbeefd0.jpg',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'SUNGLASS HUT',
                'website' => 'www.sunglasshut.com/uk',
                'logo' => '212c20052a4ad284e107cae06319c72b.png',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'WATCHSHOP',
                'website' => 'www.watchshop.com',
                'logo' => 'a5c0f81b0afffee8167fe7c52bfd8989.png',
                'status' => \App\Supplier::ACTIVE,
            ],
            [
                'name' => 'MAMAS & PAPAS',
                'website' => 'www.mamasandpapas.com/en-gb',
                'logo' => 'aed090a9b6fac7ee0ebe6c2625ec6a79.png',
                'status' => \App\Supplier::ACTIVE,
            ],


				 ]

				);
    }
}
