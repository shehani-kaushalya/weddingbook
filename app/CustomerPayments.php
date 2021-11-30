<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerPayments extends Model
{

    protected $table = 'customer_payments';

    use Notifiable;

    //types
    const PRIMARY = 1;
    const NORMAL = 0;

    //status
    const ACTIVE = 100;
    const DE_ACTIVE = 0;

    protected $fillable = [
        'cust_id', 'name', 'address', 'telephone', 'nic', 'pay_type', 'additional_information',
        'payment_method', 'status', 'is_primary',
    ];

}