<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*　認証ミドルウェア 8.2
        認証ミドルウェアの handle() は、 ['middleware' => 'auth'] が設定されたルーティングにアクセスされたときに毎回呼ばれるメソッド
        if ($this->auth->guest()) でログインしているかどうかを判断する
        ログイン無しの場合、 $this->auth->guest() が true を返すので、中身が実行される
        Ajax (JavaScriptによるアクセス) を使用しないので return redirect()->guest('login.get'); が実行される
        ただし、今回のルーティングの設定により、 'auth/login' のルーティングは存在しないので、正しく route('login.get') に修正する
        これで、ログインせずに /users などにアクセスした場合には、 route('login.get') のログインページにリダイレクトされ、ユーザにログインしなければ見られないことを認識させることができます。
        */
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route('login.get')); //修正
            }
        }

        return $next($request);
    }
}
