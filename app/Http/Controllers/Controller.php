<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //Micropost の数のカウントを View で表示する
    //全てのコントローラが Controller.php を継承しているから全てのコントローラで counts() が使用できる
    public function counts($user) {
        $count_microposts = $user->microposts()->count();
        
        return[
            "count_microposts" => $count_microposts,    
        ];
    }
}
