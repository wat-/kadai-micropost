@if (count($favorites) > 0)
    <ul class="list-unstyled">
        @foreach ($favorites as $favorite)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($favorite->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $favorite->user->name, ['user' => $favorite->user->id]) !!}
                        <span class="text-muted">posted at {{ $favorite->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($favorite->content)) !!}</p>
                    </div>
                    <div>
                        <div class="form-group row m-1">
                            @if (Auth::id() == $user->id)
                                {{-- お気に入り解除ボタンのフォーム --}}
                                {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Unfavorite', ['class' => 'btn btn-light btn-sm mr-1']) !!}
                                {!! Form::close() !!}
                            @endif
                            @if (Auth::id() == $favorite->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                {!! Form::open(['route' => ['microposts.destroy', $favorite->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
        {{-- ページネーションのリンク --}}
    	{{ $favorites->links() }}
    </ul>
@endif
