{{-- extends("layouts.app") :共通レイアウト(layous/app.blade.php)を呼び出す --}}
@extends("layouts.app")

{{-- section('content') ~ endsection　の間の文章をyield('content')へ埋め込む --}}
@section("content")
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Microposts</h1>
        </div>
    </div>
@endsection