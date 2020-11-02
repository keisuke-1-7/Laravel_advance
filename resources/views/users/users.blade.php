<h2 class="mt-5 mb-5">users</h2>

<div class="movies row mt-5 text-center">
    
    @foreach($users as $key =>$user)  <!-- ここで使っている$usersがControllerから持ってきた（で定義した）変数 -->
    
        @php
        
            $movie=$user->movies->last();
           
        
        @endphp
        <!-- $movie = 一人ずつ取り出してきた$userが持っているmovieのなかで最新のものですよって意味 -->
        @if($loop->iteration % 3 == 1 && $loop->iteration != 1) 
            
            </div>
            
            <div class="row mt-3 text-center">
        
        @endif
        
            <div class="col-lg-4 mb-5">
                
                <div class="movie text-left d-inline-block">
                    
                    ＠{!! link_to_route('users.show',$user->name,['id'=>$user->id]) !!}  <!-- 動画の前に表示されるユーザの名前 -->
                    
                    <div>  <!-- 動画情報 -->
                        @if($movie)  <!-- $movieは上の方で定義した変数。 -->
                            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->url }}?controls=1&loop=1&playlist={{ $movie->url }}" frameborder="0"></iframe>
                        @else
                            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                        @endif
                    </div>
                    
                    <p>  <!-- コメントがあれば表示させるif文 -->
                        @if(isset($movie->comment))  <!-- 上で定義した$movieにコメントがあれば表示 -->
                        
                            {{ $movie->comment }} 
                        
                        @endif
                        
                        
                    </p>
                    
                </div>
                
            </div>
    
    @endforeach
    
</div>

{{ $users->links('pagination::bootstrap-4') }}