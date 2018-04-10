<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// トップページ
Route::get("/", "WelcomeController@index");

// ユーザ登録　Routeで定義した@getRegisterがAuth\AuthControllerにあるgetRegisterアクションと繋がっている
//getRegister() アクションによって resources/views/auth/register.blade.php を表示
Route::get("signup", "Auth\AuthController@getRegister")->name("signup.get");
//$redirectToによってユーザ登録直後のリダイレクト先の指定やユーザ登録の際のバリデーションなど
//ユーザ登録のフォームを入力後ログインを自動で実行する
Route::post("signup", "Auth\AuthController@postRegister")->name("signup.post");

// ログイン認証
Route::get("login", "Auth\AuthController@getLogin")->name("login.get");
Route::post("login", "Auth\AuthController@postLogin")->name("login.post");
Route::get("logout", "Auth\AuthController@getLogout")->name("logout.get");

/* ログイン認証付きのルーティング
Route::group() でルーティングのグループを作り、その際に ['middleware' => 'auth'] を加えることで、
このグループに書かれたルーティングは必ずログイン認証を確認させる
また、 ['only' => ['index', 'show']] とすることで実装するアクションを絞り込むことが可能
["middleware" => "auth"]にアクセスしたときapp/Http/Middleware/Authenticate.php の handle()が呼び出される
*/
Route::group(["middleware" => "auth"], function () {
    Route::resource("users", "UsersController", ["only" => ["index", "show"]]);
    //Route::group として ['prefix' => 'users/{id}'] を追加している。このグループ内のルーティングでは、 URL の最初に /users/{id}/ が付与される
    //　例　GET /users/{id}/followings　10.2
    Route::group(["prefix" => "users/{id}"], function () {
        Route::post("follow", "UserFollowController@store")->name("user.follow");
        Route::delete("unfollow", "UserFollowController@destroy")->name("user.unfollow");
        Route::post("favorite", "FavoritesController@store")->name("user.favorite");
        Route::delete("unfavorite", "FavoritesController@destroy")->name("user.unfavorite");
        
        Route::get("followings", "UsersController@followings")->name("users.followings");
        Route::get("followers", "UsersController@followers")->name("users.followers");
        Route::get("favorites", "UsersController@favorites")->name("users.favorites");
    });
    
    Route::resource("microposts", "MicropostsController", ["only" => ["store", "destroy"]]);
});