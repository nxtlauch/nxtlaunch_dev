<div class="plx__post-header">
    <div class="plx__post-author-avatar"
         style="background-image: url('{{@$post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
    <div class="plx__meta-text">
        <h4 class="plx__post-author-name">
            <strong><a href="{{route('frontend.user.profile',$post->user->id)}}"
                       style="color: #000000">{{$post->user->name}}</a></strong></h4>
    </div>
    <div class="clearfix"></div>
    @if($post->user_id != Auth::id())
        <a href="javascript://" data-href="{{route('frontend.follow.user')}}" data-id="{{$post->user->id}}"
           class="plx__follow-btn {{$post->user->followers->contains('followed_by',Auth::id())?' added':''}}">{{$post->user->followers->contains('followed_by',Auth::id())?'Following':'Follow'}}</a>
    @endif
</div>
<div class="ratio-4-3 plx__post-thumb"
     style="background-image: url('{{asset('content-dir/posts/images/'.$post->image)}}')"></div>
<div class="plx__post-info">
    <div class="plx__time-countdown m-b-5">
        @php($days=\Carbon\Carbon::parse($post->expire_date)->diffInDays())
        <span class="plx__countdown {{$days<7?'text-danger':($days<30?'text-warning':'text-success')}}"
              data-date-time="{{$post->expire_date}}">
                    <span class="number day">08</span>d :
                    <span class="number hour">14</span>h :
                    <span class="number minutes">03</span>m :
                    <span class="number seconds">21</span>s
                </span>
    </div>

    <div class="plx___meta-actions">
        <div class="pull-left">
            <a href="javascript://"
               data-href="{{route('frontend.like.post')}}"
               data-id="{{$post->id}}"
               title="{{$post->likes->contains('user.id',Auth::id())?'Unlike':'Like'}}"
               class="plx__like {{$post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a>
            <a title="Comment" class="plx__comment leaveComment" href="#commentFor-{{$post->id}}"></a>
            <span class="post-share">
                        <a href="#modalId-{{$post->id}}" title="Share" class="plx__share sharePopup"></a>

                        <div id="modalId-{{$post->id}}" class="social-list-modal" style="display: none;">
                            <a href="#modalId-{{$post->id}}" class="btnClose">&times;</a>
                            <p><strong>Share:</strong></p>
                            <ul class="plx__social-list m-b-20">
                                <li><a href="{{Share::load(route('frontend.post.details.id',$post->id))->facebook()}}"
                                       class="bg-facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{Share::load(route('frontend.post.details.id',$post->id))->gplus()}}"
                                       class="bg-google-plus"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="{{Share::load(route('frontend.post.details.id',$post->id))->twitter()}}"
                                       class="bg-twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="mailto:?body={{route('frontend.post.details.id',$post->id)}}"
                                       class="bg-mail"><i class="fa fa-envelope-o"></i></a></li>
                                <li><a href="#postLink-{{$post->id}}" class="copyLink bg-copy"><i
                                                class="fa fa-files-o"></i></a></li>
                            </ul>
                            <input id="postLink-{{$post->id}}" type="text" class="form-control"
                                   value="{{route('frontend.post.details.id',$post->id)}}" readonly>
                        </div>
                    </span>
        </div>
        <div class="pull-right">
            <div class="options">
                <a href="javascript://" class="options-dot"></a>
                <ul class="options-list">
                    @if(!$post->postReports->contains('user_id',Auth::id()))
                        <li><a href="javascript://" class="plx__report12" data-post="{{$post->id}}">Report</a>
                        </li>
                    @else
                        <li><a href="javascript://" data-post="{{$post->id}}">Reported</a></li>
                    @endif
                    {{--<li><a href="#">Copy Link</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
    <div class="post-texts">
        @if($post->likes->count())
            <p class="text-muted"><strong>Liked
                    by {{$post->likes->contains('user_id',Auth::id())?'you':$post->likes->last()->user->name}}</strong>
                @if($post->likes->count()-1)
                    and
                    {{$post->likes->count()-1}}
                    others</p>
        @endif
        @else
            <p class="text-muted"><strong>No like yet</strong></p>
        @endif
        <p class="post-title">{{$post->post_details}}</p>
        <p><a class="leaveComment" href="#commentFor-{{$post->id}}">View all
                comments({{$post->comments->count()}}
                )</a></p>
        {{--<p><a href="{{route('frontend.post.details',$post->id)}}">View all comments({{$post->comments->count()}}--}}
        {{--)</a></p>--}}
        {{--@if($post->comments->count()>0)
            <div class="plx__comments">
                <p><strong>{{$post->comments->last()->user->name}}</strong> {{$post->comments->last()->comment}}
                </p>
            </div>
        @else
            <div class="plx__comments">
                <p>No comment yet</p>
            </div>
        @endif--}}

        <div id="commentFor-{{$post->id}}" class="post-comments" style="display: none">
            <hr>
            <form method="post" data-id="{{$post->id}}" class="postComment"
                  action="{{route('frontend.post.comment',$post->id)}}"
                  class="m-t-30">
                {{csrf_field()}}
                <div class="form-group">
                                                    <textarea name="comment" class="form-control" style="height: 60px;"
                                                              maxlength="255"
                                                              placeholder="Write a comment..." required></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-info">Comment</button>
                </div>
            </form>

            <h5>Comments ({{$post->comments->count()}})</h5>
            <hr>
            <ul class="plx__comment-list">
                @forelse($post->comments->sortByDesc('id') as $comment)
                    {{--{{dd($comment->user->name)}}--}}
                    <li>
                        <div class="user-avatar"
                             style="background-image: url('{{@$comment->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$comment->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                        <div class="comment-text">
                            <p class="text"><strong
                                        class="m-r-5">{{$comment->user->name}}</strong>
                                {{$comment->comment}}</p>
                            <p class="muted-text">{{@$comment->created_at->diffForHumans()}}</p>
                        </div>
                    </li>
                @empty
                    <li>No comments yet</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>