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
    
    public function followings()
    {
        return $this->belongsToMany(User::class, "user_follow", "user_id", "follow_id")->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, "user_follow", "follow_id", "user_id")->withTimestamps();
    }
    
    public function follow($userId)
    { 
        // 既にフォローしているかの確認 
        //フォローしているとtrue　していないとfalse
        $exist = $this->is_following($userId);
        
        // 自分自身ではないかの確認
        //自分自身だった場合true　違う場合false
        $its_me = $this->id == $userId;

        //「||」はORの意味　
        if ($exist || $its_me) {
            // 既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        
        // 自分自身ではないかの確認
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
}