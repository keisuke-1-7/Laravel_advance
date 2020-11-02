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
}
