<?php

namespace App\Http\Controllers;

use App\CustomerAddress;
use App\PackagesPromotion;
use App\Districts;
use App\Http\Controllers\Controller;
use App\Sliders;
use App\User;
use App\VendorRating;
use App\VendorSchedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
 //------------------------------Vendor Registration : P1 -----------------------------------------------
    public function profile_create()
    {
        $slides = Sliders::all();
        $districts = Districts::all();

        return view('login', compact('slides', 'districts'));
    }
//-------------------------------------------------------------------------------------------------------
    public function register()
    {
        $slides = Sliders::all();
        $districts = Districts::all();

        return view('login', compact('slides', 'districts'));
    }

    public function filter($district, $city = null)
    {
        $slides = Sliders::all();
        $districts = Districts::all();

        $vendors = CustomerAddress::where('biz_district', $district);

        if(!empty($city)) {
            $vendors = $vendors->where('biz_city', $city);
        }
        $vendors = $vendors->get();

        return view('customer.filter', compact('slides', 'districts', 'vendors'));
    }

    public function profile(CustomerAddress $profile)
    {
        $slides = Sliders::all();
        $districts = Districts::all();
        $packagesPromotion = PackagesPromotion::where('cust_id', $profile->cust_id)->first();
        $reviews = VendorRating::where('cust_id', $profile->cust_id)->get();
        $vendor = User::where('id', $profile->cust_id)->first();
        $schedules = VendorSchedules::where('cust_id', $profile->cust_id)
                                    ->where('status', 1)
                                    ->groupBy('date')
                                    ->selectRaw('count(id) as number_of_schedules, date')
                                    ->get();
        // dd($schedules);

        return view('customer.profile', compact('slides', 'districts', 'profile', 'packagesPromotion', 'reviews', 'vendor', 'schedules'));
    }

    public function contact()
    {
        $slides = Sliders::all();
        $districts = Districts::all();

        return view('customer.contact', compact('slides', 'districts'));
    }

    public function aboutus()
    {
        $slides = Sliders::all();
        $districts = Districts::all();

        return view('customer.aboutus', compact('slides', 'districts'));
    }

    public function checkAvailability(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'vendor_id' => ['required'],
            'name' => ['required'],
            'telephone' => ['required', 'digits:10'],
            'date' => ['required'],
            'address' => [],
            'email' => ['required', 'email'],
            'time' => ['required'],
        ]);

        if ($validator->fails()) {
            dd($validator);
            return redirect()->to(url()->previous() . '#check-availability')
                            ->withInput($request->input())
                            ->withErrors($validator)
                            ->with('error_message', 'Something went wrong, Please try again.');
        }

        $vendor = User::find($request->vendor_id);

        $schedule = new VendorSchedules();
        $schedule->cust_id   = $request->vendor_id;
        $schedule->name      = $request->name;
        $schedule->address   = $request->address ?? '';
        $schedule->telephone = $request->telephone;
        $schedule->email     = $request->email;
        $schedule->date      = $request->date;
        $schedule->duration  = $request->time;

        if($schedule->save()) {
            // 
            $vendor->notify(new \App\Notifications\CheckAvailabilityNotification($request->all()));
            return redirect()->to(url()->previous() . '#check-availability')->with('success_message', 'The request has been sent to the vendor.');
        }

        return redirect()->to(url()->previous() . '#check-availability')->withInput($request->input())->with('error_message', 'Something went wrong, Please try again.');
    }

    public function getDateAvailability(Request $request)
    {
        if(!$request->has('vendor_id') or !$request->has('date')) {
            return response()->json(['status' => 'error', 'invalid request']);
        }

        $schedules = VendorSchedules::where('cust_id', $request->vendor_id)
                                    ->where('status', 1)
                                    ->where('date', $request->date)
                                    ->select('duration')
                                    ->get();
        if($schedules)
            $schedules = $schedules->pluck('duration');
        return response()->json($schedules);
    }

    public function submitReview(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'rating' => ['required'],
            'review' => ['required'],
            'vendor_id' => ['required']
        ]);

        $vendor = User::find($request->vendor_id);
        $vendor->reviews()->create(['rating' => $request->rating, 'review' => $request->review]);

        return redirect()->back()->with('success', 'true');
    }
}
