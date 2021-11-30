<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class MessageService
{
    public static function add($message, $success = true)
    {
        $msgs = Session::get("_M_", array());
        $cls = new \stdClass();
        $cls->message = $message;
        $cls->success = $success;
        $msgs[] = $cls;
        Session::flash("_M_", $msgs);
    }

    public static function hasMessage()
    {
        return Session::has('_M_');
    }

    public static function get()
    {
        return Session::get("_M_", array());
    }

}
