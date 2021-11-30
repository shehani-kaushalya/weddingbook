<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pages extends Model
{
    use Notifiable;
    protected $table = 'cities';

    protected $fillable = ['category_id', 'name', 'slug', 'body', 'description', 'featured_image', 'meta_title', 'meta_description', 'meta_keywords', 'meta_type', 'status'];

}