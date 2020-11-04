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
    
    
    public function rename(Request $request)
    {
        $this->validate($request,[
                'channel' => 'required|max:15',
                'name' => 'required|max:15',
        ]);

        $user=\Auth::user();  //ログインしているユーザが$user
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);

        $user->channel = $request->channel;  //$user(ログインしているユーザ)のchannnelをリクエストされたチャンネル名にする
        $user->name = $request->name;  //$user(ログインしているユーザ)のnameをリクエストされた名前にする
        $user->save();          //更新した$userの名前とチャンネルを保存
        
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        
        $data += $this->counts($user);

        return view('users.show',$data);
    }
    
    
    
    //ここからフォロー中・フォロワーのユーザ情報を抽出
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(9);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }


    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(9);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
}
