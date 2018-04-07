{{-- extends("layouts.app") :共通レイアウト(layous/app.blade.php)を呼び出す --}}
@extends("layouts.app")

{{-- section('content') ~ endsection　の間の文章をyield('content')へ埋め込む --}}
@section("content")
    <div class="text-center">
        <h1>Sign up</h1>
    </div>
    
    {{-- グリッドの設定 --}}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            
            {{-- ユーザ登録ページ（フォーム）--}}
            {{--  signup.post のルーティング、つまり postRegister() アクションに送信され、postRegister() の中ではログインも自動的に実行される --}}
            {!! Form::open(["route" => "signup.post"]) !!}
                <div cl ass="form-group">
                    {{-- old() 関数を使えば、直前で入力していた値を再度代入(入力内容を消さずに済む)しておくことができる --}}
                    {!! Form::label("name", "Name") !!}
                    {!! Form::text("name", old("name"), ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("email", "Email") !!}
                    {!! Form::email("email", old("email"), ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {{-- password 関係は old() で残さないほうがセキュリティ的に良い --}}
                    {!! Form::label("password", "Password") !!}
                    {!! Form::password("password", ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("password_confirmation", "Confirmation") !!}
                    {!! Form::password("password_confirmation", ["class" => "form-control"]) !!}
                </div>
                
                {!! Form::submit("Sign up", ["class" => "btn btn-primary btn-block"]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection