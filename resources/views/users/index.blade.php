{{-- extends("layouts.app") :共通レイアウト(layous/app.blade.php)を呼び出す --}}
@extends("layouts.app")

{{-- section('content') ~ endsection　の間の文章をyield('content')へ埋め込む --}}
@section("content")
    {{-- ユーザ一覧の表示 (users/users.blade.phpで変数が使用できるようになる["users" => $users]) --}}
    @include("users.users", ["users" => $users])
@endsection