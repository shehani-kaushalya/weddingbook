<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    use HasFactory;
    protected $table = 'ads';
    
    const ACTIVE = 100;
    const DE_ACTIVE = 0;

    protected $fillable = ['cust_id', 'title', 'content', 'status', 'is_paid'];

    public function vendor()
    {
        return $this->belongsTo(\App\User::class, 'cust_id', 'id');
    }
}
