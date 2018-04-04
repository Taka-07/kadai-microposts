{{-- extends("layouts.app") :共通レイアウト(layous/app.blade.php)を呼び出す --}}
@extends("layouts.app")

{{-- section('content') ~ endsection　の間の文章をyield('content')へ埋め込む --}}
@section("content")

    {{-- Auth::check() は現在の閲覧者がログイン中の場合とログインしていない場合でナビバーの表示を分ける --}}
    {{-- トップページの表示 --}}
    @if (Auth::check())
        {{-- ログイン後のwelcome.blade.php表示 --}}
        <div class="row">
            <aside class="col-xs-4">
                {{-- Micropostをツイートするためのフォーム --}}
                {!! Form::open(["route" => "microposts.store"]) !!}
                    <div class="form-group">
                        {!! Form::textarea("content", old("content"), ["class" => "form-control", "rows" => "5"]) !!}
                    </div>
                    {!! Form::submit("POST", ["class" => "btn btn-primary btn-block"]) !!}
                {!! Form::close() !!}
            </aside>
            <div class="col-xs-8">
                {{-- $micropostはWelcomeControllerのindex()の$dataから持ってきている --}}
                @if (count($microposts) > 0)
                    {{-- Micropostの一覧の表示 (microposts/microposts.blade.phpで変数が使用できるようになる["microposts" => $microposts]) --}}
                    @include("microposts.microposts", ["microposts" => $microposts])
                @endif
            </div>
        </div>
    @else
        {{-- ログイン前のwelcome.blade.php表示 --}}
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {{-- ユーザ登録リンクを作成 --}}
                {!! link_to_route("signup.get", "sign up now!", null, ["class" => "btn btn-lg btn-primary"]) !!}
            </div>
        </div>
    @endif
@endsection