<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $table = 'message';

  protected $fillable = ['seller_id', 'receiver_id','cc_receiver_id','message_title','message_body'];
}
