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
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" id="likeRender">
                                {{--@include('frontend.followings.render.followingrender')--}}
                                <h4 class="m-b-30">Search result for <strong>{{$search_key}}</strong></h4>
                                <ul class="search-tab">
                                    <li><a href="#postResult" class="tab-item active">Post</a></li>
                                    <li><a href="#userpostResult" class="tab-item">Users</a></li>
                                </ul>

                                <div class="search-results">
                                    <div id="postResult" class="plx__tab-content active">
                                        @forelse($posts as $post)
                                            {{--@if($post->expire_date < \Carbon\Carbon::now()->toDateTimeString())
                                                @continue
                                            @endif--}}
                                            <div class="plx__post alt" id="post_id_{{$post->id}}">
                                                <div class="ratio-4-3 plx__post-thumb"
                                                     style="background-image: url('{{asset('content-dir/posts/images/'.$post->image) }}')"></div>
                                                <div class="plx__post-info">
                                                    <div class="plx__post-header">
                                                        <div class="plx__post-author-avatar"
                                                             style="background-image: url('{{@$post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                                        <div class="plx__meta-text">
                                                            <h4 class="plx__post-author-name">
                                                                <strong>{{@$post->user->name}}</strong></h4>
                                                            <div class="plx__time-countdown">
                                                                @php($days=\Carbon\Carbon::parse($post->expire_date)->diffInDays())
                                                                <span class="plx__countdown {{$days<7?'text-danger':($days<30?'text-warning':'text-success')}}"
                                                                      data-date-time="{{$post->expire_date}}">
                    <span class="number day">08</span>d :
                    <span class="number hour">14</span>h :
                    <span class="number minutes">03</span>m :
                    <span class="number seconds">21</span>s
                </span>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        @if(@$post->user_id != Auth::id())
                                                            <a href="javascript://"
                                                               data-href="{{route('frontend.follow.user')}}"
                                                               data-id="{{@$post->user->id}}"
                                                               data-post="{{@$post->id}}"
                                                               class="plx__follow-btn user-follow_{{@$post->user->id}} {{@$post->user->followers->contains('followed_by',Auth::id())?' added':''}}">{{@$post->user->followers->contains('followed_by',Auth::id())?'Following':'Follow'}}</a>
                                                        @endif
                                                    </div>
                                                    <div class="post-texts">
                                                        <p class="post-title">{{$post->post_details}}</p>
                                                    </div>
                                                    <div class="plx___meta-actions">

                                                        <a href="javascript://"
                                                           data-href="{{route('frontend.like.post')}}"
                                                           data-id="{{$post->id}}"
                                                           title="{{$post->likes->contains('user.id',Auth::id())?'Unlike':'Like'}}"
                                                           class="plx__like {{$post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a><span
                                                                class="likeCount">{{$post->likes->count()}}</span>
                                                        {{--                                                        <a href="{{route('frontend.home')."#post_id_$post->id"}}"--}}
                                                        <a href="{{route('frontend.post.details',$post->id)}}"
                                                           title="Comment" class="plx__comment"></a>
                                                        <span>{{$post->comments->count()}}</span>
                                                        {{--<a href="javascript://" title="Share" class="plx__share"></a> <span>0</span>--}}
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        @empty
                                            <h5>No Post found like <strong> &nbsp;{{$search_key}}</strong></h5>
                                        @endforelse
                                    </div>
                                    <div id="userpostResult" class="plx__tab-content">
                                        <div class="row">
                                            @forelse($brands as $user)
                                                @if($user->id==Auth::id())
                                                    @continue
                                                @endif
                                                <div class="col-sm-4">
                                                    <div class="user-block">
                                                        <a href="{{route('frontend.user.profile',$user->id)}}"
                                                           class="user-avatar ratio-1-1"
                                                           style="background-image: url('{{@$user->userDetails->profile_picture?asset('content-dir/profile_picture/'.$user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></a>
                                                        <div class="user-info">
                                                            <h4 class="name"><a
                                                                        href="{{route('frontend.user.profile',$user->id)}}">{{$user->name}}</a>
                                                            </h4>
                                                            @if($user->id != Auth::id())
                                                                <a href="javascript://"
                                                                   data-href="{{route('frontend.follow.user')}}"
                                                                   data-id="{{$user->id}}"
                                                                   class="btn m-t-10 btn-sm btn-block plx__follow-btn user-follow_{{$user->id}} {{$user->followers->contains('followed_by',Auth::id())?' added':''}}">{{$user->followers->contains('followed_by',Auth::id())?'Following':'Follow'}}</a>
                                                            @endif
                                                            {{--<a href="#" class="btn m-t-10 btn-sm btn-primary btn-block">{{$user->followers->contains('followed_by',Auth::id())?"Following":"Follow"}}</a>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                No User found like <strong> &nbsp;{{$search_key}}</strong>
                                            @endforelse
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

@endsection

@section('scripts')

    <script>
        (function ($) {
            'use strict';
            customTab('.tab-item', '.plx__tab-content');
        }(jQuery));

        function customTab(element, container) {
            $(element).on('click', function (e) {
                e.preventDefault();
                let targetContainer = $(this).attr('href');
                $(element).removeClass('active');
                $(this).addClass('active');
                $(container).removeClass('active');
                $(targetContainer).addClass('active');
            })
        }
    </script>
@endsection