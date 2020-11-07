<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Movie;

class RestappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json(  //response()->json()はこういう関数で覚える。json形式で返すという意味
            [
                'users' => $users  //$usersの中身がjson形式で表示される
            ],
            200,[],   //200はステータスコードで、処理がうまくいった時にAPIはこのコードを返す。[]はレスポンスヘッダーというが、今回は使わない
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT  //文字化けしない様にと、見やすい表示形式で出力してくれる様に
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(1);
        $movies = $user->movies;
        
        $data = [
            'movies' => $movies,  
        ];
        
        return view('rest.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'url' => 'required|max:11',
            'comment' => 'max:36',
        ]);


        User::find(1)->movies()->create([
            'url' => $request->url,
            'comment' => $request->comment,
        ]);
        
        $movies = User::find(1)->movies;
        
        return response()->json(  //response()->json()はこういう関数で覚える。json形式で返すという意味
            [
                'movies' => $movies  //$moviesの中身がjson形式で表示される
            ],
            200,[],   //200はステータスコードで、処理がうまくいった時にAPIはこのコードを返す。[]はレスポンスヘッダーというが、今回は使わない
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT  //文字化けしない様にと、見やすい表示形式で出力してくれる様に
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $movies = $user->movies;
        
        return response()->json(  //response()->json()はこういう関数で覚える。json形式で返すという意味
            [
                'users' => $user  //$userの中身がjson形式で表示される
            ],
            200,[],   //200はステータスコードで、処理がうまくいった時にAPIはこのコードを返す。[]はレスポンスヘッダーというが、今回は使わない
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT  //文字化けしない様にと、見やすい表示形式で出力してくれる様に
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  //editとupdateは使わないから消してもいい。が、そもそもルーティングでonlyで指定しているので、残していても使われることはない
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $user = $movie->user;
        
        if($user->id == 1){
            $movie->delete();
        }
        
        $movies = $user->movies;
        
        return response()->json(  //response()->json()はこういう関数で覚える。json形式で返すという意味
            [
                'movies' => $movies  //$moviesの中身がjson形式で表示される
            ],
            200,[],   //200はステータスコードで、処理がうまくいった時にAPIはこのコードを返す。[]はレスポンスヘッダーというが、今回は使わない
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT  //文字化けしない様にと、見やすい表示形式で出力してくれる様に
        );
    }
}
