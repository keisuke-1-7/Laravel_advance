<header class="mb-5">
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <a class="navbar-brand" href="/">YouTube-Curation</a>
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="nav-bar-nav">
                
                @if(Auth::check())  <!-- ファサードと言って、クラスを使いやすくしたもの。app.phpにAuthはこれですという記載がある -->
                <!-- Auth::check()はAuthファサードを利用した関数で「ユーザがログイン状態にあるかどうかを判定する」という役割 -->
                <!-- Route::get()などもファサード「Routeファサードを利用している」 -->
                <li class="nav-item">{!! link_to_route('logout', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                
                <li class="nav-item"><a href="" class="nav-link">マイページ</a></li>
                <li class="nav-item">{!! link_to_route('movies.create', '動画を登録する', ['id'=>Auth::id()], ['class' => 'nav-link']) !!}</li>
                
                @else
                
                <li class="nav-item">{!! link_to_route('signup', '新規ユーザ登録', [], ['class' => 'nav-link']) !!}</li>
                <!--signupはrouting名。新規ユーザ登録はリンクとして表示される文字列。[]はURLパラメータ。4つ目はhtmlの情報でクラス名を指定しているだけ-->
                <li class="nav-item">{!! link_to_route('login', 'ログイン',[],['class'=>'nav-link']) !!}</li>
                
                @endif
            </ul>
        </div>
        
    </nav>
    
</header>