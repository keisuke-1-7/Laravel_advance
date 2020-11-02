

<div class="movies row mt-5 text-center">
    
    @foreach($movies as $key =>$movie)  <!-- ここで使っている$usersがControllerから持ってきた（で定義した）変数 -->
    
        
        
        @if($loop->iteration % 3 == 1 && $loop->iteration != 1) 
            
            </div>
            
            <div class="row mt-3 text-center">
        
        @endif
        
            <div class="col-lg-4 mb-5">
                
                <div class="movie text-left d-inline-block">
                    
                    
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

{{ $movies->links('pagination::bootstrap-4') }}