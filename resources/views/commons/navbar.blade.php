{{-- ナビバーの設定 --}}
<header>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                {{-- ボタンの設定 --}}
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{-- 「Microposts」のリンクを表示　(リンク先は"/") --}}
                <a class="navbar-brand" href="/">Microposts</a>
            </div>
            {{-- ナビバーの右側に「Signup, Login」のリンクを表示 (リンク先は"") --}}
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Signup</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>