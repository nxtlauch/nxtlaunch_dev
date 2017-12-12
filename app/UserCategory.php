<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    public function categoryImage(){
        return $this->belongsTo('App\CategoryImage','category_image_id');
    }
}
