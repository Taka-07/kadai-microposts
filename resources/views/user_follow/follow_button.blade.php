{{-- users/show.blade.phpでincludeしており、変数($users)が使用できる --}}
{{-- フォロー、アンフォローボタン --}}
@if (Auth::user()->id != $user->id)
    @if (Auth::user()->is_following($user->id))
        {!! Form::open(["route" =>["user.unfollow", $user->id], "method" => "delete"]) !!}
            {!! Form::submit("Unfollow", ["class" => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(["route" => ["user.follow", $user->id]]) !!}
            {!! Form::submit("Follow", ["class" => "btn btn-primary btn btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif