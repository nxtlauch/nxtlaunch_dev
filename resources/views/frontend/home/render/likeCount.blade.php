@if($post->likes->count())
    <strong>Liked
        by {{$post->likes->contains('user_id',Auth::id())?'you':$post->likes->last()->user->name}}</strong>
    @if($post->likes->count()-1)
        and
        <span class="total-likes">
            <span class="show-list-btn">
                {{$post->likes->count()-1}}
                others
            </span>
            <span class="like-list">
                <span class="inner scrollable">
                    @forelse($post->likes as $like)
                        @if($like->user->id==Auth::id())
                            @continue
                        @endif
                        <a href="{{route('frontend.user.profile',$like->user->id)}}">{{$like->user->name}}</a>
                    @empty
                    @endforelse
                </span>
            </span>
        </span>
    @endif
@else
    <strong>No like yet</strong>
@endif