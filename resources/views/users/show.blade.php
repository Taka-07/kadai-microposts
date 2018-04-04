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
        </aside>
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                {{-- それぞれのリンク先とMicropostの数のカウント --}}
                {{-- class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}" は、 /users/{id} という URL の場合には、 class="active" にするコード --}}
                {{-- Bootstrap のタブでは class="active" を付与することで、このタブが今開いているページだとわかりやすくなる --}}
                {{-- Request::is はその判定のために使用している　(詳しくは12 9.6参照) --}}
                <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">Microposts <span class="badge">{{ $count_microposts }}</span></a></li>
                <li><a href="#">Followings</a></li>
                <li><a href="#">Followers</a></li>
            </ul>
            {{-- $micropostはUserControllerのshow()の$dataから持ってきている --}}
            @if (count($microposts) > 0)
                {{-- Micropostの一覧の表示 (microposts/microposts.blade.phpで変数が使用できるようになる["microposts" => $microposts]) --}}
                @include("microposts.microposts", ["microposts" => $microposts])
            @endif
        </div>
    </div>
@endsection