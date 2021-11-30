<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobileVerificationRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function passwordGenerate(Request $request)
    {
        $passwordData = $this->userService->generatePassword();
        if ($request->ajax()) {
            return response()->json(['password' => $passwordData['password']], 200);
        } else {
            dd($this->userService->generatePassword());
        }

        return false;
    }

    public function mobileVerify(Request $request)
    {
        $code = $request->code;
        $verify = $this->userService->verifyMobile($code);
        if ($verify) {
            if ($request->ajax()) {
                return response()->json('verified', 200);
            } else {
                dd(true);
            }
        } else {
            if ($request->ajax()) {
                return response()->json('false', 500);
            } else {
                dd(false);
            }
        }

    }

    public function sendMobileVerification(MobileVerificationRequest $request)
    {
        $verify = $this->userService->sendMobileVerification(Auth::user()->id, $request->phone);
        $count = 0;
        if (isset($verify['status'])) {
            return response()->json($verify, 500);
        }

        foreach ($verify as $v) {
            if ($v[0] = "ok") {
                $count++;
            }
        }

        if ($count == count($verify)) {
            return response()->json('true', 200);
        } else {
            return response()->json('false', 500);
        }
    }
}