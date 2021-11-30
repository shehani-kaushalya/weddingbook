<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorImages extends Model
{

    protected $table = 'vendor_images';

    const ACTIVE = 100;
    const DE_ACTIVE = 0;
    const default = 100;
    const UPLOADED = 1;

    protected $fillable = ['vendor_id', 'image', 'title', 'description', 'is_default'];

}