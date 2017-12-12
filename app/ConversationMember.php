<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversationMember extends Model
{
    protected $fillable = [
        'conversation_id',
        'user_id'
    ];

    public function conversation()
    {
        return $this->belongsTo('App\Conversation');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
