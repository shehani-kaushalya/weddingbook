<?php

namespace App\Services;

use App\Mail\EasyEmail;
use App\Mail\InvoiceEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{

    public static function send($email, $msg, $name)
    {
        Mail::to($email)->send(new EasyEmail($email, $msg, $name));

        return true;

    }

    public static function sendInvoice($type, $id)
    {

        $email = 'hwijesinghe@gmail.lk';

        $data = 'test';

        Mail::to($email)->send(new InvoiceEmail($email, $data));

        return true;

    }

}
