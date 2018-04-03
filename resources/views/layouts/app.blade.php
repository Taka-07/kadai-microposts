<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{-- レスポンシブデザインの設定 --}}
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Microposts</title>
        
        {{-- Bootstrapの読み込み --}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        {{-- ナビバーの表示 --}}
        @include("commons.navbar")
        
        <div class="container">
            {{-- エラーメッセージの表示 --}}
            @include("commons.error_messages")
        
            {{-- section ~ endsectionの間の文字を埋め込む --}}
            @yield("content")
        </div>
    </body>
</html>