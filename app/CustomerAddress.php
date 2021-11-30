<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerAddress extends Model
{

    protected $table = 'customer_address';

    use Notifiable;

    //types
    const PRIMARY = 1;
    const NORMAL = 0;

    //status
    const ACTIVE = 100;
    const DE_ACTIVE = 0;

    protected $fillable = [
        'cust_id', 'name', 'biz_category', 'biz_district', 'biz_city', 'biz_logo', 'street_address', 'street_address2', 'street_address3', 'city', 'state', 'postal_code', 'zip_code', 'status', 'is_primary',
    ];

    public function city($id)
    {
        return Cities::where('id', '=', $id)->get();
    }

    public function district($id)
    {
        // return $this->belongsTo('App\Districts');
        return Districts::where('id', '=', $id)->get();
    }

    public function biz_category($id)
    {
        return BusinessCategories::where('id', '=', $id)->get();
    }

    public function _city()
    {
        return $this->belongsTo(\App\Cities::class, 'biz_city', 'id');
    }

    public function _district()
    {
        return $this->belongsTo(\App\Districts::class, 'biz_district', 'id');
    }

    public function _bizCategory()
    {
        return $this->belongsTo(\App\BusinessCategories::class, 'biz_category', 'id');
    }

    public function address()
    {
        return $this->street_address . ((!empty($this->street_address2)) ? ', ' . $this->street_address2 : '') . ((!empty($this->street_address3)) ? ', ' . $this->street_address3 : '');
    }

    public function vendor()
    {
        return $this->belongsTo(\App\User::class, 'cust_id', 'id');
    }
    
    public function vendor_images()
    {
        return $this->hasMany(\App\VendorImages::class, 'vendor_id', 'cust_id');
    }
}