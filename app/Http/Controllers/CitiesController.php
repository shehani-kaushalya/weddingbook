<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Pages;
use App\Districts;
use App\Services\DistrictsService;
use App\Services\FileService;
use App\Services\RequestService;
use App\Services\UserService;
use DB;
use Illuminate\Http\Request;
use Redirect;

class CitiesController extends Controller
{

    public function __construct(UserService $userService, RequestService $requestService,
        DistrictsService $districtsService) {
        $this->userService = $userService;
        $this->requestService = $requestService;
        $this->districtsService = $districtsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("List category");
        $city_data['page'] = "City Listing";
        $cities_data = $this->districtsService->getAllCities();
        // print_r($cities_data);
        // exit;
        return view('admin.districts.city_list', compact('cities_data', 'city_data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd("Page creation");
        $city_data['page'] = "New page create";
        $districts_data = $this->districtsService->getAllDistricts();
        // print_r($districts_data);
        // exit;
        return view('admin.districts.city', compact('districts_data', 'city_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $cityId = $data['id'];

            if ($cityId != "") {

                $cityObj = Pages::find($cityId);

                if (@$data['name'] != "") {
                    $cityObj->name = $data['name'];
                }
                if (@$data['slug'] != "") {
                    $cityObj->slug = $data['slug'];
                }

                if (@$data['body'] != "") {
                    $cityObj->body = $data['body'];
                }

                if (@$data['meta_title'] != "") {
                    $cityObj->meta_title = $data['meta_title'];
                }

                if (@$data['meta_description'] != "") {
                    $cityObj->meta_description = $data['meta_description'];
                }

                if (@$data['meta_keywords'] != "") {
                    $cityObj->meta_keywords = $data['meta_keywords'];
                }

                if (@$data['meta_type'] != "") {
                    $cityObj->meta_type = $data['meta_type'];
                }

                if (@$data['status'] != "") {
                    $cityObj->status = $data['status'];
                }

                $cityObj->save();

                return Redirect::to('admin/pages')->with('success_message', 'City information sucessfully updated in the system');
            } 
            else {

                $districtObj = $this->districtsService->getCurrentDistrict($data['category_id']);

                if ($districtObj) {

                    if (@$data['upload'] != "") {

                        $img = FileService::save($data['upload'], "pages");
                        $img = "pages/" . $data['upload'];

                    } else {
                        $img = "";
                    }

                    $cityObj = Cities::firstOrNew([
                                            'district_id' => $data['category_id'],
                                            'name' => $data['name'],
                                            'description' => $data['description'],
                                            'image' => $img,
                                            'status' => $data['status'],
                                        ]);

                    $cityObj->save();
                    return Redirect::to('admin/city/list')->with('success_message', 'City sucessfully added in the system');
                }
                else {
                    return Redirect::back()->with('error_message', 'City already exist in the database');
                }
            }
        } 
        else {
            return Redirect::to('admin/pages/category')->with('success_message', 'City sucessfully updated in the system');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pages  $cities
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $cities)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pages  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $cities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pages  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pages $cities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pages  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pages $cities)
    {
        //
    }

    public function getCitiesData($id)
    {

        $cities_data = $this->districtsService->getCurrentCity($id);
        // $category_data = $this->districtsService->getAllCategories();
        $districts_data = $this->districtsService->getAllDistricts();
        // print_r($districts_data);
        $city_data['page'] = "Edit city";

        // print($cities_data->name);
        // exit;
        return view('admin.districts.city', compact('districts_data', 'cities_data', 'city_data'));

    }

    public function pageView($id)
    {
        $cities_data = $this->districtsService->getCurrentPage($id);
        $category_data = $this->districtsService->getAllCategories();
        $city_data['page'] = "Edit page";

        // print($cities_data->name);
        // exit;
        return view('admin.pages.page_view', compact('pages_data', 'page_data'));
    }

    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")
            ->where("district_id", $request->district_id)
            ->pluck("name", "id");
        return response()->json($cities);
    }

}