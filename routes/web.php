<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::mixin(new \Laravel\Ui\AuthRouteMethods());
Route::auth(['verify' => true, 'reset' => true]);

Route::get('/', 'CustomerController@home')->name('home'); // Home
Route::get('contact-us', 'HomeController@contact')->name('contact'); // About US
Route::get('about-us', 'HomeController@aboutus')->name('aboutus'); //Contact US
Route::get('vendor_profilealerts', 'VendorController@vendor_profilealerts')->name('vendor_profilealerts'); // VendorProf tab2
Route::get('vendors', 'VendorController@vendorsList')->name('vendors');

Route::get('/admin/login', 'AdminController@showLoginForm')->name('admin.login.view');
Route::post('/admin/login', 'AdminController@adminLogin')->name('admin.login');

Route::get('social-login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'AdminController@profile')->name('admin.profile');
    Route::get('password_change', 'AdminController@passwordChange')->name('admin.password_change');
    Route::post('password_change', 'AdminController@passwordUpdate')->name('admin.password_change_post');
    Route::get('logout', 'AdminController@adminLogout')->name('admin.logout');

    // User administration
    Route::get('users', 'AdminController@users')->name('users.list');
    Route::get('users/add', 'AdminController@addUsers')->name('users.add');
    Route::get('users/{id}', 'AdminController@getUserData')->name('users');
    Route::post('users/edit', 'AdminController@postUserData')->name('users.edit');

    // Customers Administration

    Route::get('customers/address_new/{id}', 'CustomerController@newCustomersAddress')->name('customers.address_new');
    Route::get('customers/address_edit/{id}', 'CustomerController@editCustomersAddress')->name('customers.address_edit');

    Route::get('customers/add', 'CustomerController@addCustomers')->name('customers.add');
    Route::get('customers', 'CustomerController@customersList')->name('customers');
    Route::get('customers/{id}', 'CustomerController@getCustomerData')->name('customer');
    Route::get('customers/edit/{id}', 'CustomerController@getEditCustomerData')->name('customer');
    Route::get('customers/address_delete/{id}', 'CustomerController@deleteCustomerAddress')->name('address_delete');
    Route::get('customers/makeprimary/{id}', 'CustomerController@getMakePrimaryData')->name('customer');
    Route::post('customers/address_store', 'CustomerController@storeAddress')->name('customers.address_store');
    Route::post('customers/edit', 'CustomerController@postCustomerData')->name('customers.edit');

    // Staff Administration

    Route::get('staff/add', 'StaffController@create')->name('staff.add');
    Route::get('staff/{id}', 'StaffController@getStaffData')->name('staff');
    Route::get('staff/deactive', 'StaffController@deactive')->name('staff.deactive');
    Route::get('staff/edit/{id}', 'StaffController@getEditStaffData')->name('staff.edit');
    Route::get('staff', 'StaffController@index')->name('staff');
    Route::post('staff/edit', 'StaffController@postStaffData')->name('staff.edit');
    Route::post('staff/address_store', 'StaffController@storeAddress')->name('staff.address_store');

    // Image management
    Route::get('sliders', 'SlidersController@sliders')->name('sliders');
    Route::get('slider/{id}', 'SlidersController@slider_delete')->name('sliders.delete');
    Route::post('sliders/create', 'SlidersController@create')->name('sliders.create');

    // Image advertiesment management
    Route::get('advetiesment', 'AdminController@advetiesment')->name('advetiesment');

    // Page Administration
    Route::get('pages', 'PagesController@index')->name('pages');
    Route::get('pages/page/create', 'PagesController@create')->name('pages.page.create');
    Route::get('pages/edit/{id}', 'PagesController@getPagesData')->name('pages.edit');
    Route::get('pages/show/{id}', 'PagesController@pageView')->name('pages.show');
    Route::post('pages/page/store', 'PagesController@store')->name('pages.page.store');

    // Page Category Administration
    Route::get('pages/category/list', 'PageCategoryController@index')->name('pages.category.list');
    Route::get('pages/category/create', 'PageCategoryController@create')->name('pages.category.create');
    Route::get('pages/category/delete/{id}', 'PageCategoryController@category_delete')->name('pages.category.delete');
    Route::get('pages/category/edit/{id}', 'PageCategoryController@getCategoryData')->name('pages.category.edit');

    Route::post('pages/category/store', 'PageCategoryController@store')->name('pages.category.store');

    // Page Districts Administration
    Route::get('districts/list', 'DistrictsController@index')->name('districts.list');
    Route::get('districts/create', 'DistrictsController@create')->name('districts.create');
    Route::get('districts/delete/{id}', 'DistrictsController@districts_delete')->name('districts.delete');
    Route::get('districts/edit/{id}', 'DistrictsController@getDistricData')->name('districts.edit');

    Route::post('districts/store', 'DistrictsController@store')->name('districts.store');

    // Page Cities Administration
    Route::get('city/list', 'CitiesController@index')->name('city.list');
    Route::get('city/create', 'CitiesController@create')->name('city.create');
    Route::get('city/delete/{id}', 'CitiesController@category_delete')->name('city.delete');
    Route::get('city/edit/{id}', 'CitiesController@getCitiesData')->name('city.edit');

    Route::post('city/store', 'CitiesController@store')->name('city.store');

    Route::get('vendors/list', 'Admin\VendorController@index')->name('admin.vendors.list');
    // Route::get('vendors/create', 'Admin\VendorController@vendorsList')->name('admin.vendors.create');
    Route::get('vendors/show/{id}', 'Admin\VendorController@show')->name('admin.vendors.show');
    Route::get('vendors/edit/{id}', 'Admin\VendorController@edit')->name('admin.vendors.edit');
    Route::get('vendors/delete/{id}', 'Admin\VendorController@delete')->name('admin.vendors.delete');
    Route::get('vendors/verify/{id}', 'Admin\VendorController@verify')->name('admin.vendors.verify');
    Route::get('vendors/approve/{id}', 'Admin\VendorController@approve')->name('admin.vendors.approve');
    Route::get('vendors/activate/{id}', 'Admin\VendorController@activate')->name('admin.vendors.activate');
    Route::get('vendors/deactivate/{id}', 'Admin\VendorController@deactivate')->name('admin.vendors.deactivate');
    
    Route::get('vendors/export', 'Admin\VendorController@export')->name('admin.vendors.export');

    Route::get('vendors/advetiesment', 'Admin\VendorController@advetiesment')->name('admin.advetiesments');
    Route::get('vendors/advetiesment/{id}/approve', 'Admin\VendorController@advetiesmentApprove')->name('admin.advetiesments.approve');
    Route::get('vendors/advetiesment/{id}/unpublish', 'Admin\VendorController@advetiesmentUnpublish')->name('admin.advetiesments.unpublish');
    Route::get('vendors/advetiesment/{id}/delete', 'Admin\VendorController@advetiesmentDelete')->name('admin.advetiesments.delete');
    
    Route::get('payments/list', 'Admin\PaymentController@index')->name('admin.payments.list');
    Route::get('payments/export', 'Admin\PaymentController@export')->name('admin.payments.export');
});
// -------------------------------------------------------------------------

