@forelse($posts as $post)
    @if($post->user->where('status',0)->first())
        @continue
    @endif

    <div class="plx__post" id="post_id_{{$post->id}}">
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
                {{--<a href="javascript://" data-href="{{route('frontend.follow.user')}}" data-id="{{$post->user->id}}"
                   class="plx__follow-btn user-follow_{{$post->user->id}} {{$post->user->followers->contains('followed_by',Auth::id())?' added':''}}">{{$post->user->followers->contains('followed_by',Auth::id())?'Following':'Follow'}}</a>--}}
                <a href="javascript://" data-href="{{route('frontend.follow.post')}}" data-id="{{$post->id}}"
                   class="plx__follow-btn user-follow_{{$post->id}} {{$post->follows->contains('user_id',Auth::id())?' added':''}}">{{$post->follows->contains('user_id',Auth::id())?'Following':'Follow'}}</a>
            @endif

            <p class="post-title">{{$post->post_details}}</p>
        </div>

        <div class="ratio-4-3 plx__post-thumb"
             style="background-image: url('{{asset('content-dir/posts/images/'.$post->image)}}')"></div>
        <div class="plx__post-info">
            <div class="plx__time-countdown m-b-5">
                @php($days=\Carbon\Carbon::parse($post->expire_date)->diffInDays())
                <span title="{{\Carbon\Carbon::parse($post->expire_date)->format('M d, Y H:i')}}" data-toggle="tooltip"
                      class="plx__countdown {{$days<7?'text-danger':($days<30?'text-warning':'text-success')}}"
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
                    <a href="#commentContainer{{$post->id}}" title="Comment" class="plx__comment toggleComment"></a>
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
                {{--<p class="text-muted Plx__like__count">
                    @include('frontend.home.render.likeCount')
                </p>--}}

                <style>
                    .max-height-200 {
                        max-height: 150px;
                    }
                </style>
                <div id="commentContainer{{$post->id}}" style="display: none;">

                    @php($comments=$post->comments->sortByDesc('id')->take(2)->reverse())

                    {{--<p><a class="leaveComment {{$post->comments->count()>2?'hidden':''}} no-more-comment">Comments(<span--}}
                    {{--class="commentsCount">{{$post->comments->count()}}</span>)</a></p>--}}
                    {{--                    <p><a href="{{route('frontend.post.details',$post->id)}}" class="leaveComment {{$post->comments->count()>2?'hidden':''}}">Comments(<span class="commentsCount">{{$post->comments->count()}}</span>)</a></p>--}}

                    <p class="text-muted Plx__comment__count">
                        @include('frontend.home.render.commentCount')
                    </p>
                    <a href="#" data-id="{{$post->id}}" data-count="{{$comments->count()}}"
                       class="leaveComment {{$post->comments->count()<=2?' hidden':''}} load-more-comment">Load more
                        comments</a>
                    <input class="showingCommentCount" type="hidden" value="{{$comments->count()}}">
                    {{--                    <p><a href="{{route('frontend.post.details',$post->id)}}" data-id="{{$post->id}}" data-count="{{$comments->count()}}" class="leaveComment {{$post->comments->count()<=2?' hidden':''}}">View all comments</a></p>--}}

                    <div class="scrollable max-height-200">
                        <ul id="commentFor-{{$post->id}}" class="plx__comment-list">
                            @include('frontend.home.render.comment.comments')
                        </ul>
                    </div>

                    <div class="post-comments">
                        <form method="post" data-id="{{$post->id}}" class="postComment"
                              action="{{route('frontend.post.comment',$post->id)}}">
                            {{--{{csrf_field()}}--}}
                            <div class="form-group comment-form">
                                <input class="textareaComment" type="text" name="comment"
                                       placeholder="Write a comment..." required autocomplete="off">
                                <button type="submit" class="submit-btn" disabled><i class="fa fa-paper-plane"></i></button>
                            </div>
                            <div class="text-right">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@empty
    <h3 class="text-center">No Post Found</h3>
@endforelse