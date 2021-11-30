<?php

namespace App\Services;

use App\Sliders;

class SliderService
{
    public function createSlider(array $data, $type)
    {

        // print_r($data['description']);
        // print_r($type);
        // exit;

        return Sliders::create([
            'id' => $data['id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'is_default' => $type,
        ]);
    }

    public function getAllSliders()
    {
        $obJSliders = Sliders::all();
        return $obJSliders;
    }

    public function getSelectedSlider($id)
    {
        $obJSlider = Sliders::where('id', $id)->get();
        return $obJSlider;
    }

    public function setDeleteSliderItem($id)
    {
        // print("Delete recored");
        // exit;
        $affectedRows = Sliders::where('id', $id)->delete();
        return $affectedRows;
    }

}
