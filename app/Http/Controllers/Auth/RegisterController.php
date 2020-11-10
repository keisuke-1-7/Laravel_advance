<?php

namespace App\Http\Controllers\Auth; //名前空間といい、クラスを重複しても識別できるようにしている。基本的にはこのファイルのパスとしている

use App\User;                                   //Userクラス(モデルのこと？)をこのRegisterControllerで使えるように定義している
use App\Http\Controllers\Controller;            //ControllerクラスをこのRegisterControllerで使えるように定義している
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller     //ここの最後の  Controllerは  = App\Http\Controllers\Controller  の意味
//このRegisterControllerクラスは、Controllerクラスを継承しますと言う意味
//こうすることでControllerクラスに記述されている変数や関数をこのRegisterControllerクラス内で扱える
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;  //これがトレイト！！
    //「RegistersUsers」と言うクラスを使えますよと定義しているが、これは 
    //showRegistrationForm と register アクションをこのクラス内で使えますよという意味で他のファイルに「RegistersUsers」の中身が定義されている。
    //ちなみにregisterアクションでログイン処理がされているよ！

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';  //新規ユーザ登録が終われば自動的に'/'に飛ばされる

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); //middlewareは処理がコントローラに渡る前に確認される条件、（ここあまり理解してない）
    }                               //この処理を行うユーザは、必ずゲスト出ないといけないという意味
    //RegisterControllerでこの処理を行うことで、新規ユーザ登録の二重登録を回避できる？？

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)  //このバリデーションで、送られてきたform内容のチェックをする
    {
        return Validator::make($data, [         //Validator::makeの意味は？
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)  //Userモデルを新たに作る処理。 RegistersUsersトレイトのregisterアクションのcreate()を呼び出している
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
