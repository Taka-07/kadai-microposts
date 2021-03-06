<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        /*　ページネーション　8.3
        $users = User::all(); として、全ユーザを一気に取得した場合、例えば、1000ユーザいたとしたら、
        1000ユーザを一気に表示することになり、かなり縦長のページになり、負荷もかかる
        ページネーションとは、例えば、10件ずつなどと表示件数を決めて一覧表示する機能
         */
        $users = user::paginate(10);
        
        return view("users.index", [
            "users" => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy("created_at", "desc")->paginate(10);
        
        $data = [
            "user" => $user,
            "microposts" => $microposts,
        ];
        
        $data += $this->counts($user);
        
        return view("users.show", $data);
    }
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);
        
        $data = [
            "user" => $user,
            "users" => $followings,
        ];
        
        $data += $this->counts($user);
        
        return view("users.followings", $data);
    }
    
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);
        
        $data = [
            "user" => $user,
            "users" => $followers,
        ];
        
        $data += $this->counts($user);
        
        return view("users.followers", $data);
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(10);
        
        $data = [
            "user" => $user,
            "microposts" => $favorites,
        ];
        
        $data += $this->counts($user);
        
        return view("users.favorites", $data);
    }
}