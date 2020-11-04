<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user) {  //全てのControllerがこれを継承できるようにこのファイルに記述する
        $count_movies = $user->movies()->count();  //$userが保持している動画の数を数える
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
        
        
        return [
            'count_movies' => $count_movies,  
            //このファンクションを開いたところでcount_moviesという名前の変数で使いたいので、そこでの変数を$count_moviesとしている
            //上の$count_moviesを自由に使えるようになるための戻り値
            'count_followings' => $count_followings,  
            'count_followers' => $count_followers,  
        ];
    }
}
