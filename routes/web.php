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
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('users','UsersController',['only'=>['show']]);
//１つ１つのルーティングを記述してきたのに対して、上記は１つの記述で７つのルーティングを準備できる、ルーティング記述の短縮バージョン
//resourceは7つの機能を担っているが、そのうちのshowメソッドのみを使う

Route::group(['middleware'=>'auth'],function(){ //'middleware'=>'auth'で「ログイン認証を通ったユーザのみ」という意味合い
    Route::resource('movies','MoviesController',['only'=>['create','store','destroy']]);
});