{{-- microposts.blade.phpでincludeしており、変数($micropost)が使用できる --}}
{{-- favoriteボタン --}}
@if (Auth::user()->is_favorites($micropost->id))
    {!! Form::open(['route' => ['user.unfavorite', $micropost->id], 'method' => 'delete', "class" => "form-inline"]) !!}
        {!! Form::submit('unfavorite', ['class' => "btn btn-success btn-xs"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['user.favorite', $micropost->id], "class" => "form-inline"]) !!}
            {!! Form::submit('favorite', ['class' => "btn btn-default btn-xs"]) !!}
    {!! Form::close() !!}
@endif