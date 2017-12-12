<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function message_from()
    {
        return $this->belongsTo('App\User', 'from_id');
    }

    public function message_to()
    {
        return $this->belongsTo('App\Conversation', 'to_id');
    }
}
