<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BusinessCategories extends Model
{

    use Notifiable;
    protected $table = 'business_categories';

    const ACTIVE = 100;
    const DE_ACTIVE = 0;
    protected $fillable = ['name', 'description', 'status', 'image'];
}