<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'location', 'phone', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*user role*/
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /*user posts*/
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /*user comments*/
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /*user commentReply*/
    public function commentReplies()
    {
        return $this->hasMany('App\CommentReply');
    }

    /*user likes*/
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    /*user followers*/
    public function followers()
    {
        return $this->hasMany('App\Follow', 'user_id');
    }

    /*followed by*/

    public function followedBy()
    {
        return $this->hasMany('App\Follow', 'followed_by');
    }

    /*user Share*/
    public function shares()
    {
        return $this->hasMany('App\Share');
    }

    /*user details*/
    public function userDetails()
    {
        return $this->hasOne('App\UserDetail');
    }

    /*user setting*/
    public function setting()
    {
        return $this->hasOne('App\UserSetting');
    }

    /*unread message*/
    public function messages()
    {
        return $this->hasMany('App\Message', 'from_id')->where('status', 1);
    }

    /*user reports*/
    public function userReports()
    {
        return $this->hasMany('App\UserReport');
    }
    /*user following Post*/
    public function followPosts()
    {
        return $this->hasMany('App\FollowPost');
    }

}
