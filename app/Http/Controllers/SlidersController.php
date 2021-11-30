<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\FileService;
use App\Services\RequestService;
use App\Services\SliderService;
use App\Services\UserService;
use App\Sliders;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;

class SlidersController extends Controller
{

    public function __construct(UserService $userService, RequestService $requestService,
        SliderService $sliderService) {
        $this->requestService = $requestService;
        $this->sliderService = $sliderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        print("Slider Uploading ..... <br/>");
        $data = $request->all();

        DB::connection()->enableQueryLog();

        if ($request->isMethod('post')) {

            $data['title'] = $data['title'];
            $data['description'] = $data['description'];

            if (@$data['upload'] != "") {

                $data['image'] = $data['upload'];
                $img = FileService::save($data['image'], "sliders");

                if ($img == false) {
                    return Redirect::to('admin/sliders')->with('error_message', 'New Slider Image not added retry again');

                } else {
                    $data['image'] = "sliders/" . $img;
                    $data['image'] = $img;

                    $sliders = $this->sliderService->createSlider($data, Sliders::UPLOADED);
                    return Redirect::to('admin/sliders')->with('error_message', 'New Slider Image added');

                }

            } else {
                die("Unauthorise access");
            }

        } else {
            die("Unauthorise access");
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sliders()
    {

        $sliders_data = $this->sliderService->getAllSliders();
        // print_r($sliders_data);
        // exit;
        return view('admin.sliders.sliders', compact('sliders_data'));

    }

    public function slider_delete($id)
    {
        $location = 'sliders';
        $sliders_data = $this->sliderService->getSelectedSlider($id);
        $imageFile = $sliders_data['0']['image'];
        $sliderItemData = FileService::fileExist($imageFile, $location);
        // print_r($sliderItemData);
        // exit;

        if ($sliderItemData == true) {
            $this->sliderService->setDeleteSliderItem($id);
            return Redirect::to('admin/sliders');
        } else {
            // $this->sliderService->setDeleteSliderItem($id);
            // return Redirect::to('admin/sliders');
            dd("Unauthorise file deleetion");
        }

    }

}