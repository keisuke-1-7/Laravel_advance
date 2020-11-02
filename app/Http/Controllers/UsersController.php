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
}
