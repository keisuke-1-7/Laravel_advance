@extends('layouts.app')

@section('content')    <!-- ここが変更できる箇所という宣言 -->


@include('users.tabs',['user'=>$user])


@include('movies.movies', ['movies' => $movies])


@if(Auth::id() == $user->id)  <!-- ログインしているユーザが今閲覧しているidと一致しているかの判断 -->

        <h3 class="mt-5">表示名の変更</h3>

        <div class="row mt-5 mb-5">
            <div class="col-sm-6">

                    {!! Form::open(['route' => 'rename','method'=>'put']) !!}  <!-- ルーティング名は'rename'。メソッドは'put'を使う -->
                        <div class="form-group">
                            {!! Form::label('channel','チャンネル名') !!}
                            {!! Form::text('channel', $user->channel, ['class' => 'form-control']) !!}
                        </div>
        
                        <div class="form-group">
                            {!! Form::label('name','名前') !!}
                            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                        </div>
        
                        {!! Form::submit('更新する？', ['class' => 'button btn btn-primary mt-2']) !!}
                    {!! Form::close() !!}
                    
            </div>
        </div>
        
@endif



@endsection
