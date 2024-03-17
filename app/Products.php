<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "products";
    protected $casts = [
	    'price' => 'float',
	    'first_price' => 'float',
	];
}
