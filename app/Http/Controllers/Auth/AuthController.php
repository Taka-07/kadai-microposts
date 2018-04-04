<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    //トレイト （メソッドをまとめる機能)　6.3
    /*
      AuthenticatesAndRegistersUsersのソースコードを見るとuseによって
      AuthenticatesUsers(ログイン認証),RegistersUsers(ユーザ登録)を定義したメソッドを取り込んでいる
      RegistersUsers(ユーザ登録のための)トレイトのソースコードにはgetRegister() と postRegister() が定義されている
      getRegister()にはreturn view('auth.register'); が記述されており、
      getRegister() アクションはただ単に resources/views/auth/register.blade.php を表示するアクション
    */
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    
    //追加
    //$redirectTo は postRegister() の最後に呼ばれるリダイレクト先のルーティングで、ユーザ登録直後のリダイレクト先の指定になる
    protected $redirectTo = "/";
    //ログインページのフォームで間違った情報を送信し、ログイン失敗したときにリダイレクトされるリダイレクト先 ($loginPath)の設定
    protected $loginPath ="/login";
    
    //Contoller の __construct() でミドルウェア(middleware)を設定することができる
    //Laravel ではミドルウェアは Controller にアクセスする前に事前に確認される条件
    public function __construct()
    {
        //getLogoutアクション以外では guest である必要があるという条件を持ったミドルウェアが設定されている
        //guest とは、ログイン認証されていない閲覧者のこと
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     
    //RegistersUsers トレイトの postRegister メソッドの中身を見ると、 validator() を呼び出しているのがわかる
    //ユーザ登録の際のフォームデータのバリデーションを行っています。
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
     
    //RegistersUsers トレイトの postRegister メソッドの中身を見ると、 create() を呼び出しているのがわかる
    //これは create アクションとは違って、 User を create(save) しているアクションになる
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
