<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //pq uma categoria tem mts posts
    public function posts(){
        return $this->hasMany('App\Post', 'posts_categories');
    }
}
