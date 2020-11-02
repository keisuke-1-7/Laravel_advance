<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['user_id', 'url', 'comment'];  //fillable関数に値を入れておくと、その分だけ一気に登録することができる！
    
    public function user()
    {
        return $this->belongsTo(User::class);  //このMovieモデル自体がUserモデルに属している( belongsToしている )ことを表す
    }
}
