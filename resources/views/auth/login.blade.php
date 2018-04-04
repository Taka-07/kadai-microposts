{{-- extends("layouts.app") :共通レイアウト(layous/app.blade.php)を呼び出す --}}
@extends("layouts.app")

{{-- section('content') ~ endsection　の間の文章をyield('content')へ埋め込む --}}
@section("content")
    <div class="text-center">
        <h1>Log in</h1>
    </div>
    
    {{-- グリッドの設定 --}}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            
                {{-- ログインページ（フォーム） --}}
                {!! Form::open(["route" => "login.post"]) !!}
                    <div class="form-group">
                        {{-- old() 関数を使えば、直前で入力していた値を再度代入(入力内容を消さずに済む)しておくことができる --}}
                        {!! Form::label("email", "Email") !!}
                        {!! Form::email("email", old("email"), ["class" => "form-control"]) !!}
                    </div>
                    
                    <div class="form-group">
                        {{-- password 関係は old() で残さないほうがセキュリティ的に良い     --}}
                        {!! Form::label("password", "Password") !!}
                        {!! Form::password("password", ["class" => "form-control"]) !!}
                    </div>
                    
                    {!! Form::submit("Log in", ["class" => "btn btn-primary btn-block"]) !!}
                {!! Form::close() !!}
                
                <p>New user? {!! link_to_route("signup.get", "sign up now!") !!}</p>
        </div>
    </div>
@endsection