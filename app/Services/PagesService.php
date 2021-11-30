<?php

namespace App\Services;

use App\PageCategory;
use App\Pages;
use App\User;

class PagesService
{
    public function createPageCategory(array $data, $type)
    {
        return User::create([
            'status' => User::ACTIVE,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);
    }

    public function getCurrentCategroy($id)
    {
        $current_category = PageCategory::find($id);
        return $current_category;
    }

    public function getAllCategories()
    {
        $categories = PageCategory::all();
        return $categories;
    }

    public function setDeleteCategoryItem($id)
    {
        // print("Delete recored");
        // exit;
        $affectedRows = PageCategory::where('id', $id)->delete();
        return $affectedRows;
    }

    public function getAllPages()
    {
        $pages = Pages::all();
        return $pages;
    }

    public function getCurrentPage($id)
    {
        $current_page = Pages::find($id);
        return $current_page;
    }

}
