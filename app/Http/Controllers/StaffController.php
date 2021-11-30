<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CustomerAddressService;
use App\Services\FileService;
use App\Services\RequestService;
use App\Services\StaffService;
use App\Services\UserService;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class StaffController extends Controller
{

    public function __construct(UserService $userService, RequestService $requestService,
        CustomerAddressService $customerAddressService, StaffService $staffService) {
        $this->userService = $userService;
        $this->requestService = $requestService;
        $this->customerAddressService = $customerAddressService;
        $this->staffService = $staffService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // print("List staff members");
        $staff_users['page'] = "Member List";
        $staff_users = $this->userService->getAllStaffUsers();
        // print_r($list_users);
        // exit;
        return view('admin.staff.staff_list')->with('staff_users', $staff_users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff_users['page'] = "New Staff Member";
        return view('admin.staff.staff')->with('staff_users', $staff_users);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactive()
    {
        //

        print("deactive");
        exit;

    }

    public function getEditStaffData($id)
    {

        $staff_data = $this->userService->getCurrentUsers($id);
        $staff_data['page'] = "Edit Staff Member";

        // print_r($staff_users);
        // exit;

        return view('admin.staff.staff')->with('staff_data', $staff_data);
    }

    /**
     * Does something interesting
     *
     * @param Array
     *
     * @throws Some_Exception_Class If something interesting cannot happen
     * @author Shehani Kaushalya <shehani.liyanaarachchige@gmail.com>
     * @return Status
     **/

    public function postStaffData(Request $request)
    {

        // print_r($request);
        // exit;

        DB::connection()->enableQueryLog();

        if ($request->isMethod('post')) {

            $data = $request->all();
            $userId = $data['id'];

            // print_r($data);
            // exit;

            if ($userId != "") {

                // print("Edit Section");
                // exit;

                $users = User::where('email', $data['email'])->first();
                $usersObj = User::find($userId);

                if (@$data['firstName'] != "") {
                    $userObj['first_name'] = $data['firstName'];
                }
                if (@$data['lastName'] != "") {
                    $userObj['last_name'] = $data['lastName'];
                }
                if (@$data['phone'] != "") {
                    $userObj['phone'] = $data['phone'];
                }
                if (!$users) {
                    if (@$data['email'] != "") {
                        $userObj['email'] = $data['email'];
                    }
                }
                if (@$data['dob'] != "") {
                    $userObj['dob'] = $data['dob'];
                }
                if (@$data['status'] != "") {
                    $userObj['status'] = $data['status'];
                }
                if (@$data['type'] != "") {
                    $userObj['type'] = $data['type'];
                }

                if (@$data['upload'] != "") {
                    // $userObj->image  = $data['upload'];
                    $img = FileService::save($data['upload'], "customers");
                    // $userObj->image = $img;
                    $userObj['image'] = $img;
                }

                $usrResult = $this->userService->setUpdateUser($userObj, $userId);

                $staff_users = $this->userService->getAllStaffUsers();
                // print_r($list_users);
                // exit;
                return view('admin.staff.staff_list')->with('staff_users', $staff_users)->with('success_message', 'User information has been updated');

            } else {

                // print("Customer Add Section");
                // $data['id'] = 1;
                // $staffResult = $this->staffService->newStaffMember($data);
                // exit;

                $users = User::where('email', $data['email'])->first();
                $usersObj = User::find($userId);

                if (@$data['upload'] != "") {
                    $img = FileService::save($data['upload'], "staff");
                } else {
                    $img = "";
                }

                if (!$users) {

                    $usersObj = User::firstOrNew(
                        [
                            'first_name' => $data['firstName'],
                            'last_name' => $data['lastName'],
                            'phone' => $data['phone'],
                            'email' => $data['email'],
                            'dob' => $data['dob'] ?: "",
                            'image' => $img,
                            'type' => 50,
                            'status' => $data['status'],
                        ]);

                    // print_r($usersObj);
                    // exit;

                    $usersObj->save();
                    // dd($usersObj->id);
                    // exit;
                    // $insertedId = User::lastInsetId();

                    $data['user_id'] = $usersObj->id;
                    $staffResult = $this->staffService->newStaffMember($data);

                    return Redirect::to('admin/staff')->with('success_message', 'Staff member sucessfully added in the system');

                } else {
                    return Redirect::to('admin/staff')->with('error_message', 'Member already exist in the database');
                }

            }

        } else {

            $list_users = $this->userService->getAllUsers();
            return view('admin.staff')->with('list_users', $list_users)->with('success_message', 'Staff member information has been updated');

        }
    }

    public function getStaffData($id)
    {

        $customers_data = $this->userService->getCurrentUsers($id);
        $customers_data['address'] = $this->customerAddressService->getAllCustomerAddresses($id);
        return view('admin.customer.customer_profile', compact('customers_data'));

    }

}
