{{-- welcome.blade.phpでincludeしており、変数($microposts)が使用できる --}}
<ul class="media-list">
    @foreach ($microposts as $micropost)
        <?php $user = $micropost->user; ?>
        <li class="media">
            <div class="media-left">
                {{-- アバター画像を表示 --}}
                <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
            </div>
            <div class="media-body">
                <div>
                    {{-- 名前と時刻を表示 --}}
                    {!! link_to_route("users.show", $user->name, ["id" => $user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                </div>
                <div>
                    {{-- contentを表示 --}}
                    <p>{!! nl2br(e($micropost->content)) !!}</p>
                </div>
                <div>
                    {{-- Micropost 削除ボタン --}}
                    @if (Auth::user()->id == $micropost->user_id)
                        {!! Form::open(["route" => ["microposts.destroy", $micropost->id], "method" => "delete"]) !!}
                            {!! Form::submit("Delete", ["class" => "btn btn-danger btn-xs"]) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{-- ページネーションを表示するために必要 ($microposts->render()) --}}
{!! $microposts->render() !!}