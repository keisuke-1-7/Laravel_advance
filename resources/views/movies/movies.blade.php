

<div class="movies row mt-5 text-center">
    
    @foreach($movies as $key =>$movie)  <!-- ここで使っている$usersがControllerから持ってきた（で定義した）変数 -->
    
        @php
    
        $movie=$user->movies->last();
        
        if($movie){
        
                $key_name = config('app.key_name');  //$key_nameという変数を定義し、それはconfigフォルダのappファイルのkey_nameですよ
                $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$movie->url&key=$key_name&part=snippet";  
                //$get_api_urlという変数を定義
                $json = file_get_contents($get_api_url);  //$jsonという変数を定義、file_get_contentsという関数で$get_api_urlに入っているwebページの情報を取ってくる
                //ページ情報がない場合は戻り値としてfalseを返してくれるような関数
                if($json){  //$jsonがtrueなら（存在した場合）
                    $getData = json_decode( $json , true);  //$jsonの中身をphpにふさわしい形に変換（decode）する。 trueで連想配列に変換する
                    if($getData['pageInfo']['totalResults']==0){  //動画が存在しない場合
                        $video_title="※動画が未登録です";  //これを表示
                    }else{  //それ以外は（動画が存在する場合）
                        $video_title=$getData['items']['0']['snippet']['title'];  //多次元配列になっていてitem配列の中の”0”番目のsunippetsの中のtitleという項目を引っ張ってきている
                    }
                }else{  //$movieが存在しない場合
                    $video_title="※一時的な情報制限中です";  //これを表示
                }
            
         }
        
        @endphp
        
        @if($loop->iteration % 3 == 1 && $loop->iteration != 1) 
            
            </div>
            
            <div class="row mt-3 text-center">
        
        @endif
        
            <div class="col-lg-4 mb-5">
                
                <div class="movie text-left d-inline-block">
                    
                    
                    <div>  <!-- 動画情報 -->
                        @if($movie)  <!-- $movieは上の方で定義した変数。 -->
                            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->url }}?controls=1&loop=1&playlist={{ $movie->url }}" frameborder="0"></iframe>
                        @else  <!--動画情報が未登録だった場合-->
                            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                            @php
                                $video_title='*動画が未登録です';
                            @endphp
                        @endif
                    </div>
                    
                    <p>  <!-- コメントがあれば表示させるif文 -->
                        @if(isset($movie->comment))  <!-- 上で定義した$movieにコメントがあれば表示 -->
                        
                            {{ $movie->comment }} 
                        @else  <!-- もしコメントが登録されていなかったら -->
                            
                            {{ $video_title }}  <!-- 上で定義した変数内容を表示 -->
                        
                        @endif
                    </p>
                    
                    @if(Auth::id() == $movie->user_id)
                        {!! Form::open(['route' => ['movies.destroy', $movie->id], 'method' => 'delete']) !!}
                        <!-- ルーティングはmoviesコントローラのdestroyアクション？で、パラメータは$movie->id(対象となる動画のid)-->
                            {!! Form::submit('この動画を削除する？', ['class' => 'button btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endif
                    
                </div>
                
            </div>
    
    @endforeach
    
</div>

{{ $movies->links('pagination::bootstrap-4') }}