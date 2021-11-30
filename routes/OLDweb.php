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

Route::get('/', 'CustomerController@home');

Route::get('/admin/login', 'AdminController@showLoginForm')->name('admin.login.view');
Route::post('/admin/login', 'AdminController@adminLogin')->name('admin.login');
Route::get('admin/logout', 'AdminController@adminLogout')->name('admin.logout');

Route::get('social-login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

// User administration
    Route::get('users', 'AdminController@users')->name('users.list');
    Route::get('users/add', 'AdminController@addUsers')->name('users.add');
    Route::get('users/{id}', 'AdminController@getUserData')->name('users');
    Route::get('admin/logout', 'AdminController@adminLogout')->name('admin.logout');
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

});

// -------------------------------------------------------------------------

// customer routes

Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'isCustomer']], function () {
// Route::group(['prefix' => '/'], function () {
    // Route::group(['middleware' => ['auth', 'isCustomer']], function () {

    // print("aaaaaaaaaaaaaaaaaaaa");
    // exit;
    // Route::get('/', 'CustomerController@home');

    Route::get('dashboard', 'CustomerController@dashboard');
    Route::get('dashboard', 'CustomerController@dashboard');

    // });
});

// vendor routes // customer routes

Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'isCustomer']], function () {
// Route::group(['prefix' => '/'], function () {
    // Route::group(['middleware' => ['auth', 'isCustomer']], function () {

    // print("aaaaaaaaaaaaaaaaaaaa");
    // exit;
    // Route::get('/', 'CustomerController@home');

    Route::get('dashboard', 'CustomerController@dashboard');
    // Route::get('myprofile', 'vendorController@dashboard')->name('myprofile');

    // });
});

Route::group(['prefix' => 'vendor', 'middleware' => ['auth', 'isVendor']], function () {

    Route::get('dashboard', 'VendorController@dashboard');
    Route::get('myprofile', 'VendorController@myprofile')->name('myprofile');

    Route::get('profilecategory', 'VendorController@profilecategory')->name('profilecategory');
    Route::get('profilecity', 'VendorController@profilecity')->name('profilecity');
    Route::get('profilebusiness', 'VendorController@profilebusiness')->name('profilebusiness');
    Route::get('profilepromotions', 'VendorController@profilepromotions')->name('profilepromotions');
    Route::get('profileimages', 'VendorController@profileimages')->name('profileimages');
    Route::get('paynow', 'VendorController@paynow')->name('paynow');
    Route::get('payby', 'VendorController@pay_by')->name('payby');
    Route::get('payment_successful', 'VendorController@payment_successful')->name('payment_successful');
    Route::get('vendor_profile', 'VendorController@vendor_profile')->name('vendor_profile');

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

});

Route::get('profile_create', 'HomeController@profile_create')->name('profile_create');
Route::get('get-city-list', 'CitiesController@getCityList');
Route::get('logout', 'AdminController@adminLogout')->name('logout');

// Route::post('login', 'Auth\LoginController@loogin')->name('login');