<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        // print("User loded");
        // exit;

        if (Auth::check() && Auth::user()->isAdmin()) {
            return 'admin/dashboard';
        } elseif (Auth::check() && Auth::user()->isStaff()) {
            return 'staff/dashboard';
        } elseif (Auth::check() && Auth::user()->isCustomer()) {
            return 'customer/dashboard';
        } elseif (Auth::check() && Auth::user()->isVendor()) {

            // print(Auth::user()->step);

            $curentStep = Auth::user()->step;
            // print(Auth::user()->step);

            // exit;

            if ($curentStep == 1) {
                return 'vendor/profilecategory';
            } elseif ($curentStep == 2) {
                return 'vendor/profilecity';
            } elseif ($curentStep == 3) {
                return 'vendor/profilebusiness';
            } elseif ($curentStep == 4) {
                return 'vendor/profilepromotions';
            } elseif ($curentStep == 5) {
                return 'vendor/profileimages';
            } elseif ($curentStep == 6) {
                return 'vendor/profileimages';
            } elseif ($curentStep == 7) {
                return 'vendor/payby';
            } elseif ($curentStep == 8) {
                return 'vendor/vendor_profile';
            } else {
                print("Dashboard");
                exit;

                return 'vendor/dashboard';
            }

        } else {
            dd('you are not authorized');
        }
    }

    protected function authenticated(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(auth()->check(), 200);
        }

    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        if ($user) {
            $fullname = explode(" ", $user->getName() ? $user->getName() : $user->getNickname());
            $firstName = '';
            $lastName = '';
            foreach ($fullname as $key => $name) {
                if ($key == 0) {
                    $firstName = $name;
                } else {
                    $lastName = $lastName . $name . " ";
                }
            }

            $newUser = User::firstOrCreate(
                [
                    'email' => $user->getEmail(),
                ],
                [
                    'type' => User::CUSTOMER,
                    'status' => User::ACTIVE,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'provider_id' => $user->getId(),
                    'image' => $user->getAvatar(),
                    'provider' => $provider,
                ]
            );
        }

        Auth::login($newUser, true);

        return redirect()->intended('/');
    }
}