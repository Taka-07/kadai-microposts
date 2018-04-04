{{-- users/index.blade.phpでincludeしており、変数($users)が使用できる --}}
@if (count($users) > 0)
<ul class="media-list">
    @foreach ($users as $user)
        <li class="media">
            <div class="media-left">
                {{-- アバター画像を表示 --}}
                <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
            </div>
            <div class="media-body">
                <div>
                    {{ $user->name }}
                </div>
                <div>
                    <p>{!! link_to_route("users.show", "View profile", ["id" => $user->id]) !!}</p>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{-- ページネーションを表示するために必要 ($users->render()) --}}
{!! $users->render() !!}
@endif