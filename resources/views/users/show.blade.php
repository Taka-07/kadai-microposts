{{-- extends("layouts.app") :共通レイアウト(layous/app.blade.php)を呼び出す --}}
@extends("layouts.app")

{{-- section('content') ~ endsection　の間の文章をyield('content')へ埋め込む --}}
@section("content")
    {{-- ユーザ詳細ページ --}}
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
            {{-- フォロー、アンフォローボタンの表示 (user_follow/follow_button.blade.phpで変数が使用できるようになる ["user" => $user]) --}}
            @include("user_follow.follow_button", ["user" => $user])
        </aside>
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                {{-- それぞれのリンク先とMicropostの数のカウント --}}
                {{-- class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}" は、 /users/{id} という URL の場合には、 class="active" にするコード --}}
                {{-- Bootstrap のタブでは class="active" を付与することで、このタブが今開いているページだとわかりやすくなる --}}
                {{-- Request::is はその判定のために使用している　(詳しくは12 9.6参照) --}}
                <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">Microposts <span class="badge">{{ $count_microposts }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}">Followings <span class="badge">{{ $count_followings }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}">Followers <span class="badge">{{ $count_followers }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/favorites') ? 'active' : '' }}"><a href="{{ route('users.favorites', ['id' => $user->id]) }}">Favorites <span class="badge">{{ $count_favorites }}</span></a></li>
            </ul>
            {{-- $micropostはUserControllerのshow()の$dataから持ってきている --}}
            @if (count($microposts) > 0)
                {{-- Micropostの一覧の表示 (microposts/microposts.blade.phpで変数が使用できるようになる["microposts" => $microposts]) --}}
                @include("microposts.microposts", ["microposts" => $microposts])
            @endif
        </div>
    </div>
@endsection