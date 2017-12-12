<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable=[
        'name',
        'user_id'
    ];
    public function members(){
       return $this->hasMany('App\ConversationMember');
    }
    public function messages(){
        return $this->hasMany('App\Message','to_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
