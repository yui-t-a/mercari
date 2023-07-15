<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like_function extends Model
{
    public function like_functions()
    {
        return $this->belongsTo('App\user'); //このユーザーがいいねをしたという紐付け
        return $this->belongsTo('App\product'); //商品に対していいね機能を実装する(JOINのような感じ)
    }
    public function like_exists($user_id,$products_id)
    {
        //exists()がwhereで書いた()内の記述がそれぞれ一致しているか見る。一致していたらいいね、しなければいいねしない
        return like_function::where('user_id',$user_id)->where('products_id',$products_id)->exists();
    }
    public $timestamps = false;
}
