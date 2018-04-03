{{-- エラーメッセージの表示 ($this->validate() を書くと、自動的に $errors 変数にエラーメッセージが格納される) 9.1--}}
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        {{-- div class="alert alert-warning" アラートの結果によってアラートに色を付ける--}}
        <div class="alert alert-warning">{{ $error }}</div>
    @endforeach
@endif