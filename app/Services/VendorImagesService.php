<?php

namespace App\Services;

use App\VendorImages;

class VendorImagesService
{
    public function createVendorImages(array $data, $type)
    {

        // print_r($data['description']);
        // print_r($type);
        // exit;

        return VendorImages::create([
            'vendor_id' => $data['vendor_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'is_default' => $type,
        ]);
    }

    public function getAllVendorImages()
    {
        $obJVendorImages = VendorImages::all();
        return $obJVendorImages;
    }

    public function getSelectedVendorImages($id)
    {
        $obJVendor = VendorImages::where('vendor_id', $id)->get();
        return $obJVendor;
    }

    public function setDeleteVendorImagesItem($id)
    {
        // print("Delete recored");
        // exit;
        $affectedRows = VendorImages::where('id', $id)->delete();
        return $affectedRows;
    }

}