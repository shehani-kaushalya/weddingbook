<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    //types
    const CUSTOMER = 100;
    const VENDOR = 200;

    const STAFF = 50;
    const ADMIN = 10;

    //status
    const PENDING = 50;
    const APPROVED = 60;
    const ACTIVE = 100;
    const DE_ACTIVE = 0;
    // const PUBLISHED = 100;
    // const UNPUBLISHED = 0;

    //verification status
    const EMAIL_VERIFIED = 80;
    const MOBILE_VERIFIED = 90;
    const BOTH_VERIFIED = 100;
    const NONE_VERIFIED = 0;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @property boolean aa
     */
    protected $fillable = [
        'first_name', 'last_name', 'type', 'status', 'step', 'image', 'email', 'password', 'provider_id', 'provider', 'dob', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->type == self::ADMIN;
    }

    public function isStaff()
    {
        return $this->type == self::STAFF;
    }

    public function isCustomer()
    {
        return $this->type == self::CUSTOMER;
    }

    public function isVendor()
    {
        return $this->type == self::VENDOR;
    }

    public function verifyStatus()
    {
        switch ($this->verify_status) {
            case self::EMAIL_VERIFIED:
                return "EMAIL VERIFIED";
                break;
                
            case self::MOBILE_VERIFIED:
                return "MOBILE VERIFIED";
                break;
            
            case self::BOTH_VERIFIED:
                return "BOTH VERIFIED";
                break;
                    
            case self::NONE_VERIFIED:
                return "NOT VERIFIED";
                break;
            
            default:
                return "NOT VERIFIED";
                break;
        }
    }

    public function status()
    {
        switch ($this->status) {
            case self::ACTIVE:
                if(self::isAdmin())
                    { return "ACTIVE"; }
                
                return "ACTIVE (PUBLISHED)";
                break;
            
            case self::PENDING:
                return "PENDING";
                break;
            
            case self::APPROVED:
                return "APPROVED";
                break;
            
            default:
                return "DE ACTIVATED (UNPUBLISHED)";
                break;
        }
    }

    public function vendorAddress()
    {
        return $this->hasOne(\App\CustomerAddress::class, 'cust_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(\App\VendorRating::class, 'cust_id', 'id');
    }
}