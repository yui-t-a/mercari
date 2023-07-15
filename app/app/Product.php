<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function like_functions()
    {
        return $this->hasMany('App\like_function');
    } 
}
