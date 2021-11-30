<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserService
{
    public function createUser(array $data, $type)
    {
        return User::create([
            'status' => User::PENDING,
            'type' => $type,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_verify' => Str::random(8),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function generatePassword()
    {
        $password = Str::random(8);
        $hashedPass = Hash::make($password);

        $data = [
            'password' => $password,
            'hashedPass' => $hashedPass,
        ];
        return $data;
    }

    public function getAllUsers()
    {
        $users = User::where('type', 10)->get();
        return $users;
    }

    public function getAllCustomers()
    {
        $users = User::where('type', 100)->get();
        return $users;
    }

    public function getCurrentUsers($id)
    {
        $currentuser = User::find($id);
        return $currentuser;
    }

    public function setUpdateUser($userArr, $id)
    {
        $users = User::where('id', $id)->update($userArr);
        return $users;
    }

    // todo: change count validation at the begining
    public function sendMobileVerification($id, $phone = null)
    {
        $user = User::find($id);
        if ($user->verify_count == 5) {
            return [
                'status' => false,
                'message' => 'Contact WeddingBook support',
                'custom_error' => 'you have exceed the maximum verification code limit, please contact support',
            ];
        }

        $code = mt_rand(1000, 9999);
        $user->phone_verify_code = $code;
        if ($phone != null) {
            if ($user->verify_status == User::EMAIL_VERIFIED || ($user->verify_status == User::NONE_VERIFIED)) {
                $user->phone = $phone;
            }
        }

        $user->verify_count = $user->verify_count + 1;
        $user->save();
        $dd = SmsService::SendFormatedSMS($user->phone, "Thank you for registering with weddingbook.com Your mobile verification code is : $code");
        Log::info($dd);
        return $dd;
    }

    // todo: use transactions and review the process again
    public function verifyMobile($code)
    {
        if ((Auth::user()->phone_verify_code == $code)) {
            $user = User::find(Auth::user()->id);
            if (Auth::user()->verify_status == User::EMAIL_VERIFIED) {
                $user->verify_status = User::BOTH_VERIFIED;
            } else {
                $user->verify_status = User::MOBILE_VERIFIED;
            }

            $user->phone_verify_at = Carbon::now()->toDateTimeString();

            $user->save();
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($first_name, $last_name, $dob, $email, $new_pass, $type = 'self')
    {
        $user = null;
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'dob' => $dob,
            'email' => $email,
        ];

        if ($new_pass) {
            $data['password'] = Hash::make($new_pass);
        }
        if ($type == 'self') {
            $user = User::where('id', Auth::user()->id)
                ->update($data);
        }
        return $user;
    }

    public function getAllStaffUsers()
    {
        $users = User::where('type', 50)->get();
        return $users;
    }

}
