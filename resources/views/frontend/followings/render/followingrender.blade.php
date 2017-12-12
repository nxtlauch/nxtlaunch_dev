@forelse($posts as $post)
    {{--@if($post->post->expire_date < \Carbon\Carbon::now()->toDateTimeString())
        @continue
    @endif--}}
    <div class="plx__post alt" id="post_id_{{$post->post->id}}">
        <div class="ratio-4-3 plx__post-thumb"
             style="background-image: url('{{asset('content-dir/posts/images/'.$post->post->image) }}')"></div>
        <div class="plx__post-info">
            <div class="plx__post-header">
                <div class="plx__post-author-avatar"
                     style="background-image: url('{{@$post->post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                <div class="plx__meta-text">
                    <h4 class="plx__post-author-name">
                        <strong>{{@$post->post->user->name}}</strong></h4>
                    <div class="plx__time-countdown">
                        @php($days=\Carbon\Carbon::parse($post->post->expire_date)->diffInDays())
                        <span title="{{\Carbon\Carbon::parse($post->expire_date)->format('M d, Y H:i')}}" class="plx__countdown {{$days<7?'text-danger':($days<30?'text-warning':'text-success')}}"
                              data-date-time="{{$post->post->expire_date}}">
                    <span class="number day">08</span>d :
                    <span class="number hour">14</span>h :
                    <span class="number minutes">03</span>m :
                    <span class="number seconds">21</span>s
                </span>
                    </div>
                </div>
                <div class="clearfix"></div>
                @if(@$post->post->user_id != Auth::id())
                    <a href="javascript://"
                       data-href="{{route('frontend.follow.post')}}"
                       data-id="{{@$post->post->id}}"
                       data-post="{{@$post->post->id}}"
                       class="plx__follow-btn user-follow_{{@$post->post->id}} {{@$post->post->follows->contains('user_id',Auth::id())?' added':''}}">{{$post->post->follows->contains('user_id',Auth::id())?'Following':'Follow'}}</a>
                @endif
            </div>
            <div class="post-texts">
                <p class="post-title">{{$post->post->post_details}}</p>
            </div>
            <div class="plx___meta-actions">

                <a href="javascript://"
                   data-href="{{route('frontend.like.post')}}"
                   data-id="{{$post->post->id}}"
                   title="{{$post->post->likes->contains('user.id',Auth::id())?'Unlike':'Like'}}"
                   class="plx__like {{$post->post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a><span
                        class="likeCount">{{$post->post->likes->count()}}</span>
{{--                <a href="{{route('frontend.home')."#post_id_".$post->post->id}}" title="Comment" class="plx__comment"></a>--}}
                <a href="{{route('frontend.post.details',$post->post->id)}}" title="Comment" class="plx__comment"></a>
                <span>{{$post->post->comments->count()}}</span>
                {{--<a href="javascript://" title="Share" class="plx__share"></a> <span>0</span>--}}
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@empty
    <h4 class="text-center">You Don't Like any Post</h4>
@endforelse