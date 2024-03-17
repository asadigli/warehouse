<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soldpro extends Model
{
    protected $table = 'soldpro';
    protected $dates =[
        'date','created_at','updated_at',
    ];
}
