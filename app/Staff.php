<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Staff extends Model
{
    
    use Notifiable;
    protected $table = 'staff';
    
    //status
    const ACTIVE = 100;
    const DE_ACTIVE = 0;

    protected $fillable = ['id', 'user_id'];

}
