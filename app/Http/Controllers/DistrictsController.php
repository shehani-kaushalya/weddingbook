<?php

namespace App\Http\Controllers;

use App\Services\DistrictsService;
use App\Services\RequestService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Districts;
use DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(UserService $userService, RequestService $requestService,
        DistrictsService $districtsService) {
        $this->userService = $userService;
        $this->requestService = $requestService;
        $this->districtsService = $districtsService;
    }

    public function index()
    {
        // dd("List District");
        $district_data['page'] = "Districts Listing";
        $districts_data = $this->districtsService->getAllDistricts();
        // print_r($districts_data);
        // exit;
        return view('admin.districts.districts_list', compact('districts_data', 'district_data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd("Districts creation");
        $district_data['page'] = "New page create";
        $districts_data = $this->districtsService->getAllDistricts();
        // print_r($districts_data);
        // exit;
        return view('admin.districts.districts', compact('districts_data', 'district_data'));
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
            $districtsId = $data['id'];

            if ($districtsId != "") {
                $districtsObj = Districts::find($districtsId);

                if (@$data['name'] != "") {
                    $districtsObj->name = $data['name'];
                }
                if (@$data['description'] != "") {
                    $districtsObj->description = $data['description'];
                }
                if (@$data['status'] != "") {
                    $districtsObj->status = $data['status'];
                }

                if (@$data['upload'] != "") {

                    $districtsObj->image = $data['upload'];
                    $img = FileService::save($districtsObj->image, "districts");
                    $districtsObj->image = "districts/" . $img;
                    $districtsObj->image = $img;

                }

                $districtsObj->save();
                
                return Redirect::to('admin/districts/list')->with('success_message', 'District sucessfully updated in the system');

            } else {

                $districts = Districts::where('name', $data['name'])->first();
                $districtsObj = Districts::find($districts['id']);

                if (!$districtsObj) {

                    if (@$data['upload'] != "") {

                        $img = FileService::save($data['upload'], "pages");
                        $data['image'] = "districts/" . $data['upload'];

                    } else {
                        $img = "";
                    }

                    $districtsObj = Districts::firstOrNew(
                        [
                            'name' => $data['name'],
                            'description' => $data['description'],
                            'image' => $img,
                            'status' => $data['status'],
                        ]);
                    // print("-----------------------------------------");
                    // print_r($districtsObj);
                    // print("==========================================");
                    // exit;

                    $districtsObj->save();
                    return Redirect::to('admin/pages/category/list')->with('success_message', 'Districts sucessfully added in the system');

                } else {
                    // print("Districts exist");
                    // print_r($data);
                    // exit;
                    return Redirect::to('admin/pages/category/list')->with('error_message', 'Districts already exist in the database');
                }

                // print_r("=======================================");
                // exit;

            }

        } else {

            return Redirect::to('admin/pages/category')->with('success_message', 'Districts sucessfully updated in the system');

        }


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

    public function getDistricData($id)
    {

        $districts_data = $this->districtsService->getCurrentDistrict($id);
        $districts_data['page'] = "Edit district create";
        return view('admin.districts.districts')->with('districts_data', $districts_data);

    }

    

}