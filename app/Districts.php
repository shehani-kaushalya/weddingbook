<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Districts extends Model
{
    use Notifiable;
    protected $table = 'districts';

    const ACTIVE = 100;
    const DE_ACTIVE = 0;
    const DEFAULT = 100;
    const UPLOADED = 0;

    protected $fillable = ['name', 'description', 'image', 'status', 'created_at', 'updated_at'];

	public function cities()
    {
        return $this->hasMany(\App\Cities::class, 'district_id', 'id');
    }
}