<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    protected $fillable = [
        'user_id',
        'reported_by',
        'report_description',
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function reportedBy(){
        return $this->belongsTo('App\User','reported_by');
    }
}
