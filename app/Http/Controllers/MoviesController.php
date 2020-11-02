<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Movie;

class MoviesController extends Controller
{
    public function create()
    {
        $user = \Auth::user();  //$userを定義して、そこにログインしているユーザを入れている
        $movies = $user->movies()->orderBy('id','desv')->paginate(9);
        
        $data=[
            'user' => $user,
            'movies' => $movies,
            ];
        
        return view('movies.create',$data); //moviesフォルダのcreate.blade.phpファイルを返すけど、その時に$dataの内容も一緒に返す（お土産）
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'url' => 'required|max:11',
            'comment' => 'max:36',
        ]);


        $request->user()->movies()->create([
            'url' => $request->url,
            'comment' => $request->comment,
        ]);


        return back();
    }
    
    
    public function destroy($id)
    {
        $movie = Movie::find($id);  //$movieはMovieテーブル？から$id（パラメータからきているid）のものを探してきたもの

        if (\Auth::id() == $movie->user_id) {  //ログインしているユーザがその$movieを所有しているユーザと一致しているなら以下を実行する
            $movie->delete();
        }

        return back();
    }

}
