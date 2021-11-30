<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    const ACTIVE = 100;
    const DE_ACTIVE = 0;
    protected $fillable = ['name', 'website', 'status', 'logo'];

    public function fullWeb() {

			if (!preg_match("~^(?:f|ht)tps?://~i", $this->website)) {
				$url = "http://" . $this->website;
			}
			return $url;

		}
}
