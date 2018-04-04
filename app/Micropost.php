<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ["content", "user_id"];
    
    //Micropost を持つ User は1人なので、 function user() のように単数形 user でメソッドを定義する
    public function user()
    {
        //Micropost のインスタンスが所属している唯一の User を取得することができる
        //$micropost->user()->first() もしくは簡単に $micropost->user で取得できる ($thisには$micropostが入る)
        return $this->belongsTo(User::class);
    }
}
