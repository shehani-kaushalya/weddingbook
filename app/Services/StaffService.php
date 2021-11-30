<?php

namespace App\Services;

use App\Staff;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffService
{
    public function createUser(array $data, $type)
    {
        return User::create([
            'status' => User::ACTIVE,
            'type' => $type,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_verify' => Str::random(8),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function newStaffMember(array $data)
    {
        return Staff::create([
            'user_id' => $data['user_id'],
        ]);
    }

    public function getAllStaff()
    {
        $users = User::where('type', 50)->get();
        return $users;
    }

    public function getCurrentMember($id)
    {
        $currentuser = User::find($id);
        return $currentuser;
    }

    public function setUpdateMember($userArr, $id)
    {

        // print_r($userArr);
        // print("<br/>");
        // print($id);
        // exit;
        $users = User::where('id', $id)->update($userArr);
        return $users;

    }

    // todo: change count validation at the begining
    public function sendMobileVerification($id, $phone = null)
    {
        $user = User::find($id);
        if ($user->verify_count == 5) {
            return ['status' => false, 'message' => 'you have exceed the maximum verification code limit, please contact support'];
        }
        $code = strtoupper(Str::random(8));
        $user->phone_verify_code = $code;
        if ($phone != null) {
            if ($user->verify_status == User::EMAIL_VERIFIED || ($user->verify_status == User::NONE_VERIFIED)) {
                $user->phone = $phone;
            }
        }
        $user->verify_count = $user->verify_count + 1;
        $user->save();

        return SmsService::SendFormatedSMS($user->phone, $code);
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

    // ==================================================================

    public function getAllStaffUsers()
    {
        $users = User::where('type', 50)->get();
        return $users;
    }

}
