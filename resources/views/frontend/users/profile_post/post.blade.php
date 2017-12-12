<div class="plx__post-header">
    <div class="plx__post-author-avatar"
         {{--                                                         style="background-image: url('{{asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>--}}
         style="background-image: url('{{@$post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
    <div class="plx__meta-text">
        <h4 class="plx__post-author-name">
            <strong>{{$post->user->name}}</strong></h4>
    </div>
    <div class="clearfix"></div>
</div>
<div class="ratio-4-3 plx__post-thumb"
     style="background-image: url('{{asset('content-dir/posts/images/'.$post->image)}}')"></div>
<div class="plx__post-info">
    <div class="plx__time-countdown m-b-5">
                                                        <span class="plx__countdown"><span
                                                                    class="number">08</span>d : <span
                                                                    class="number">14</span>h : <span
                                                                    class="number">03</span>m : <span
                                                                    class="number">21</span>s</span>
    </div>
    <div class="plx___meta-actions">
        <a href="javascript://"
           data-href="{{route('frontend.like.post')}}"
           data-id="{{$post->id}}"
           title="{{$post->likes->contains('user.id',Auth::id())?'Unlike':'Like'}}"
           {{--                                                           class="plx__like {{$post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a>--}}
           class="plx__like {{$post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a>
        <a href="#" title="Comment" class="plx__comment"></a>
        <a href="#" title="Share" class="plx__share"></a>
    </div>
    <div class="post-texts">
        @if($post->likes->count())
            <p class="text-muted"><strong>Liked
                    by {{$post->likes->first()->user->name}}</strong>
                @if($post->likes->count()-1)
                    and
                    {{$post->likes->count()-1}}
                    others</p>
        @endif
        @else
            <p class="text-muted"><strong>No like yet</strong></p>
        @endif
        <p class="post-title">{{$post->post_details}}</p>
        <p><a href="#">View all 12 comments</a></p>
        <div class="plx__comments">
            <p><strong>John Doe</strong> Wow!!! It's amazing... I can't
                wait to get this..</p>
        </div>
    </div>
</div>