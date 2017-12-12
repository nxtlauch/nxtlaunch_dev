<div class="ratio-4-3 plx__post-thumb"
     style="background-image: url('{{asset('content-dir/posts/images/'.$post->image) }}')"></div>
<div class="plx__post-info">
    <div class="plx__post-header">
        <div class="plx__post-author-avatar"
             style="background-image: url('{{@$post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
        <div class="plx__meta-text">
            <h4 class="plx__post-author-name"><strong>{{@$post->user->name}}</strong></h4>
            <div class="plx__time-countdown">
                                                        <span class="plx__countdown"><span
                                                                    class="number">08</span>d : <span
                                                                    class="number">14</span>h : <span
                                                                    class="number">03</span>m : <span
                                                                    class="number">21</span>s</span>
            </div>
        </div>
        <div class="clearfix"></div>
        @if(@$post->user_id != Auth::id())
            <a href="javascript://"
               data-href="{{route('frontend.liked.follow')}}"
               data-id="{{@$post->user->id}}"
               data-post="{{@$post->id}}"
               class="plx__follow-btn {{@$post->user->followers->contains('followed_by',Auth::id())?' added':''}}">{{@$post->user->followers->contains('followed_by',Auth::id())?'Following':'Follow'}}</a>
        @endif
    </div>
    <div class="post-texts">
        <p class="post-title">{{$post->post_details}}</p>
    </div>
    <div class="plx___meta-actions">
        <a href="javascript://"
           data-href="{{route('frontend.liked.like')}}"
           data-id="{{$post->id}}"
           title="{{$post->likes->contains('user.id',Auth::id())?'Unlike':'Like'}}"
           class="plx__like {{$post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a><span>{{$post->likes->count()}}</span>
        <a href="{{route('frontend.post.details',$post->id)}}" title="Comment" class="plx__comment"></a> <span>{{$post->comments->count()}}</span>
        <a href="javascript://" title="Share" class="plx__share"></a> <span>0</span>
    </div>
</div>
<div class="clearfix"></div>