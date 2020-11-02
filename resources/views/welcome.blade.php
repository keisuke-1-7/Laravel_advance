@extends('layouts.app')

@section('content')

    <div class="center jumbotron bg-warning">
        
        <div class="text-center text-white">
            <h1>YouTubeまとめ × SNS</h1>
        </div>
        
    </div>


    <div>
        
        <div class="text-right">
            @if(Auth::check())  <!-- もしログイン状態なら -->
            {{ Auth::user()->name }}  <!-- ログインしているユーザの名前を表示 -->
            @endif
        </div>
        
    </div>
    
    @include('users.users',['users'=>$users])
    <!-- usersフォルダのusers.phpを読み込む！そしてここ（welcome.php）でusersっていう変数を使いたいからそれをusers.phpで定義していた$usersってことにする -->
    <!-- viewからviewに変数を渡すときもこのような書き方をする -->
@endsection