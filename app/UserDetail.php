<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id',
        'profile_picture',
        'address',
        'birth_date',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
