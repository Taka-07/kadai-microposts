{{-- extends("layouts.app") :共通レイアウト(layous/app.blade.php)を呼び出す --}}
@extends("layouts.app")

{{-- section('content') ~ endsection　の間の文章をyield('content')へ埋め込む --}}
@section("content")
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Microposts</h1>
            {{-- ユーザ登録リンクを作成 --}}
            {!! link_to_route("signup.get", "sign up now!", null, ["class" => "btn btn-lg btn-primary"]) !!}
        </div>
    </div>
@endsection