<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'user_id',
        'followed_by',
    ];
    public function followersOf()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function followedBy()
    {
        return $this->belongsTo('App\User','followed_by');
    }
}
