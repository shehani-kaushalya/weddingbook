<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorSchedules extends Model
{

	protected $table = 'vendor_schedules';

    const PENDING = 0;
    const ACCEPTED = 1;
    const REJECTED = 2;

    protected $fillable = ['cust_id', 'name', 'address', 'telephone', 'email', 'date', 'duration', 'status'];

    public function vendor()
    {
        return $this->belongsTo(\App\User::class, 'cust_id', 'id');
    }
}
