<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $table = 'check';
    protected $dates = ['pay_date'];

}
