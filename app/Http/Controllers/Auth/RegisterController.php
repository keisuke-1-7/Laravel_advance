<?php

namespace App\Http\Controllers\Auth; //名前空間といい、クラスを重複しても識別できるようにしている。基本的にはこのファイルのパスとしている

use App\User;                                   //Userクラス(どこの？)をこのRegisterControllerで使えるように定義している
use App\Http\Controllers\Controller;            //ControllerクラスをこのRegisterControllerで使えるように定義している
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller     //ここの最後の  Controllerは  =  App\Http\Controllers\Controller  の意味
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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
