<?php

namespace App\Services;

use App\Districts;
use App\Cities;
use App\User;

class DistrictsService
{
    public function createDistricts(array $data, $type)
    {
        // return Districts::create([
        //     'status' => User::ACTIVE,
        //     'name' => $data['first_name'],
        //     'description' => $data['last_name'],
        // ]);
         return Districts::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'status' => $type,
        ]);


    }

    public function getCurrentDistrict($id)
    {
        $current_category = Districts::find($id);
        return $current_category;
    }

    public function getAllDistricts()
    {
        $categories = Districts::all();
        return $categories;
    }

    public function setDeleteItem($id)
    {
        // print("Delete recored");
        // exit;
        $affectedRows = Districts::where('id', $id)->delete();
        return $affectedRows;
    }

    
    // ======================================================================


    public function createCities(array $data, $type)
    {
        return Cities::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'status' => $type,
        ]);
    }

    public function getAllCities()
    {
        $cities = Cities::with('district')->get();
        return $cities;
    }

    public function getCurrentCity($id)
    {
        $current_city = Cities::find($id);
        return $current_city;
    }

    public function setDeleteCityItem($id)
    {
        // print("Delete recored");
        // exit;
        $affectedRows = Cities::where('id', $id)->delete();
        return $affectedRows;
        
    }



}