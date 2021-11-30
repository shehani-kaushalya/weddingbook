<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payments';

    const SUCCESS = 2;
    const PENDING = 0;
    const CANCELED = -1;
    const FAILED = -2;
    const CHARGEDBACK = -3;

    protected $fillable = [
        'cust_id', 'currency', 'amount', 'amount', 'status'
    ];

    public function vendor(){
        return $this->belongsTo(\App\User::class, 'cust_id', 'id');
    }

    public function vendorAddress(){
	    return $this->hasOne(\App\CustomerAddress::class, 'cust_id', 'cust_id');
	}

    public function status()
    {
        switch ($this->status) {
            case self::SUCCESS:
                return "SUCCESS";
                break;
            
            case self::PENDING:
                return "PENDING";
                break;
            
            case self::CANCELED:
                return "CANCELED";
                break;
            
            case self::FAILED:
                return "FAILED";
                break;
            
            case self::FAILED:
                return "FAILED";
                break;
            
            case self::CHARGEDBACK:
                return "CHARGEDBACK";
                break;
            
            default:
                return "PENDING";
                break;
        }
    }
}