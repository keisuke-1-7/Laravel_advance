<!--トレイトによってこのauthフォルダのなかのregister.blade.phpを表示するための,showRegistrationFormアクション
が定義されちゃってるから、合わせるためにauthフォルダ作って、そのなかにregisterファイルを作ったのがこれ！！！-->

@extends('layouts.app')

@section('content')

    <div class="center jumbotron bg-warning">
        <div class="text-center text-white">
            <h1>YouTubeまとめ × SNS</h1>
        </div>
    </div>

    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5">新規ユーザー登録</h3>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}  <!-- 送信を押すと、web.phpに書いたsignup.postっていう名前にしたルーティングに入る -->

                <div class="form-group">
                    {!! Form::label('name', '名前') !!}  <!--'lavel'は入力する型？。'name'はモデル(DB上)のカラム名。'名前'は表示されるラベル名。つまりこれは名前の入力欄-->
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}  <!-- oldは入力したものが残るようにする仕組み。['class'=>'form-control']はhtmlタグの情報 -->
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード確認') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('新規登録', ['class' => 'btn btn-primary mt-2']) !!}
                
            {!! Form::close() !!} <!--でも、viewは{{}}使う方がいい-->

        </div>
    </div>

@endsection