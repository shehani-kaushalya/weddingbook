<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorRating extends Model
{

    protected $table = 'vendor_ratings';

    protected $fillable = ['vendor_id', 'rating', 'review'];

    public function vendor()
    {
        return $this->belongsTo(\App\User::class, 'vendor_id', 'id');
    }
}
