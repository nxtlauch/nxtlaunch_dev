<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'notification_status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
