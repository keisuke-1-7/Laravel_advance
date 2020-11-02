<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()  
    {
        $users = User::orderBy('id','desc')->paginate(9);  //$usersという入れ物を作って、Userを取ってきてidが新しい順に9人表示する
        
        return view('welcome',[  //welcome.phpを表示する！
            'users' => $users,  //viewを表示する際に、view内で"user"という変数を使えるように$user(上で取ってきて並び替えたやつ)を埋め込んでる
            ]);                 //「$usersという変数をviewに持っていきます」という宣言
    }                           //左側（users）がviewdに持っていく（viewで使える）変数
    
    
    public function show($id)
    {
        $user = User::find($id);  //指定されたユーザidを見つけて$userとする
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);  //そのユーザが保持する動画を並べ替えた9個を$moviesとする

        $data=[               //$dataの定義
            'user' => $user,
            'movies' => $movies,
        ];

        $data += $this->counts($user);  //Controllerで定義したcountsメソッドの戻り値を$dataに加えている
        

        return view('users.show',$data);  //usersフォルダのshowファイルを表示させて、そこに$dataという変数を持たせる。
    }
}
