<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PackagesPromotion extends Model
{

    protected $table = 'packages_promotion';

    use Notifiable;

    //types
    const PRIMARY = 1;
    const NORMAL = 0;

    //status
    const ACTIVE = 100;
    const DE_ACTIVE = 0;

    protected $fillable = [
        'cust_id', 'package_name', 'package_description',
        'promotion_name', 'promotion_description', 'discount',
        'discount_price', 'discount_percentage', 'status', 'is_primary',
    ];

    public function city($id)
    {
        return Cities::where('id', '=', $id)->get();
    }

    public function district($id)
    {
        // return $this->belongsTo('App\Districts');
        return Districts::where('id', '=', $id)->get();
    }

    public function biz_category($id)
    {
        return BusinessCategories::where('id', '=', $id)->get();
    }

}