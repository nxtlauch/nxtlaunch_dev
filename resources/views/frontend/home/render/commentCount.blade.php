@php($postComments=$post->comments->unique('user_id'))
@if($postComments->count())
    <strong>Commented
        by {{$post->comments->contains('user_id',Auth::id())?'you':$post->comments->last()->user->name}}</strong>
    @if($post->comments->unique('user_id')->count()-1)
        and
        <span class="total-likes">
            <span class="show-list-btn">
                {{$postComments->count()-1}}
                others
            </span>
            <span class="like-list">
                <span class="inner scrollable">
                    @forelse($postComments as $like)
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
    <strong>Be the first to comment on the launch</strong>
@endif