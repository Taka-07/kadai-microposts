<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
     
    /*
      モデルと接続されるテーブル名は、モデル名によって決められる。例えば、 Message モデルは messages テーブルと自動的に接続される
      この規則を破って独自のモデル名を付けたい場合に、 $table を使用する
      例えば、 Message モデルだけど、 msg テーブルを使いたいとなれば $table = 'msg' とすれば接続される
    */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    //create() (AuthControllerで使用している)を使って一気にデータを代入する際に$fillable を定義しておく
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    //User から Micropost をみたとき、複数存在するので、function microposts()のように複数形 microposts でメソッドを定義する
    public function microposts()
    {
        //User のインスタンスが自分の Microposts を取得することができる
        //$user->microposts()->all() もしくは簡単に $user->microposts で取得できる　($thisには$userが入る)
        return $this->hasMany(Micropost::class);
    }
}
