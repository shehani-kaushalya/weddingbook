<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cities extends Model
{
    use Notifiable;
    protected $table = 'cities';

    protected $fillable = ['district_id', 'name', 'slug', 'body', 'description', 'image', 'status'];

    public function district(){
	    return $this->belongsTo('App\Districts', 'district_id', 'id');
	}
}