<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CustomerAddressService;
use App\Services\FileService;
use App\Services\RequestService;
use App\Services\UserService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Session;

class AdminController extends Controller
{

    public function __construct(UserService $userService, RequestService $requestService,
        CustomerAddressService $customerAddressService) {
        $this->userService = $userService;
        $this->requestService = $requestService;
        $this->customerAddressService = $customerAddressService;
    }

    public function test()
    {
        return view('admin.test');
    }

    public function showLoginForm(Request $request)
    {
        if ($request->session()->has('user_email')) {
            return redirect()->intended('admin/dashboard');
        } else {
            return view('admin.login');
        }
    }

    public function adminLogin(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password', 'status');

            if (Auth::attempt($credentials)) {
                // Authentication passed... Authorisation granted
                $user = Auth::user();

                $request->session()->put('user_name', $user['first_name'] . " " . $user['last_name']);
                $request->session()->put('user_email', $user['email']);
                $request->session()->put('user_image', $user['image']);

                return redirect()->intended('admin/dashboard');

            } else {
                return Redirect::to('admin/login')->with('error_message', 'Invalid login name or password');
            }
        } else {
            echo ("Die");
        }
    }

    public function adminLogout()
    {
        Session::flush();
        return Redirect::to('/login')->with('error_message_logout', 'You have sucessfully logout');
    }

    public function users()
    {
        $list_users = $this->userService->getAllUsers();
        return view('admin/users/users_list')->with('list_users', $list_users);
    }

    public function addUsers()
    {
        return view('admin.users.users');
    }

    public function getUserData($id)
    {
        $user_data = $this->userService->getCurrentUsers($id);
        return view('admin.users.users')->with('user_data', $user_data);
    }

    public function postUserData(Request $request)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            $userId = $data['id'];

            $validator = Validator::make($request->all(), [
                'email' => 'required | email | unique:users',
            ]);

            if ($validator->fails()) {
                return redirect('admin/users/users_list')
                    ->withErrors($validator)
                    ->withInput();

            }

            if ($userId != "") {
                // print("Edit Section");
                // exit;
                $userObj = User::find($userId);

                if (@$data['firstName'] != "") {
                    $userObj->first_name = $data['firstName'];
                }
                if (@$data['lastName'] != "") {
                    $userObj->last_name = $data['lastName'];
                }
                if (@$data['phone'] != "") {
                    $userObj->phone = $data['phone'];
                }
                if (@$data['email'] != "") {
                    $userObj->email = $data['email'];
                }
                if (@$data['dbo'] != "") {
                    $userObj->dob = $data['dbo'];
                }
                if (@$data['status'] != "") {
                    $userObj->status = $data['status'];
                }
                if (@$data['type'] != "") {
                    $userObj->type = 10;
                }

                if (@$data['upload'] != "") {

                    $userObj->image = $data['upload'];
                    // $img = FileService::save($userObj->image);
                    $img = FileService::save($userObj->image, "users");
                    $userObj->image = "users/" . $img;
                    $userObj->image = $img;

                }

                $userObj->save();
                $list_users = $this->userService->getAllUsers();
                return view('admin/users/users_list')->with('list_users', $list_users)->with('success_message', 'User information has been updated');

            } else {

                $users = User::where('email', $data['email'])->first();
                $usersObj = User::find($userId);

                if (@$data['upload'] != "") {

                    $img = FileService::save($data['upload'], "users");
                    $data['image'] = "users/" . $data['upload'];
                    $img = $img;

                }

                if (!$usersObj) {

                    $usersObj = User::firstOrNew(
                        [
                            'first_name' => $data['firstName'],
                            'last_name' => $data['lastName'],
                            'phone' => $data['phone'],
                            'email' => $data['email'],
                            'dob' => $data['dbo'] ?: "",
                            'image' => $img ?: "",
                            'type' => 10,
                            'status' => $data['status'],
                        ]);

                    $usersObj->save();
                    return Redirect::to('admin/users/users')->with('success_message', 'User sucessfully added in the system');

                } else {

                    return Redirect::to('admin/users/users')->with('error_message', 'User already exist in the database');
                }
            }

        } else {

            $list_users = $this->userService->getAllUsers();
            return view('admin/users/users_list')->with('list_users', $list_users)->with('success_message', 'User information has been updated');

        }
    }

    public function postUserData1(Request $request)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            $userId = $data['id'];

            if ($userId != "") {
                $userObj = User::find($userId);
            } else {
                $userObj = User::all();
            }

            if (@$data['firstName'] != "") {
                $userObj->first_name = $data['firstName'];
            }
            if (@$data['lastName'] != "") {
                $userObj->last_name = $data['lastName'];
            }
            if (@$data['phone'] != "") {
                $userObj->phone = $data['phone'];
            }
            if (@$data['email'] != "") {
                $userObj->email = $data['email'];
            }
            if (@$data['dbo'] != "") {
                $userObj->dob = $data['dob'];
            }
            if (@$data['status'] != "") {
                $userObj->status = $data['status'];
            }
            if (@$data['type'] != "") {
                $userObj->type = $data['type'];
            }

            if (@$data['upload'] != "") {

                $userObj->image = $data['upload'];
                $img = FileService::save($userObj->image);
                $userObj->image = $img;

            }

            $userObj->save();
            $list_users = $this->userService->getAllUsers();
            return view('admin/users/users_list')->with('list_users', $list_users)->with('success_message', 'User information has been updated');

        } else {

            $list_users = $this->userService->getAllUsers();
            return view('admin/users/users_list')->with('list_users', $list_users)->with('success_message', 'User information has been updated');

        }
    }

    /**
     * Does something interesting
     *
     * @param Nill
     *
     * @throws Some_Exception_Class If something interesting cannot happen
     * @author Shehani Kaushalya <shehani.liyanaarachchige@gmail.com>
     * @return Array
     */
    public function suppliersList()
    {
        $suppliers = $this->supplierService->getAllActive();
        return view('admin.supplier.supplires_list', compact('suppliers'));
    }

    public function suppliersDeactiveList()
    {
        $suppliers = $this->supplierService->getAllDeActive();
        return view('admin.supplier.supplires_list', compact('suppliers'));
    }

    public function getSupplierData($id)
    {
        $supplier_data = $this->supplierService->getActiveSupplier($id);
        //print_r($supplier_data);
        return view('admin.supplier.supplier')->with('supplier_data', $supplier_data);
    }

    public function addSupplier()
    {
        return view('admin.supplier.supplier');
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
    public function postSupplierData(Request $request)
    {
        DB::connection()->enableQueryLog();

        if ($request->isMethod('post')) {

            $data = $request->all();
            $supplierId = $data['id'];

            if ($supplierId == "") {

                $data_url = preg_match("/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/i", $data['website']);

                if ($data_url = true) {

                    $supplier = Supplier::where('website', $data['website'])->first();

                    if (!$supplier) {

                        if (@$data['upload'] != "") {
                            // $supplierObj->logo     = $data['uploadlogo'];
                            $img = FileService::save($data['upload'], "supplier");
                            // $supplierObj->logo = $img;
                        }

                        $objSupplier = Supplier::firstOrNew(['website' => $data['website']],
                            ['name' => $data['name'], 'status' => $data['status'], 'logo' => $img]);
                        $objSupplier->save();

                        return Redirect::to('admin/suppliers')->with('success_message', 'Supplier sucessfully added in the system');

                    } else {
                        return Redirect::to('admin/suppliers')->with('error_message', 'Supplier already exist in the database');
                    }
                }

            } else {

                $data_url_edit = preg_match("/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/i", $data['website']);

                if ($data_url_edit = true) {

                    $supplier = Supplier::where('website', $data['website'])->first();
                    $supplierObj = Supplier::find($supplierId);

                    if ($supplierObj['id'] == $supplierId) {

                        if (@$data['name'] != "") {
                            $supplierObj->name = $data['name'];
                        }

                        if (@$data['website'] != "") {
                            $supplierObj->website = $data['website'];
                        }

                        if (@$data['status'] != "") {
                            $supplierObj->status = $data['status'];
                        }

                        if (@$data['upload'] != "") {
                            // $supplierObj->logo     = $data['uploadlogo'];
                            $img = FileService::save($data['upload'], "supplier");
                            $supplierObj->logo = $img;
                        }

                        if ($supplierId != "") {

                            $supplierObj->save();
                            $this->suppliersList();
                            return Redirect::to('admin/suppliers')->with('success_message', 'Supplier information updated sucessfully');
                        }

                    } else {
                        return Redirect::to('admin/suppliers')->with('error_message', 'Supplier url already exist in the database');
                    }

                } else {
                    return Redirect::to('admin/suppliers')->with('error_message', 'Blank supplier  url sucessfully');
                }
            }

        } else {
            echo ("Die");
        }
    }

    public function supplire_delete($id)
    {

        $supplier_data = $this->supplierService->getActiveSupplier($id);
        $imageFile = $supplier_data['0']['image'];
        $supplierItemData = FileService::fileExist($imageFile);

        if ($supplierItemData == true) {
            $this->supplierService->setDeleteSupplierItem($id);
            return Redirect::to('admin/suppliers');
        }
        else {
            $this->supplierService->setDeleteSupplierItem($id);
            return Redirect::to('admin/suppliers');
        }
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function passwordChange()
    {
        return view('admin.password_change');
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'password' => 'required',
                'new_password' => 'required|confirmed|min:6',
                'new_password_confirmation' => 'required',
            ]);

        if (! \Hash::check($request->password, auth()->user()->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'The current password does not match.']);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        auth()->user()->password = \Hash::make($request->password);
        auth()->user()->save();

        return redirect()->route('admin.logout');
    }
}
