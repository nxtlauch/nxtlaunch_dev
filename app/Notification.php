<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'noti_text',
        'noti_for',
        'noti_activity',
        'purpose_id',
        'noti_to',
        'status'
    ];
    protected $hidden=[
        'noti_text',
        'noti_for',
        'noti_activity',
        'noti_to'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function post()
    {
        return $this->belongsTo('App\Post','purpose_id');
    }
    
    public function noti_to()
    {
        return $this->belongsTo('App\User','noti_to');
    }


}
