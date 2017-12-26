@extends('frontend.layouts.master')

@section('styles')

@endsection

@section('contents')

    <div class="page-container ">
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
            <!-- START PAGE CONTENT -->
            <div class="content">
                <div class="plx__container">
                    <!-- START CONTAINER FLUID -->
                    <div class=" container  container-fixed-lg">
                        <!-- BEGIN PlACE PAGE CONTENT HERE -->

                        <div id="mainContainer" class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row">

                                    <div class="col-lg-12 col-sm-12 d-flex flex-column" id="postrender">
                                        {{--<div class="col-lg-4 col-sm-4 d-flex flex-column">
                                            <div class="plx__sidebar plx__filter-bar">
                                                <div class="plx__sidebar-inner plx__filter-bar-inner">
                                                    <!-- START Profile -->
                                                    <div class="bg-white profile-header">
                                                        @if($user->id==Auth::id())
                                                            <a href="{{route('frontend.edit.myprofile')}}"
                                                               class="plx__edit-btn"><i
                                                                        class="fa fa-edit"></i>&nbsp; Edit</a>
                                                        @else
                                                            <div class="options">
                                                                <a href="javascript://" class="options-dot"></a>
                                                                <ul class="options-list">
                                                                    @if(!$user->userReports->contains('reported_by',Auth::id()))
                                                                        <li><a href="javascript://" class="Plx-report-user"
                                                                               data-href="{{route('frontend.report.user',$user->id)}}">Report</a>
                                                                        </li>
                                                                    @else
                                                                        <li><a href="javascript://"
                                                                               data-post="{{$user->id}}">Reported</a></li>
                                                                    @endif
                                                                    <li><a href="javascript://" class="plx___user__follow" data-id="{{$user->id}}"
                                                                           data-href="{{route('frontend.follow.user')}}">{{$user->followers->contains('followed_by',Auth::id())?'Following':'Follow'}}</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif

                                                        <div class="profile-avatar ratio-1-1"
                                                             style="background-image: url('{{@$user->userDetails->profile_picture?asset('content-dir/profile_picture/'.$user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                                        <h4 class="profile-name">{{$user->name}}</h4>
                                                        <p class="text-bio">{{@$user->userDetails->business_description}}</p>
                                                        <ul class="social-list">
                                                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                                            </li>
                                                            <li><a href="#" class="youtube"><i
                                                                            class="fa fa-youtube"></i></a></li>
                                                            <li><a href="#" class="pinterest"><i
                                                                            class="fa fa-google-plus"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <!-- END Profile -->
                                                </div>
                                            </div>
                                        </div>--}}

                                        <div class="profile-area">
                                            <div class="options" style=" position: absolute; top: 25px; right: 30px;">
                                                @if($user->id==Auth::id())
                                                    <a href="{{route('frontend.edit.myprofile')}}"
                                                       class="plx__edit-btn"><i
                                                                class="fa fa-edit"></i>&nbsp; Edit</a>
                                                @else
                                                    <a href="javascript://" class="options-dot"></a>
                                                    <ul class="options-list">
                                                        @if(!$user->userReports->contains('reported_by',Auth::id()))
                                                            <li><a href="javascript://" class="Plx-report-user"
                                                                   data-href="{{route('frontend.report.user',$user->id)}}">Report</a>
                                                            </li>
                                                        @else
                                                            <li><a href="javascript://"
                                                                   data-post="{{$user->id}}">Reported</a></li>
                                                        @endif
                                                    </ul>
                                                @endif
                                            </div>
                                            <div class="profile-content clearfix m-b-20">
                                                <div class="profile-avatar"
                                                     style="background-image: url('{{@$user->userDetails->profile_picture?asset('content-dir/profile_picture/'.$user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                                <div class="profile-info">
                                                    <div class="info-header">
                                                        <div class="">
                                                            <h2 class="name">{{$user->name}}</h2>
                                                            @if($user->id!=Auth::id())
                                                                <a href="javascript://"
                                                                   class="floatedBtn btn btn-xs btn-primary plx___user__follow"
                                                                   data-id="{{$user->id}}"
                                                                   data-href="{{route('frontend.follow.user')}}">{{$user->followers->contains('followed_by',Auth::id())?'Following':'Follow'}}</a>
                                                            @endif
                                                        </div>
                                                        <p>{{@$user->userDetails->business_description}}</p>
                                                        {{--<ul class="social-list">--}}
                                                        {{--<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a>--}}
                                                        {{--</li>--}}
                                                        {{--<li><a href="#" class="youtube"><i--}}
                                                        {{--class="fa fa-youtube"></i></a></li>--}}
                                                        {{--<li><a href="#" class="pinterest"><i--}}
                                                        {{--class="fa fa-google-plus"></i></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="plx__tabs">
                                                <li class="tab-item"><a href="#userPosts" class="active"><i
                                                                class="pg-unordered_list"></i> Posts</a></li>
                                                <li class="tab-item"><a href="#followingPosts"><i
                                                                class="pg-alt_menu"></i> Following Posts</a></li>
                                                <li class="tab-item"><a href="#followingUsers"><i class="pg-plus"></i>
                                                        Following Users</a></li>
                                            </ul>
                                        </div>


                                        <div id="plx__tabs-content">
                                            <div id="userPosts" class="plx__tabs-item active">
                                                <ul class="plx__tabs-alt forPost clearfix">
                                                    <li class="tab-item"><a class="active" href="#myListLaunches">Launches</a>
                                                    </li>
                                                    <li class="tab-item"><a href="#myListLaunched">Launched</a></li>
                                                </ul>

                                                <div id="myListLaunches" class="forPostContent tab-content active">
                                                    @forelse($posts->where('expire_date', '>', Carbon\Carbon::now()->toDateTimeString()) as $post)

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
                                                                    <p class="text-muted Plx__like__count">
                                                                        @include('frontend.home.render.likeCount')
                                                                    </p>

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
                                                        <div class="alert alert-info text-center" role="alert">
                                                            No post found
                                                        </div>
                                                    @endforelse
                                                </div>

                                                <div id="myListLaunched" class="forPostContent tab-content">

                                                    @forelse($posts->where('expire_date', '<', Carbon\Carbon::now()->toDateTimeString()) as $post)

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
                                                                    <span title="{{\Carbon\Carbon::parse($post->expire_date)->format('M d, Y H:i')}}" data-toggle="tooltip"
                                                                          class="plx__countdown text-danger"
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
                                                                    <p class="text-muted Plx__like__count">
                                                                        @include('frontend.home.render.likeCount')
                                                                    </p>

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
                                                        <div class="alert alert-info text-center" role="alert">
                                                            No post Launched Yet
                                                        </div>
                                                    @endforelse
                                                </div>

                                            </div>

                                            <div id="followingPosts" class="plx__tabs-item">
                                                <ul class="plx__tabs-alt forFollowing clearfix">
                                                    <li class="tab-item"><a class="active" href="#followingLaunches">Launches</a>
                                                    </li>
                                                    <li class="tab-item"><a href="#followingLaunched">Launched</a></li>
                                                </ul>
                                                <div id="followingLaunches"
                                                     class="forFollowingContent tab-content active">
                                                    {{--{{dd($user->followPosts->)}}--}}
                                                    @forelse($user->followPosts->where('post.expire_date','>',Carbon\Carbon::now()->toDateTimeString())->sortByDesc('id') as $post)
                                                        <div class="plx__post alt" id="post_id_{{$post->post->id}}">
                                                            <div class="ratio-4-3 plx__post-thumb"
                                                                 style="background-image: url('{{asset('content-dir/posts/images/'.$post->post->image) }}')"></div>
                                                            <div class="plx__post-info">
                                                                <div class="plx__post-header">
                                                                    <div class="plx__post-author-avatar"
                                                                         style="background-image: url('{{@$post->post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                                                    <div class="plx__meta-text">
                                                                        <h4 class="plx__post-author-name">
                                                                            <strong>{{@$post->post->user->name}}</strong>
                                                                        </h4>
                                                                        <div class="plx__time-countdown">
                                                                            @php($days=\Carbon\Carbon::parse($post->post->expire_date)->diffInDays())
                                                                            <span title="{{\Carbon\Carbon::parse($post->expire_date)->format('M d, Y H:i')}}"
                                                                                  class="plx__countdown {{$days<7?'text-danger':($days<30?'text-warning':'text-success')}}"
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
                                                                    <a href="{{route('frontend.post.details',$post->post->id)}}"
                                                                       title="Comment" class="plx__comment"></a>
                                                                    <span>{{$post->post->comments->count()}}</span>
                                                                    {{--<a href="javascript://" title="Share" class="plx__share"></a> <span>0</span>--}}
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    @empty
                                                        <h4 class="text-center">{{$user->id==Auth::id()?'You':$user->name}}
                                                            didn't follow any post yet</h4>
                                                    @endforelse
                                                </div>
                                                <div id="followingLaunched" class="forFollowingContent tab-content">
                                                        {{--{{dd($user->followPosts->)}}--}}
                                                        @forelse($user->followPosts->where('post.expire_date','<',Carbon\Carbon::now()->toDateTimeString())->sortByDesc('id') as $post)
                                                            <div class="plx__post alt" id="post_id_{{$post->post->id}}">
                                                                <div class="ratio-4-3 plx__post-thumb"
                                                                     style="background-image: url('{{asset('content-dir/posts/images/'.$post->post->image) }}')"></div>
                                                                <div class="plx__post-info">
                                                                    <div class="plx__post-header">
                                                                        <div class="plx__post-author-avatar"
                                                                             style="background-image: url('{{@$post->post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                                                        <div class="plx__meta-text">
                                                                            <h4 class="plx__post-author-name">
                                                                                <strong>{{@$post->post->user->name}}</strong>
                                                                            </h4>
                                                                            <div class="plx__time-countdown">
                                                                                <span title="{{\Carbon\Carbon::parse($post->expire_date)->format('M d, Y H:i')}}"
                                                                                      class="plx__countdown text-danger"
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
                                                                        <a href="{{route('frontend.post.details',$post->post->id)}}"
                                                                           title="Comment" class="plx__comment"></a>
                                                                        <span>{{$post->post->comments->count()}}</span>
                                                                        {{--<a href="javascript://" title="Share" class="plx__share"></a> <span>0</span>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        @empty
                                                            <h4 class="text-center">{{$user->id==Auth::id()?'Your':$user->name."'s"}}
                                                                followed any post doesn't launch yet</h4>
                                                        @endforelse
                                                </div>
                                            </div>
                                            <div id="followingUsers" class="plx__tabs-item">
                                                <ul class="brand-list">
                                                    @forelse($user->followedBy as $brand)
                                                        <li>
                                                            <a href="{{route('frontend.user.profile',$brand->user_id)}}">
                                                                <div class="brand-avatar ratio-1-1"
                                                                     {{--style="background-image: url('http://waterfaucets.net/wp-content/uploads/2017/05/remarkable-apple-office-interior-design-office-interior-design-retail-design.jpg')">--}}
                                                                     style="background-image: url('{{@$brand->followersOf->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$brand->followersOf->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')">
                                                                </div>
                                                                <div class="brand-details">
                                                                    <div class="brand-details-header">
                                                                        <h2 class="brand-name">{{$brand->followersOf->name}}</h2>
                                                                        <p class="brand-bio">{{@$brand->followersOf->userDetails->business_description}}</p>
                                                                        {{--<a href="javascript://" class="plx__follow-btn">Follow</a>--}}
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-4 col-sm-4">
                                                                            <span class="muted-title">This Month</span>
                                                                            <span class="number">{{@$brand->followersOf->posts->where('created_at','>=',date("Y-m-d H:i:s", strtotime('-1 month')))->count()}}</span>
                                                                        </div>
                                                                        <div class="col-xs-4 col-sm-4">
                                                                            <span class="muted-title">Total Post</span>
                                                                            <span class="number">{{@$brand->followersOf->posts->count()}}</span>
                                                                        </div>
                                                                        <div class="col-xs-4 col-sm-4">
                                                                            <span class="muted-title">Total Follower</span>
                                                                            <span class="number">{{@$brand->followersOf->followers->count()}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @empty
                                                        <h4 class="text-center">{{$user->id==Auth::id()?'You':$user->name}}
                                                            didn't follow any user yet</h4>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- END PLACE PAGE CONTENT HERE -->
                    </div>
                    <!-- END CONTAINER FLUID -->
                </div>
            </div>
            <!-- END PAGE CONTENT -->

            @include('frontend.includes.footer.footer')
        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    {{--modal--}}
    <div class="modal fade" id="reportUserModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <form id="reportUserForm" method="post" class="modal-content">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reason </h4>
                </div>
                <div class="modal-body">
                <textarea name="report_description" rows="4" class="form-control" style="resize: none; height: 80px"
                          required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Report</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="{{asset('public/frontend-assets')}}/assets/js/sticky-sidebar.js"></script>

    <script>
        /*follow*/
        $(document).on("click", ".plx___user__follow", function (e) {
            e.preventDefault();
            var changeHtml = $(this);
            var link = $(this).data('href');
            var user_id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: link,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'user_id': user_id
                },
                dataType: 'json',
                success: function (data) {
                    if (data.status == 1) {
                        changeHtml.html("Following");
                    }
                    else {
                        changeHtml.html("Follow");
                    }
//                    $(".user-follow_" + user_id).removeClass('add')

                    /*$("#postrender").empty();
                    $("#postrender").html(data);
                    shouldInit();*/
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        /*End follow*/
    </script>

    <script type="text/javascript">
        $(document).on('click', '.Plx-report-user', function (e) {
            var actionUrl = $(this).data('href');

            $('#reportUserForm').attr('action', actionUrl);
            $('#reportUserModal').modal('show');
        })
    </script>

@endsection