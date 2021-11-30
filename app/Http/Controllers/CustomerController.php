<?php

namespace App\Http\Controllers;

use App\Districts;
use App\Http\Controllers\Controller;
use App\Services\CustomerAddressService;
use App\Services\FileService;
use App\Services\RequestService;
use App\Services\UserService;
use App\Sliders;
use App\User;
use App\Advertisment;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class CustomerController extends Controller
{
    private $requestService;
    private $userService;
    private $customerAddressService;

    public function __construct(
        UserService $userService,
        RequestService $requestService,
        CustomerAddressService $customerAddressService) {
        $this->userService = $userService;
        $this->requestService = $requestService;
        $this->customerAddressService = $customerAddressService;
    }

    public function home()
    {
        $slides = Sliders::all();
        $districts = Districts::all();

        $vendors = \App\User::where('type', \App\User::VENDOR) // Home page-> meet your vendor 
                            ->where('status', \App\User::ACTIVE)
                            ->with('vendorAddress')     // fix
                            ->orderby('created_at', 'desc')
                            ->limit(6)->get();   

        return view('customer.index', compact('slides', 'districts', 'vendors'));
    }

    public function dashboard()
    {
        $slides = Sliders::all();
        $districts = Districts::all();

        return view('customer.dashboard', compact('slides', 'districts'));
    }

    /**
     * Does something interesting
     *
     * @param Nill
     * @throws Some_Exception_Class If something interesting cannot happen
     * @author Shehani Kaushalya <shehani.liyanaarachchige@gmail.com>
     * @return Array
     */
    public function customersList()
    {
        $customers = $this->userService->getAllCustomers();

        return view('admin.customer.customers_list', compact('customers'));
    }

    public function getCustomerData($id)
    {
        $customers_data = $this->userService->getCurrentUsers($id);
        $customers_data['address'] = $this->customerAddressService->getAllCustomerAddresses($id);
        return view('admin.customer.customer_profile', compact('customers_data'));
    }

    public function getEditCustomerData($id)
    {

        $customers_data = $this->userService->getCurrentUsers($id);
        $customers_data['page'] = "Edit Profile";
        $customers_data['type'] = User::CUSTOMER;
        return view('admin.customer.customer', compact('customers_data'));
    }

    public function addCustomers()
    {
        $customers_data['page'] = "Add New Customer";
        return view('admin.customer.customer', compact('customers_data'));
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
    public function postCustomerData(Request $request)
    {
        DB::connection()->enableQueryLog();

        if ($request->isMethod('post')) {

            $data = $request->all();
            $userId = $data['id'];

            if ($userId != "") {

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
                $customers = $this->userService->getAllCustomers();
                return view('admin.customer.customers_list')->with('customers', $customers)->with('success_message', 'User information has been updated');

            } else {

                // print("Customer Add Section");
                // exit;

                $users = User::where('email', $data['email'])->first();
                $usersObj = User::find($userId);

                if (@$data['upload'] != "") {
                    $img = FileService::save($data['upload'], "customers");
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
                            'type' => 100,
                            'status' => $data['status'],
                        ]);

                    // print_r($usersObj);
                    // exit;

                    // $user = User::create(request([$data['firstName'], $data['firstName'], $data['email'], '100']));

                    $usersObj->save();
                    return Redirect::to('admin/customers')->with('success_message', 'User sucessfully added in the system');

                } else {
                    return Redirect::to('admin/customers')->with('error_message', 'User already exist in the database');
                }

            }

        } else {

            $list_users = $this->userService->getAllUsers();
            return view('admin.customer.customers_list')->with('list_users', $list_users)->with('success_message', 'User information has been updated');

        }
    }

    public function editCustomersAddress($id)
    {

        $address_data = $this->customerAddressService->getSelectedAddress($id);
        $customers_data = $this->userService->getCurrentUsers($address_data[0]['cust_id']);
        $customers_data['page'] = "Edit Customer Address";

        return view('admin.customer.customer_address', compact('customers_data', 'address_data'));
    }

    public function newCustomersAddress($id)
    {
        $customers_data = $this->userService->getCurrentUsers($id);
        $customers_data['page'] = "New Customer Address";

        return view('admin.customer.customer_address', compact('customers_data'));
    }

    public function getMakePrimaryData($addressId)
    {
        $addressData = $this->customerAddressService->getSelectedAddress($addressId);
        $cust_id = $addressData[0]->cust_id;
        $addressCustomerData = $this->customerAddressService->getAllCustomerAddresses($cust_id);
        $addressCustomerDataUpdated = $this->customerAddressService->updateAddressesType($addressCustomerData, $addressId);

        $customers_data['page'] = "Customer List";
        return redirect()->back();
        // return Redirect::to('admin/customers')->with('success_message', 'Address sucessfully updated in the system');

    }

    public function storeAddress(Request $request)
    {
        DB::connection()->enableQueryLog();

        if ($request->isMethod('post')) {

            $data = $request->all();
            $userId = $data['id'];
            $addressId = $data['add_id'];

            if ($userId != "" && $addressId != "") {

                $addressObj = CustomerAddress::find($addressId);

                if (@$data['custName'] != "") {
                    $addressObj->name = $data['custName'];
                }
                if (@$data['streetAddress'] != "") {
                    $addressObj->street_address = $data['streetAddress'];
                }
                if (@$data['streetAddress1'] != "") {
                    $addressObj->street_address2 = $data['streetAddress1'];
                }
                if (@$data['streetAddress3'] != "") {
                    $addressObj->street_address3 = $data['streetAddress3'];
                }
                if (@$data['city'] != "") {
                    $addressObj->city = $data['city'];
                }
                if (@$data['state'] != "") {
                    $addressObj->state = $data['state'];
                }
                if (@$data['postal_code'] != "") {
                    $addressObj->postal_code = $data['postal_code'];
                }
                if (@$data['zipcode'] != "") {
                    $addressObj->zip_code = $data['zipcode'];
                }

                // if(@$data['upload'] != "") {

                //     $userObj->image  = $data['upload'];
                //     $img = FileService::save($userObj->image);
                //     $userObj->image = $img;

                // }

                // print_r($addressObj);
                // exit;
                $addressObj->save();

                // print("bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb");
                // exit;

                // $list_users = $this->userService->getAllUsers();
                $customers = $this->userService->getAllCustomers();
                return view('admin.customer.customers_list')->with('customers', $customers)->with('success_message', 'User information has been updated');

            } else {
                $getCustAddCnt = $this->customerAddressService->getCustomerAddressesCount($userId);
                $getCustAddCntStatus = ($getCustAddCnt > 0) ? CustomerAddress::NORMAL : CustomerAddress::PRIMARY;
                // print_r($getCustAddCntStatus);
                // exit;
                $userAddress = $this->customerAddressService->createCustomerAddress($data, $getCustAddCntStatus);
                return Redirect::to('admin/customers')->with('success_message', 'Address sucessfully added in the system');
            }
        } 
        else {
            $list_users = $this->userService->getAllUsers();

            return view('admin.customer.customers_list')->with('list_users', $list_users)->with('success_message', 'User information has been updated');
        }
    }
}
