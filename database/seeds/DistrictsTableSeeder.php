<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Districts::insert([
            [
                'name' => "Colombo",
                'description' => "Colombo",
                'image' => "colombo.png",
                'status' => 100,

            ], [
                'name' => "Kandy",
                'description' => "Kandy",
                'image' => "kandy.png",
                'status' => 100,

            ], [
                'name' => "Galle",
                'description' => "Galle",
                'image' => "galle.png",
                'status' => 100,

            ], [
                'name' => "Ampara",
                'description' => "Ampara",
                'image' => "ampara.png",
                'status' => 100,

            ], [
                'name' => "Anuradhapura",
                'description' => "Anuradhapura",
                'image' => "anuradhapura.png",
                'status' => 100,

            ], [
                'name' => "Badulla",
                'description' => "Badulla",
                'image' => "badullav.png",
                'status' => 100,

            ], [
                'name' => "Batticaloa",
                'description' => "Batticaloa",
                'image' => "batticaloa.png",
                'status' => 100,

            ], [
                'name' => "Gampaha",
                'description' => "Gampaha",
                'image' => "gampaha.png",
                'status' => 100,

            ], [
                'name' => "Hambantota",
                'description' => "Hambantota",
                'image' => "hambantota.png",
                'status' => 100,

            ], [
                'name' => "Jaffna",
                'description' => "Jaffna",
                'image' => "jaffna.png",
                'status' => 100,

            ], [
                'name' => "Kalutara",
                'description' => "Kalutara",
                'image' => "kalutara.png",
                'status' => 100,

            ], [
                'name' => "Kegalle",
                'description' => "Kegalle",
                'image' => "kegalle.png",
                'status' => 100,

            ], [
                'name' => "Kilinochchi",
                'description' => "Kilinochchi",
                'image' => "Kilinochchi.png",
                'status' => 100,

            ], [
                'name' => "Kurunegala",
                'description' => "Kurunegala",
                'image' => "kurunegala.png",
                'status' => 100,

            ], [
                'name' => "Mannar",
                'description' => "Mannar",
                'image' => "mannar.png",
                'status' => 100,

            ], [
                'name' => "Matale",
                'description' => "Matale",
                'image' => "matale.png",
                'status' => 100,

            ], [
                'name' => "Matara",
                'description' => "Matara",
                'image' => "matara.png",
                'status' => 100,

            ], [
                'name' => "Moneragala",
                'description' => "Moneragala",
                'image' => "moneragala.png",
                'status' => 100,

            ], [
                'name' => "Mullativu",
                'description' => "Mullativu",
                'image' => "mullativu.png",
                'status' => 100,

            ], [
                'name' => "Nuwara Eliya",
                'description' => "Nuwara Eliya",
                'image' => "nuwara_eliya.png",
                'status' => 100,

            ], [
                'name' => "Polonnaruwa",
                'description' => "Polonnaruwa",
                'image' => "polonnaruwa.png",
                'status' => 100,

            ], [
                'name' => "Puttalam",
                'description' => "Puttalam",
                'image' => "puttalam.png",
                'status' => 100,

            ], [
                'name' => "Ratnapura",
                'description' => "Ratnapura",
                'image' => "ratnapura.png",
                'status' => 100,

            ], [
                'name' => "Trincomalee",
                'description' => "Trincomalee",
                'image' => "trincomalee.png",
                'status' => 100,

            ], [
                'name' => "Vavuniya",
                'description' => "Vavuniya",
                'image' => "vavuniya.png",
                'status' => 100,

            ]]);
    }
}