// customer routes

Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'isCustomer']], function () {

    Route::get('dashboard', 'CustomerController@dashboard');
});

Route::post('payhere/notify', 'PayhereController@notify')->name('payhere.notify');

Route::group(['prefix' => 'vendor', 'middleware' => ['auth', 'isVendor']], function () {

    Route::get('dashboard', 'VendorController@dashboard');
    Route::get('myprofile', 'VendorController@myprofile')->name('myprofile');

    Route::get('profilecategory', 'VendorController@profilecategory')->name('profilecategory'); //Vendor Reisgtration : P2
    Route::get('profilecity', 'VendorController@profilecity')->name('profilecity'); //Vendor Reisgtration : P3
    Route::get('profilebusiness', 'VendorController@profilebusiness')->name('profilebusiness'); //Vendor Reisgtration : P4
    Route::get('profilepromotions', 'VendorController@profilepromotions')->name('profilepromotions'); //Vendor Reisgtration : P5
    Route::get('profileimages', 'VendorController@profileimages')->name('profileimages');  //Vendor Reisgtration : P5
    Route::get('paynow', 'VendorController@paynow')->name('paynow');
    Route::get('payby', 'VendorController@pay_by')->name('payby');
    Route::get('payment_successful', 'VendorController@payment_successful')->name('payment_successful');
    Route::get('vendor_profile', 'VendorController@vendor_profile')->name('vendor_profile'); // VendorProf tab1 
    
    Route::get('makemyprofile', 'VendorController@makemyprofile')->name('makemyprofile');
    Route::get('information', 'VendorController@information')->name('information');
    Route::get('myphotos', 'VendorController@myphotos')->name('myphotos');
    Route::get('myphotos/{id}', 'VendorController@myphotobook_delete')->name('myphotobook_delete');
    Route::get('offers', 'VendorController@offers')->name('offers');

    Route::post('businessprofile', 'VendorController@businessProfile')->name('businessprofile');
    Route::post('myphotobook', 'VendorController@myphotobook')->name('myphotobook');
    Route::post('profilecategorystore', 'VendorController@profilecategorystore')->name('profilecategorystore');
    Route::post('profilecitystore', 'VendorController@profilecitystore')->name('profilecitystore');
    Route::post('profilebusinessstore', 'VendorController@profilebusinessstore')->name('profilebusinessstore');
    Route::post('profilepromotionsstore', 'VendorController@profilePromotionsStore')->name('profilepromotionsstore');
    Route::post('profileimagesstore', 'VendorController@profileimagesstore')->name('profileimagesstore');
    Route::post('profilereview', 'VendorController@profilereview')->name('profilereview');
    Route::post('pay_information', 'VendorController@pay_information')->name('pay_information');
    Route::post('pay_compleet', 'VendorController@pay_compleet')->name('pay_compleet');
    Route::post('payment_recipt', 'VendorController@payment_recipt')->name('payment_recipt');

    Route::post('paynow', 'VendorController@vendor_paynow')->name('vendor_paynow');
    Route::get('payment/successful', 'VendorController@pay_successful')->name('pay_successful');
    
    Route::get('vendor_advertisments', 'VendorController@vendor_advertisments')->name('vendor_advertisments'); // VendorProf tab3
    Route::post('vendor_advertisments', 'VendorController@vendor_advertisment_post')->name('vendor_advertisment_post');
    
    Route::get('customer_requests', 'VendorController@customer_requests')->name('customer_requests'); // VendorProf tab4
    Route::put('schedule/request', 'VendorController@schedule_request')->name('schedule_request');
});

Route::get('profile_create', 'HomeController@profile_create')->name('profile_create'); //Vendor Reisgtration : P1
Route::get('get-city-list', 'CitiesController@getCityList');
Route::get('logout', 'AdminController@adminLogout')->name('logout');

// Route::post('login', 'Auth\LoginController@loogin')->name('login');

Route::get('filter/{district}', 'HomeController@filter')->name('filter');
Route::get('filter/{district}/{city}', 'HomeController@filter')->name('filter.city');
Route::get('profile/{profile}', 'HomeController@profile')->name('profile');
Route::post('check-availability', 'HomeController@checkAvailability')->name('check-availability');
Route::get('get-date-availability', 'HomeController@getDateAvailability')->name('get-date-availability');
Route::post('submit-review', 'HomeController@submitReview')->name('submit-review');

// Route::get('shehani',['uses' =>'TestController@index']);
// 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