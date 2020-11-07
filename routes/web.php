<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','UsersController@index'); //UsersControllerを使ってホームページ（welcome.php）を表示させる

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');//新規登録フォームを表示させるという意味で、名前をsignupとしている
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');//新規ユーザー登録を実行する（ユーザー登録したい情報を送信する）

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
            //一つ目の引数のloginという文字があればこのルーティングにくる。二つ目前半のAuth\LoginControllerというコントローラを使う。
            //三つ目後半のshowLoginFormという、コントローラに記載されているアクションを実行する。
            //->以降のname('login')でこのルーティングの名前はloginという名前になる
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('users','UsersController',['only'=>['show']]);
//１つ１つのルーティングを記述してきたのに対して、上記は１つの記述で７つのルーティングを準備できる、ルーティング記述の短縮バージョン
//resourceは7つの機能を担っているが、そのうちのshowメソッドのみを使う



//ここからフォロー中のユーザ、フォロワーを取得するルーティング
Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'UsersController@followings')->name('followings');
    Route::get('followers', 'UsersController@followers')->name('followers');
    });

Route::resource('rest', 'RestappController',['only'=>['index','show','create','store','destroy']]);


Route::group(['middleware'=>'auth'],function(){ //'middleware'=>'auth'で「ログイン認証を通ったユーザのみ」という意味合い
    Route::put('users', 'UsersController@rename')->name('rename');
    
    //ここからフォローする、外すのルーティング
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('unfollow');
    });
    
    
    Route::resource('movies','MoviesController',['only'=>['create','store','destroy']]);
});