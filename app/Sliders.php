<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{

    protected $table = 'sliders';

    const ACTIVE = 100;
    const DE_ACTIVE = 0;
    const default = 100;
    const UPLOADED = 0;

    protected $fillable = ['image', 'title', 'description', 'is_default'];

}