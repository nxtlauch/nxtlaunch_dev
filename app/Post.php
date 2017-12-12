<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
//        'post_title',
        'image',
        'post_details',
        'expire_date',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function shares()
    {
        return $this->hasMany('App\Share');
    }
    public function follows()
    {
        return $this->hasMany('App\FollowPost');
    }
    /*public function follows()
    {
        return $this->hasMany('App\Follow');
    }*/
    public function commentReply()
    {
        return $this->hasMany('App\CommentReply');
    }
    public function postReports(){
        return $this->hasMany('App\PostReport');
    }
}
