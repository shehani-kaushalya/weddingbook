<?php

namespace App\Http\Controllers;

use App\BusinessCategories;
use App\Cities;
use App\CustomerAddress;
use App\CustomerPayments;
use App\Payment;
use App\Districts;
use App\Http\Controllers\Controller;
use App\PackagesPromotion;
use App\Services\CustomerAddressService;
use App\Services\FileService;
use App\Services\RequestService;
use App\Services\UserService;
use App\Services\VendorImagesService;
use App\Sliders;
use App\User;
use App\VendorImages;
use App\VendorRating;
use App\VendorSchedules;
use App\Advertisment;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class VendorController extends Controller
{
    private $requestService;
    private $userService;
    private $customerAddressService;
    private $VendorImagesService;

    public function __construct(
        UserService $userService,
        RequestService $requestService,
        CustomerAddressService $customerAddressService,
        VendorImagesService $vendorImagesService) {
        $this->userService = $userService;
        $this->requestService = $requestService;
        $this->customerAddressService = $customerAddressService;
        $this->vendorImagesService = $vendorImagesService;
    }

    public function home()
    {

        $slides = Sliders::all();
        $districts = Districts::all();

        return view('customer.index', compact('slides', 'districts'));
    }

    public function dashboard()
    {

        $slides = Sliders::all();
        $districts = Districts::all();

        return view('customer.dashboard', compact('slides', 'districts'));
    }

    public function myprofile()
    {
        $slides = Sliders::all();
        $districts = Districts::all();

        return view('vendor.profile', compact('slides', 'districts'));
    }

    public function makemyprofile()
    {
        $slides = Sliders::all();
        $districts = Districts::all();
        $bCategories = BusinessCategories::all();
        $user_id = Auth::user()->id;
        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();

        return view('vendor.createprofile', compact('slides', 'districts', 'bCategories', 'vendor_data'));
    }

    // ---------------------------- Customer Administration -----------------------------------------

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

            } 
            else {
                $users = User::where('email', $data['email'])->first();
                $usersObj = User::find($userId);

                if (@$data['upload'] != "") {
                    $img = FileService::save($data['upload'], "customers");
                } 
                else {
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

                    $usersObj->save();
                    return Redirect::to('admin/customers')->with('success_message', 'User sucessfully added in the system');

                } 
                else {
                    return Redirect::to('admin/customers')->with('error_message', 'User already exist in the database');
                }

            }

        } 
        else {
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

                $addressObj->save();

                $customers = $this->userService->getAllCustomers();

                return view('admin.customer.customers_list')->with('customers', $customers)->with('success_message', 'User information has been updated');
            } 
            else {
                $getCustAddCnt = $this->customerAddressService->getCustomerAddressesCount($userId);
                $getCustAddCntStatus = ($getCustAddCnt > 0) ? CustomerAddress::NORMAL : CustomerAddress::PRIMARY;

                $userAddress = $this->customerAddressService->createCustomerAddress($data, $getCustAddCntStatus);
                return Redirect::to('admin/customers')->with('success_message', 'Address sucessfully added in the system');
            }
        } 
        else {
            $list_users = $this->userService->getAllUsers();
            
            return view('admin.customer.customers_list')->with('list_users', $list_users)->with('success_message', 'User information has been updated');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function businessProfile(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $vendorId = $data['vendorId'];

            if ($vendorId != "") {

                $customerAddressObj = CustomerAddress::where('cust_id', $vendorId)->first();
                $customer_id = $customerAddressObj['cust_id'];

                if ($customer_id != $data['vendorId']) {

                    print_r("New address  for vendor" . $vendorId);

                    if (@$data['upload'] != "") {

                        $img = FileService::save($data['upload'], "vendor");
                        $data['image'] = "vendor/" . $data['upload'];

                    } 
                    else {
                        $img = "";
                    }

                    $customerAddressObj = CustomerAddress::firstOrNew(
                        [
                            'cust_id' => $data['vendorId'],
                            'name' => $data['business_name'],
                            'biz_category' => $data['cmbBusinessCategory'],
                            'biz_district' => $data['cmbDistrict'],
                            'biz_city' => $data['cmbCity'],
                            'biz_logo' => $img,
                            'street_address' => $data['address1'],
                            'street_address2' => $data['address2'],
                            'street_address3' => $data['address3'],
                            'city' => $data['city'],
                            'state' => $data['state'],
                            'postal_code' => $data['postal_code'],
                            'zip_code' => $data['zip_code'],
                            'status' => 100,
                        ]);

                    $customerAddressObj->save();

                    return Redirect::to('vendor/information')->with('success_message', 'Your profile page sucessfully creayed in the system');
                } 
                else {
                    if ($data['vendorId'] != "") {
                        $customerAddressObj->cust_id = $data['vendorId'];
                    }
                    if ($data['business_name'] != "") {
                        $customerAddressObj->name = $data['business_name'];
                    }
                    if ($data['cmbBusinessCategory'] != "") {
                        $customerAddressObj->biz_category = $data['cmbBusinessCategory'];
                    }

                    if ($data['cmbDistrict'] != "") {
                        $customerAddressObj->biz_district = $data['cmbDistrict'];
                    }

                    if ($data['cmbCity'] != "") {
                        $customerAddressObj->biz_city = $data['cmbCity'];
                    }

                    if ($data['address1'] != "") {
                        $customerAddressObj->street_address = $data['address1'];
                    }

                    if ($data['address2'] != "") {
                        $customerAddressObj->street_address2 = $data['address2'];
                    }

                    if ($data['address3'] != "") {
                        $customerAddressObj->street_address3 = $data['address3'];
                    }

                    if ($data['city'] != "") {
                        $customerAddressObj->city = $data['city'];
                    }

                    if ($data['state'] != "") {
                        $customerAddressObj->state = $data['state'];
                    }

                    if ($data['postal_code'] != "") {
                        $customerAddressObj->postal_code = $data['postal_code'];
                    }

                    if ($data['zip_code'] != "") {
                        $customerAddressObj->zip_code = $data['zip_code'];
                    }

                    if (isset($data['upload']) && $data['upload'] != "") {

                        $img = FileService::save($data['upload'], "vendor");
                        $data['image'] = "vendor/" . $data['upload'];

                        $customerAddressObj->biz_logo = $img;
                    }

                    $customerAddressObj->save();

                    return Redirect::to('vendor/makemyprofile')->with('success_message', 'Page information sucessfully updated in the system');
                }
            } 
            else {
                return Redirect::to('vendor/businessprofile')->with('error_message', 'First register your membership');
            }

        } 
        else {
            return Redirect::to('vendor/businessprofile')->with('success_message', 'Vendor profile creation fail in the system');
        }
    }

    public function information()
    {    
        $user_id = Auth::user()->id;
        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();

        $objAddress = new CustomerAddress();

        $vendor_data['biz_city'] = $objAddress->city($vendor_data->biz_city)[0]['name'];
        $vendor_data['biz_district'] = $objAddress->city($vendor_data->biz_district)[0]['name'];
        $vendor_data['biz_category'] = $objAddress->biz_category($vendor_data->biz_category)[0]['name'];

        $slides = Sliders::all();
        $districts = Districts::all();

        return view('vendor.information', compact('slides', 'districts', 'vendor_data'));
    }

    public function myphotos()
    {
        $user_id = Auth::user()->id;

        $objAddress = new CustomerAddress();

        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $slides = Sliders::all();
        $districts = Districts::all();

        $vendor_data['photos'] = $this->vendorImagesService->getSelectedVendorImages($user_id);

        return view('vendor.myphotos', compact('slides', 'districts', 'vendor_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function myphotobook(Request $request)
    {
        print("Image Uploading ..... <br/>");
        $data = $request->all();

        DB::connection()->enableQueryLog();

        if ($request->isMethod('post')) {

            $data['title'] = $data['title'];
            $data['vendor_id'] = $data['vendorId'];
            $data['description'] = $data['description'];

            if (@$data['upload'] != "") {

                $data['image'] = $data['upload'];
                $img = FileService::save($data['image'], "vendor");

                if ($img == false) {
                    return Redirect::to('vendor/myphotos')->with('error_message', 'New vendors image not added retry again');

                } 
                else {
                    $data['image'] = "vendor/" . $img;
                    $data['image'] = $img;

                    $vendors = $this->vendorImagesService->createVendorImages($data, VendorImages::UPLOADED);
                    return Redirect::to('vendor/myphotos')->with('error_message', 'New vendors image added');
                }

            } 
            else {
                die("Unauthorise access");
            }

        } 
        else {
            die("Unauthorise access for image uploading method");
        }
    }

    public function myphotobook_delete($id)
    {
        $location = 'vendor';
        $images_data = $this->vendorImagesService->getSelectedVendorImages($id);
        $imageFile = $images_data['0']['image'];
        $imageItemData = FileService::fileExist($imageFile, $location);

        if ($imageItemData == true) {
            $this->vendorImagesService->setDeleteVendorImagesItem($id);
            return Redirect::to('vendor/myphotos');
        } 
        else {
            dd("Unauthorise file deleetion");
        }
    }

    public function offers()
    {
        $user_id = Auth::user()->id;

        $objAddress = new CustomerAddress();

        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $slides = Sliders::all();
        $districts = Districts::all();

        $vendor_data['photos'] = $this->vendorImagesService->getSelectedVendorImages($user_id);

        return view('vendor.offers', compact('slides', 'districts', 'vendor_data'));
    }

    public function profilecategory()
    {
        $slides = Sliders::all();
        $districts = Districts::all();
        $bCategories = BusinessCategories::all();
        $user_id = Auth::user()->id;
        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();

        return view('vendor.profilecategory', compact('slides', 'districts', 'bCategories', 'vendor_data'));
    }

    public function profilecategorystore(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $vendorId = $data['vendorId'];

            if ($vendorId != "") {
                $customerAddressObj = CustomerAddress::where('cust_id', $vendorId)->first();
                $customer_id = 0;

                if (0  != $data['vendorId']) {

                    $customerAddressObj = CustomerAddress::firstOrNew(
                        [
                            'cust_id' => $data['vendorId'],
                            'biz_category' => $data['cmbBusinessCategory'],
                            'status' => 100,
                        ]);

                    $new_address_id = $customerAddressObj->save();

                    if ($new_address_id != "") {
                        $objUser = Auth::user()->find($vendorId);

                        $objUser->step = 2;
                        $objUser->save();
                    } 
                    else {
                        return Redirect::to('vendor/profilecategory')->with('error_message', 'Your profile category not created in the system');
                    }
                    return Redirect::to('vendor/profilecity')->with('success_message', 'Your profile category sucessfully created in the system');
                } 
                else {
                    if ($data['vendorId'] != "") {
                        $customerAddressObj->cust_id = $data['vendorId'];
                    }

                    if ($data['cmbBusinessCategory'] != "") {
                        $customerAddressObj->biz_category = $data['cmbBusinessCategory'];
                    }

                    $customerAddressObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 2;
                    $objUser->save();

                    return Redirect::to('vendor/profilecity')->with('success_message', 'Page information sucessfully updated in the system');
                }
            } 
            else {
                return Redirect::to('vendor/profilecategory')->with('error_message', 'First register your membership');
            }
        } 
        else {
            return Redirect::to('vendor/profilecategory')->with('success_message', 'Vendor profile creation fail in the system');
        }
    }

    public function profilecity()
    {
        $slides = Sliders::all();
        $districts = Districts::all();
        $cities = Cities::all();
        //
        foreach ($districts as $key => $district) {

            $myDistricts[$key]['name'] = $district->name;
            $myDistricts[$key]['id'] = $district->id;

            $districts_cities = Cities::all()->where('district_id', $district->id);

            if (count($districts_cities) > 0) {
                $myDistricts[$key]['districts_cities_count'] = count($districts_cities);
                $myDistricts[$key]['districts_cities'] = $districts_cities;
            } 
            else {
                $myDistricts[$key]['districts_cities_count'] = 0;
            }
        }

        $bCategories = BusinessCategories::all();
        $user_id = Auth::user()->id;
        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();

        return view('vendor.profilecity', compact('slides', 'districts', 'cities', 'myDistricts', 'bCategories', 'vendor_data'));
    }

    public function profilecitystore(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $vendorId = $data['vendorId'];

            if ($vendorId != "") {
                $customerAddressObj = CustomerAddress::where('cust_id', $vendorId)->first();
                $customer_id = $customerAddressObj['cust_id'];

                if ($customer_id != $data['vendorId']) {
                    $customerAddressObj = CustomerAddress::firstOrNew(
                        [
                            'cust_id' => $data['vendorId'],
                            'biz_district' => $data['cmbDistrict'],
                            'biz_city' => $data['cmbCity'],
                            'status' => 100,
                        ]);

                    $new_address_id = $customerAddressObj->save();

                    if ($new_address_id != "") {
                        $objUser = Auth::user()->find($vendorId);

                        $objUser->step = 3;
                        $objUser->save();
                    } 
                    else {
                        return Redirect::to('vendor/profilecity')->with('error_message', 'Your profile category not created in the system');
                    }
                    return Redirect::to('vendor/profilebusiness')->with('success_message', 'Your profile category sucessfully created in the system');
                }
                else {
                    if ($data['vendorId'] != "") {
                        $customerAddressObj->cust_id = $data['vendorId'];
                    }

                    if ($data['cmbDistrict'] != "") {
                        $customerAddressObj->biz_district = $data['cmbDistrict'];
                    }

                    if ($data['cmbCity'] != "") {
                        $customerAddressObj->biz_city = $data['cmbCity'];
                    }

                    $customerAddressObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 3;
                    $objUser->save();

                    return Redirect::to('vendor/profilebusiness')->with('success_message', 'Page information sucessfully updated in the system');
                }
            } 
            else {
                return Redirect::to('vendor/profilecity')->with('error_message', 'First register your membership');
            }
        } 
        else {
            return Redirect::to('vendor/profilecity')->with('success_message', 'Vendor profile creation fail in the system');
        }
    }

    public function profilebusiness()
    {
        $slides = Sliders::all();
        $districts = Districts::all();
        $bCategories = BusinessCategories::all();
        $user_id = Auth::user()->id;
        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();

        return view('vendor.profilebusiness', compact('slides', 'districts', 'bCategories', 'vendor_data'));
    }

    public function profilebusinessstore(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $vendorId = $data['vendorId'];

            if ($vendorId != "") {

                $customerAddressObj = CustomerAddress::where('cust_id', $vendorId)->first();
                $customer_id = $customerAddressObj['cust_id'];

                if ($customer_id != $data['vendorId']) {

                    print_r("New address  for vendor" . $vendorId);

                    if (@$data['upload'] != "") {

                        $img = FileService::save($data['upload'], "vendor");
                        $data['image'] = "vendor/" . $data['upload'];
                    } 
                    else {
                        $img = "";
                    }

                    $customerAddressObj = CustomerAddress::firstOrNew(
                        [
                            'cust_id' => $data['vendorId'],
                            'name' => $data['business_name'],
                            'biz_logo' => $img,
                            'street_address' => $data['address'],
                            'telephone' => $data['contact'],
                            'message' => $data['message'],
                            'status' => 100,
                        ]);


                    $customerAddressObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 4;
                    $objUser->phone = $data['contact'];
                    $objUser->save();

                    return Redirect::to('vendor/profilepromotions')->with('success_message', 'Your profile page sucessfully creayed in the system');
                } 
                else {


                    if ($data['vendorId'] != "") {
                        $customerAddressObj->cust_id = $data['vendorId'];
                    }
                    if ($data['business_name'] != "") {
                        $customerAddressObj->name = $data['business_name'];
                    }

                    if ($data['address'] != "") {
                        $customerAddressObj->street_address = $data['address'];
                    }

                    if ($data['contact'] != "") {
                        $customerAddressObj->telephone = $data['contact'];
                    }

                    if ($data['message'] != "") {
                        $customerAddressObj->message = $data['message'];
                    }

                    if (isset($data['upload']) && $data['upload'] != "") {

                        $img = FileService::save($data['upload'], "vendor");
                        $data['image'] = "vendor/" . $data['upload'];

                        $customerAddressObj->biz_logo = $img;
                    }

                    $customerAddressObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 4;
                    $objUser->phone = $data['contact'];
                    $objUser->save();

                    return Redirect::to('vendor/profilepromotions')->with('success_message', 'Page information sucessfully updated in the system');
                }
            } 
            else {
                return Redirect::to('vendor/profilebusiness')->with('error_message', 'First register your membership');
            }
        } 
        else {
            return Redirect::to('vendor/profilebusiness')->with('success_message', 'Vendor profile creation fail in the system');
        }
    }

    public function profilepromotions()
    {
        $slides = Sliders::all();
        $districts = Districts::all();
        $cities = Cities::all();
        //
        foreach ($districts as $key => $district) {

            $myDistricts[$key]['name'] = $district->name;
            $myDistricts[$key]['id'] = $district->id;

            $districts_cities = Cities::all()->where('district_id', $district->id);

            if (count($districts_cities) > 0) {
                $myDistricts[$key]['districts_cities_count'] = count($districts_cities);
                $myDistricts[$key]['districts_cities'] = $districts_cities;
            } 
            else {
                $myDistricts[$key]['districts_cities_count'] = 0;
            }
        }

        $bCategories = BusinessCategories::all();
        $user_id = Auth::user()->id;
        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();

        return view('vendor.profilepromotions', compact('slides', 'districts', 'cities', 'myDistricts', 'bCategories', 'vendor_data'));
    }

    public function profilePromotionsStore(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $vendorId = $data['vendorId'];

            if ($vendorId != "") {

                $packagesPromotionObj = PackagesPromotion::where('cust_id', $vendorId)->first();
                $customer_id = 1;

                if ($customer_id != $data['vendorId']) {

                    $packagesPromotionObj = PackagesPromotion::firstOrNew(
                        [
                            'cust_id' => $data['vendorId'],
                            'package_name' => "", // $data['packages'],
                            'package_description' => $data['packages'],
                            'promotion_name' => "", // $data['promotions'] ?? "",
                            'promotion_description' => $data['promotions'] ?? "",
                            'discount' => $data['discount'] ?? "",
                            'discount_price' => "",
                            'discount_percentage' => "",
                            'status' => 100,
                        ]);

                    $packagesPromotionObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 5;
                    $objUser->about = $data['aboutus'];
                    $objUser->save();

                    return Redirect::to('vendor/profileimages');
                } 
                else {
                    if ($data['vendorId'] != "") {
                        $packagesPromotionObj->cust_id = $data['vendorId'];
                    }
                    if ($data['packages'] != "") {
                        $packagesPromotionObj->package_name = $data['packages'];
                    }

                    if ($data['packages'] != "") {
                        $packagesPromotionObj->package_description = $data['packages'];
                    }

                    if ($data['promotions'] != "") {
                        $packagesPromotionObj->promotion_name = $data['promotions'];
                    }

                    if ($data['promotions'] != "") {
                        $packagesPromotionObj->promotion_description = $data['promotions'];
                    }

                    if ($data['discount'] != "") {
                        $packagesPromotionObj->discount = $data['discount'];
                    }

                    $packagesPromotionObj->discount_price = "";
                    $packagesPromotionObj->discount_percentage = "";

                    $packagesPromotionObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 5;
                    $objUser->about = $data['aboutus'];
                    $objUser->save();

                    return Redirect::to('vendor/profilepimages')->with('success_message', 'Promotion information sucessfully updated in the system');
                }
            } 
            else {
                return Redirect::to('vendor/profilebusiness')->with('error_message', 'First register your membership');
            }
        } 
        else {
            return Redirect::to('vendor/profilebusiness')->with('success_message', 'Vendor profile creation fail in the system');
        }
    }

    public function profileimages()
    {
        $user_id = Auth::user()->id;

        $objAddress = new CustomerAddress();

        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $user_data = Auth::user()->where('id', $user_id)->first();

        $slides = Sliders::all();
        $districts = Districts::all();

        $vendor_data['photos'] = $this->vendorImagesService->getSelectedVendorImages($user_id);

        return view('vendor.profileimages', compact('slides', 'districts', 'vendor_data', 'user_data'));
    }

    public function profileimagesstore(Request $request)
    {
        $data = $request->all();
        DB::connection()->enableQueryLog();

        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'upload' => 'dimensions:min_width=456,min_height=456',
            ], ['upload.dimensions' => 'The image dimensions should be min size: 456x456 px.']);

            $data['title'] = $data['title'];
            $data['vendor_id'] = $data['vendorId'];
            $data['description'] = $data['description'];

            $vendorImages = $this->vendorImagesService->getSelectedVendorImages($data['vendor_id']);
            if($vendorImages->count() >= 8) {
                return Redirect::to('vendor/profileimages')->with('error_message', 'Maximum image limit exceeded.');
            }

            if (@$data['upload'] != "") {
                $data['image'] = $data['upload'];
                $img = FileService::save($data['image'], "vendor");

                if ($img == false) {
                    return Redirect::to('vendor/profileimages')->with('error_message', 'New vendors image not added retry again');
                } 
                else {
                    $data['image'] = "vendor/" . $img;
                    $data['image'] = $img;

                    $vendors = $this->vendorImagesService->createVendorImages($data, VendorImages::UPLOADED);

                    $objUser = Auth::user()->find($data['vendor_id']);
                    $objUser->verify_status = 0;
                    $objUser->save();

                    return Redirect::to('vendor/profileimages')->with('success_message', 'New vendors image added');
                }
            } 
            else {
                die("Unauthorise access");
            }
        } 
        else {
            die("Unauthorise access for image uploading method");
        }
    }

    public function profilereview(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $vendorId = $data['vendorId'];
            if ($vendorId != "") {
                $customerAddressObj = CustomerAddress::where('cust_id', $vendorId)->first();
                $customer_id = $customerAddressObj['cust_id'];

                if ($customer_id != $data['vendorId']) {
                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 6;
                    $objUser->verify_status = 2;
                    $objUser->save();

                    return Redirect::to('vendor/profileimages')->with('success_message', 'Your profile page sucessfully creayed in the system');
                } 
                else {
                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 6;
                    $objUser->verify_status = 2;

                    $objUser->save();

                    return Redirect::to('vendor/profileimages')->with('success_message', 'Promotion information sucessfully updated in the system');
                }
            } 
            else {
                return Redirect::to('vendor/profilebusiness')->with('error_message', 'First register your membership');
            }
        } 
        else {
            return Redirect::to('vendor/profilebusiness')->with('success_message', 'vendor profile creation fail in the system');
        }
    }

    public function paynow()
    {
        $user_id = Auth::user()->id;

        $objAddress = new CustomerAddress();

        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $user_data = Auth::user()->where('id', $user_id)->first();

        $slides = Sliders::all();
        $districts = Districts::all();

        return view('vendor.paynow', compact('slides', 'districts', 'vendor_data', 'user_data'));

    }

    public function pay_information(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $vendorId = $data['vendorId'];
            if ($vendorId != "") {
                $customerPaymentObj = CustomerPayments::where('cust_id', $vendorId)->first();
                
                if (isset($customerPaymentObj['cust_id']) and $customerPaymentObj['cust_id'] != $data['vendorId']) {
                    $customerPaymentObj = CustomerPayments::firstOrNew(
                        [
                            'cust_id' => $data['vendorId'],
                            'name' => $data['yourname'],
                            'address' => $data['address'],
                            'telephone' => $data['telephone'],
                            'nic' => $data['nic'],
                            'pay_type' => $data['pay_type'],
                            'additional_information' => $data['pay_type'],
                            'payment_method' => $data['pay_type'],
                            'transaction_status' => "0",
                            'status' => 100,
                        ]);

                    $customerPaymentObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 7;
                    $objUser->save();

                    return Redirect::to('vendor/payby')->with('success_message', 'Your profile page sucessfully creayed in the system');
                } 
                else {

                    $customerPaymentObj = CustomerPayments::firstOrNew(
                        [
                            'cust_id' => $data['vendorId'],
                            'name' => $data['yourname'],
                            'address' => $data['address'],
                            'telephone' => $data['telephone'],
                            'nic' => $data['nic'],
                            'pay_type' => $data['pay_type'],
                            'additional_information' => $data['pay_type'],
                            'payment_method' => $data['pay_type'],
                            'transaction_status' => "0",
                            'status' => 100,
                        ]);

                    $customerPaymentObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 6;

                    $objUser->save();

                    return Redirect::to('vendor/payby')->with('success_message', 'Promotion information sucessfully updated in the system');
                }
            } 
            else {
                return Redirect::to('vendor/profile_create')->with('error_message', 'First register your membership');
            }

        } 
        else {
            return Redirect::to('vendor/paynow')->with('success_message', 'Vendor profile creation fail in the system');
        }
    }

    public function pay_by()
    {
        $user_id = Auth::user()->id;

        $objAddress = new CustomerAddress();

        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $user_data = Auth::user()->where('id', $user_id)->first();

        return view('vendor.payby', compact('vendor_data', 'user_data'));
    }

    public function pay_compleet(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all(); 
            $vendorId = $data['vendorId'];
            if ($vendorId != "") {
                $customerPaymentObj = CustomerPayments::where('cust_id', $vendorId)->first();
                $customer_id = $customerPaymentObj['cust_id'];

                if ($customer_id != $data['vendorId']) {
                    $customerPaymentObj = CustomerPayments::firstOrNew(
                        [
                            'cust_id' => $data['vendorId'],
                            'name' => $data['yourname'],
                            'address' => $data['address'],
                            'telephone' => $data['telephone'],
                            'nic' => $data['nic'],
                            'pay_type' => $data['pay_type'],
                            'additional_information' => $data['additional_information'],
                            'payment_method' => $data['payment_method'],
                            'transaction_status' => "0",
                            'status' => 100,
                        ]);
                    //payment_method : pay_option - Full /
                    $customerPaymentObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 7;
                    $objUser->save();

                    return Redirect::to('vendor/payby')->with('success_message', 'Your profile page sucessfully creayed in the system');
                } 
                else {
                    $customerPaymentObj = CustomerPayments::where('cust_id', $vendorId)->first();
                    $customerPaymentObj->cvv = $data['cvv'];
                    $customerPaymentObj->card_number = $data['card_number'];
                    $customerPaymentObj->card_expiry_date = $data['card_expiry_date'];
                    $customerPaymentObj->name_on_card = $data['name_on_card'];
                    $customerPaymentObj->amount = $data['amount'];
                    $customerPaymentObj->transaction_status = 1;
                    $customerPaymentObj->save();

                    $objUser = Auth::user()->find($vendorId);
                    $objUser->step = 8;
                    $objUser->save();

                    return Redirect::to('vendor/payment_successful')->with('success_message', 'Payment information sucessfully updated in the system');
                }
            } 
            else {
                return Redirect::to('vendor/profile_create')->with('error_message', 'First register your membership');
            }
        } 
        else {
            return Redirect::to('vendor/paynow')->with('success_message', 'Vendor profile creation fail in the system');
        }
    }

    public function payment_successful(Request $request)
    {
        $user_id = Auth::user()->id;
        $order_data = false; 
        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $payment_data = CustomerPayments::where('cust_id', $user_id)->first();
        $user_data = Auth::user()->where('id', $user_id)->first();

        if($request->has('order_id')) {
            if(strpos($request->order_id, 'ad-') !== false) { // advertisment payment
                $order_id = @explode('-', $request->order_id)[1] ?? null;
                $order_data = Advertisment::find($order_id);
                
                if($order_data && isset($order_data->id)) {
                    $payment_data = CustomerPayments::where('additional_information', $request->order_id)->first();
                    $payment_data->status = 100;
                    $payment_data->transaction_status = 1;
                }
            } 
        }

        return view('vendor.payment_successful', compact('vendor_data', 'payment_data', 'user_data', 'order_data'));
    }

    public function payment_recipt(Request $request)
    {
        $user_id = $request->vendor_id ?? Auth::user()->id;
        $payment_id = $request->payment_id;
        
        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $payment_data = \App\Payment::where('payment_id', $payment_id)->first() ?? \App\CustomerPayments::where('id', $payment_id)->first();
        $user_data = Auth::user();
        // dd($payment_data);
        
        $vender_name = $vendor_data['name'] ?? '';
        $date = $payment_data['created_at'] ?? '';
        $amount = $payment_data['amount'] ?? '';
        $description = $payment_data['description'] ?? '';

        $pdf = \App::make('dompdf.wrapper');

        $site_settings = env('APP_NAME');
        $pdf->setPaper('a5', 'landscape');
        $pdf->loadHTML('
                <table style="width: 100%;border: 1px solid;padding: 10px;margin: 0 auto;">
                    <tr>
                        <td>
                            <img src="'.asset('frontend/svg/weddingbook.png').'" width="110" />
                        </td>
                        <td style="vertical-align: bottom; text-align: right;margin: 0; font-size: 28px;">Payment Recipt</td>
                    </tr>

                    <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>
                    
                    <tr>
                        <td colspan="2" style="text-align:right;">
                            '.$date.' <br>
                            '.route('home').'
                        </td>
                    </tr>
                    
                    <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>

                    <tr>
                        <td colspan="2">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Description</td>
                                    <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;text-align:right;">Amount (LKR)</td>
                                </tr>
                                <tr>
                                    <td style="padding: 2px 5px;">
                                        Vendor: '.$vender_name.' <br>
                                        Reason: '.ucfirst($description).'

                                        <img src="'.asset('frontend/images/paid-stamp.png').'" style="width: 100px;position: absolute;z-index: 1000;">
                                    </td>
                                    <td style="padding: 2px 5px;text-align:right;">'.number_format($amount, 2).'</td>
                                </tr>
                                <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>
                                <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>
                                <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>
                                <tr>
                                    <td colspan="2" style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;text-align:right;font-weight: bold;">'.number_format($amount, 2).'</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>
                    <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>
                    <tr><td colspan="2" style="text-align:center;">Thank you for paying for the service we offered!</td></tr>
                </table>
            ');

        $pdf->download('invoice.pdf');
        return $pdf->stream();
    }

    public function vendor_profile()
    {
        $objAddress = new CustomerAddress();
        $districts = Districts::all();

        $vendor_data = CustomerAddress::where('cust_id', Auth::user()->id)->first();
        $payment_data = CustomerPayments::where('cust_id', Auth::user()->id)->first();
        $packages_promotion = PackagesPromotion::where('cust_id', Auth::user()->id)->first();
        $user_data = Auth::user();

        $reviews = VendorRating::where('cust_id', $user_data->id)->get();
        
        $vendor_data['districts'] = Districts::where('id', $vendor_data['biz_district'])->first();

        $vendor_data['city'] = Cities::where('id', $vendor_data['biz_city'])->first();
        $vendor_data['biz_category'] = BusinessCategories::where('id', $vendor_data['biz_category'])->first();

        $vendor_data['photos'] = $this->vendorImagesService->getSelectedVendorImages(Auth::user()->id);

        return view('vendor.vendor_profile', compact('vendor_data', 'payment_data', 'user_data', 'reviews', 'districts', 'packages_promotion'));
    }

    public function vendor_profilealerts()
    {
        $user_id = Auth::user()->id;

        $objAddress = new CustomerAddress();
        $districts = Districts::all();

        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $payment_data = CustomerPayments::where('cust_id', $user_id)->first();
        $user_data = Auth::user()->where('id', $user_id)->first();

        $vendor_data['districts'] = Districts::where('id', $vendor_data['biz_district'])->first();

        $vendor_data['city'] = Cities::where('id', $vendor_data['biz_city'])->first();
        $vendor_data['biz_category'] = BusinessCategories::where('id', $vendor_data['biz_category'])->first();

        $vendor_data['photos'] = $this->vendorImagesService->getSelectedVendorImages($user_id);

        return view('vendor.vendor_profilealerts', compact('vendor_data', 'payment_data', 'user_data', 'districts'));
    }

    public function vendor_paynow(Request $request)
    {
        $request->validate([
            'cust_id'  => 'required',
            'currency' => 'required',
            'amount'    => 'required',
            'payment_id'=> 'required',
            'description' => '',
        ]);

        $payment = \App\Payment::where('cust_id', $request->cust_id)->where('payment_id', $request->payment_id)->first();
        if($payment) {
            return response()->json($payment, 200);
        }

        $payment = new \App\Payment();
        $payment->cust_id   = $request->cust_id;
        $payment->currency  = $request->currency ?? 'LKR';
        $payment->amount    = $request->amount;
        $payment->description = $request->description;
        $payment->payment_id = $request->payment_id;
        $payment->status    = \App\Payment::PENDING;

        if($payment->save()) {
            return response()->json($payment, 200);
        }
        return response()->json([], 406); 
    }

    public function pay_successful(Request $request)
    {
        $user_data = Auth::user() ?? \App\User::find($payment_data->cust_id);
        $order_data = false; 
        $vendor_data = CustomerAddress::where('cust_id', $user_data->id)->first();
        if($request->has('order_id')) {

            if(strpos($request->order_id, 'ad-') !== false) { // advertisment payment
                $order_id = @explode('-', $request->order_id)[1] ?? null;
                $order_data = Advertisment::find($order_id);
                $payment_data = Payment::where('payment_id', $request->order_id)->first();

                if($order_data && isset($order_data->id) && $payment_data && $payment_data->status == \App\Payment::PENDING) {
                    // 
                    $payment_data->status = 100;
                    
                    if($payment_data->save()) {
                        $order_data->is_paid = true;
                        $order_data->save();

                        $vendor = Auth::user() ?? \App\User::find($payment_data->cust_id,);
                        $vendor->notify(new \App\Notifications\PaymentSuccessConfirmNotification($payment_data));
                        // notify to all admins 
                        \Notification::send(\App\User::where('type', \App\User::ADMIN)->get(), new \App\Notifications\PaymentRecievedNotification($payment_data));
                    }
                }
            }
            elseif(strpos($request->order_id, 'reg-') !== false) { // vendor registration payment
                $order_id = $request->order_id;
                $payment_data = Payment::where('payment_id', $order_id)->first();

                if($payment_data && $payment_data->status == \App\Payment::PENDING) {
                    $payment_data->status = \App\Payment::SUCCESS;
                    if($payment_data->save()) {
                        $vendor = Auth::user() ?? \App\User::find($payment_data->cust_id,);
                        $vendor->status = \App\User::ACTIVE;

                        $vendor->save();
                        $vendor->notify(new \App\Notifications\PaymentSuccessConfirmNotification($payment_data));
                        // notify to all admins 
                        \Notification::send(\App\User::where('type', \App\User::ADMIN)->get(), new \App\Notifications\PaymentRecievedNotification($payment_data));
                    }
                }
            }
            else {
                return redirect()->route('vendor_profile')->with('error_message', 'Invalid payment attempt');
            }
        }

        return view('vendor.payment_successful', compact('vendor_data', 'payment_data', 'user_data'));
    }

    // ---------------------------- End Customer Administration --------------------------------------
   
    public function  vendor_advertisments()
    {
        $user_id = Auth::user()->id;

        $objAddress = new CustomerAddress();
        $districts = Districts::all();

        $vendor_data = CustomerAddress::where('cust_id', $user_id)->first();
        $payment_data = CustomerPayments::where('cust_id', $user_id)->first();
        $user_data = Auth::user();

        $vendor_data['districts'] = Districts::where('id', $vendor_data['biz_district'])->first();

        $vendor_data['city'] = Cities::where('id', $vendor_data['biz_city'])->first();
        $vendor_data['biz_category'] = BusinessCategories::where('id', $vendor_data['biz_category'])->first();

        $vendor_data['photos'] = $this->vendorImagesService->getSelectedVendorImages($user_id);

        $advertisment = Advertisment::where('cust_id', $user_id)->first();

        return view('vendor.vendor_advertisments', compact('vendor_data', 'payment_data', 'user_data', 'districts', 'advertisment'));
    }

    public function  vendor_advertisment_post(Request $request)
    {
        $request->validate([
            'title'  => 'required',
            'content' => 'required',
            'image' => 'required|dimensions:min_width=456,min_height=456,ratio=1/1',
        ]);
        
        if (@$request->image != "") {
            $img = FileService::save($request->image, "vendor/ads/");
        } 
        else { $img = ""; }

        $user_id = Auth::user()->id;
        $advertisment = Advertisment::firstOrNew(['cust_id' => $user_id]);

        $advertisment->title   = $request->title;
        $advertisment->content = $request->content;
        $advertisment->is_paid = false;
        $advertisment->image   = $img;
        $advertisment->status  = $advertisment->status ?? Advertisment::DE_ACTIVE;

        if($advertisment->save()) {

            $customerPaymentObj = CustomerPayments::firstOrNew([
                                                        'cust_id' => $user_id,
                                                        'additional_information' => 'ad-'.$advertisment->id,
                                                    ]);
            
            $customerPaymentObj->amount = 0.00;
            $customerPaymentObj->pay_type = CustomerPayments::NORMAL;
            $customerPaymentObj->transaction_status = 0;
            $customerPaymentObj->status = CustomerPayments::DE_ACTIVE;

            $customerPaymentObj->save();

            return Redirect::back()->with('success_message', 'Advertisment created sccuessfuly. Complete the payment to publish the advertisment!');
        }

        return Redirect::back()->with('error_message', 'Advertisment create failed!');
    }

    public function customer_requests()
    {
        $user_id = Auth::user()->id;

        $schedules = VendorSchedules::where('cust_id', $user_id)
                                    ->whereIn('status', [0, 1])
                                    ->get();
        $schedules = $schedules->map(function($schedule){
            return [
                'id' => $schedule->id,
                'name' => $schedule->name,
                'title' => $schedule->name,
                'address' => $schedule->address,
                'telephone' => $schedule->telephone,
                'email' => $schedule->email,
                'date' => $schedule->date,
                'start' => explode(" to ", $schedule->duration)[0],
                'end' => explode(" to ", $schedule->duration)[1],
                'duration' => $schedule->duration,
                'status' => $schedule->status,
            ];
        });
        // dd($schedules);
        return view('vendor.customer_requests', compact('schedules')); 
    }

    public function schedule_request(Request $request)
    {
        if(!$request->has('id') Or !$request->has('status')) {
            return response()->json('invalid request', 400);
        }

        $user_id = Auth::user()->id;
        $schedule = VendorSchedules::where('cust_id', $user_id)
                                    ->where('id', $request->id)
                                    ->first();
        $schedule->status = ($request->status == 1) ?: 2;

        if($schedule->save()) {
            return response()->json('success', 200);
        }

        return response()->json([], 406);
    }
}