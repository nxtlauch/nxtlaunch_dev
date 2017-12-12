<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'reply',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
