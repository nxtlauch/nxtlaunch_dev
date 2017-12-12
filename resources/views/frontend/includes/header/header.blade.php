<div class="header custom-bg p-r-0 bg-primary">
    <div class="header-inner header-md-height container plx__padding">
        <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu text-white"
           data-toggle="horizontal-menu"></a>

        <div class="">
            <a href="{{route('frontend.home')}}" class="brand inline no-border hidden-xs-down">
                <img src="{{asset('public/frontend-assets/assets/img/logo_white.png')}}" alt="logo"
                     data-src="{{asset('public/frontend-assets/assets/img/logo_white.png')}}"
                     data-src-retina="{{asset('public/frontend-assets/assets/img/logo_white_2x.png')}}" width="78"
                     height="22">
            </a>

        @php
            $notifications= \App\Notification::where('noti_to', Auth::id())->orderBy('created_at','desc')->get();
        @endphp

        <!-- START NOTIFICATION LIST -->
            <ul class="hidden-md-down notification-list no-margin hidden-sm-down b-grey b-l b-r no-style p-l-30 p-r-20">
                <li class="p-r-10 inline">
                    <div class="dropdown">
                        <a href="javascript:;" id="notification-center" class="header-icon pg pg-world"
                           data-toggle="dropdown">
                            @if($notifications->where('status',1)->count()>0)
                                <span class="bubble">{{$notifications->where('status',1)->count()}}</span>
                            @endif
                        </a>
                        <!-- START Notification Dropdown -->
                        <div class="dropdown-menu notification-toggle" role="menu"
                             aria-labelledby="notification-center">
                            <!-- START Notification -->
                            <div class="notification-panel">
                                <!-- START Notification Body-->
                                <div class="notification-body scrollable">
                                    @forelse($notifications as $notification)
                                        @if($notification->noti_for==2 && $notification->noti_activity==6)
                                            @php
                                                $now=Carbon\Carbon::now();
                                                $expired_date=new \Carbon\Carbon($notification->post->expire_date);
                                                $diffInDays=$expired_date->diffInDays($now);
                                                $diffInHuman=$expired_date->diffForHumans($now);
                                            @endphp
                                            @if($notification->post->expire_date < \Carbon\Carbon::now()->toDateTimeString())
                                                @continue
                                            @elseif($diffInDays>7)
                                                @continue
                                            @endif
                                        @endif
                                        <div class="notification-item {{$notification->status==1?' unread':''}} noti_id-{{$notification->id}} clearfix">
                                            <div class="heading">
                                                <a href="{{route('frontend.notification.details', $notification->id)}}"
                                                   class="text-info plx__line-clamp"
                                                   data-id="post_id_{{$notification->purpose_id}}">
                                                    @if($notification->noti_for==2 && $notification->noti_activity==1)
                                                        <i class="fa fa-heart-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong>{{$notification->noti_text>0?" and $notification->noti_text others":''}}
                                                            liked your post <strong> {{$notification->post->post_details}}</strong></span>
                                                    @elseif($notification->noti_for==2 && $notification->noti_activity==2)
                                                        <i class="fa fa-comments-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong> commented in you post <strong> {{$notification->post->post_details}}</strong></span>
                                                    @elseif($notification->noti_for==2 && $notification->noti_activity==4)
                                                        <i class="fa fa-comments-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong> following your post <strong> {{$notification->post->post_details}}</strong></span>

                                                    @elseif($notification->noti_for==2 && $notification->noti_activity==5)
                                                        <i class="fa fa-comments-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong> Launched a new Event<strong> {{$notification->post->post_details}}</strong></span>
                                                    @elseif($notification->noti_for==2 && $notification->noti_activity==6)
                                                        <i class="fa fa-comments-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong> will launch his event<strong> after {{$diffInDays}}
                                                                days</strong></span>
                                                    @elseif($notification->noti_for==3 && $notification->noti_activity==3)
                                                        <i class="fa fa-user-circle-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong> Followed you</span>

                                                    @endif
                                                </a>
                                                <span class="time">{{$notification->created_at->diffForHumans()}}</span>
                                            </div>
                                            <div class="option">
                                                <a href="javascript://" class="mark"></a>
                                            </div>
                                        </div>
                                        <!-- END Notification Item-->
                                    @empty
                                        <div class="notification-item clearfix">
                                            <div class="heading">
                                                <a href="javascript://" class="text-info">
                                                    <i class="fa fa-info-circle m-r-10"></i>
                                                    <span>No Unread Notification</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- END Notification Body-->
                                <!-- START Notification Footer-->
                                <div class="notification-footer text-center">
                                    <a href="{{route('frontend.notifications')}}" class="">Read all notifications</a>
                                    <a data-toggle="refresh" class="portlet-refresh text-black pull-right" href="#">
                                        <i class="pg-refresh_new"></i>
                                    </a>
                                </div>
                                <!-- START Notification Footer-->
                            </div>
                            <!-- END Notification -->
                        </div>
                        <!-- END Notification Dropdown -->
                    </div>
                </li>
            </ul>

            {{--<a href="#" class="search-link hidden-md-down"><i class="pg-search"></i>Type anywhere to <span class="bold">search</span></a>--}}
            <div class="search-form-group">
                <form id="plx__mainSearch" method="get" action="{{route('frontend.search')}}">
                    <input name="q" id="myInput" onkeyup="myFunction()" type="text"
                           class="form-control main-search-form" required
                           placeholder="Search..." autocomplete="off">
                    <i class="search-icon pg-search"></i>

                    <div class="search-result-mini">
                        <ul id="myUL" class="search-list scrollable">
                            {{--@forelse($all_users as $user)
                                <li><a class="user" href="{{route('frontend.user.profile',$user->id)}}">{{$user->name}}</a></li>
                            @empty
                            @endforelse
                            @forelse($search_suggestion as $post)
                                <li><a class="post" href="{{route('frontend.post.details',$post->id)}}">{{$post->post_details}}</a></li>
                            @empty
                            @endforelse--}}
                        </ul>

                        <ul class="search-list alt scrollable">
                            @php
                                $search_sugstns= App\RecentSearch::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
                            @endphp
                            @forelse($search_sugstns as $sugstn)
                                <li class=""><a class="search-keyword" href="javascript://">{{$sugstn->search_text}}</a>
                                </li>
                            @empty
                                <li><a href="javascript://">No Recent Search available</a></li>
                            @endforelse
                            {{--<li class=""><a class="user" href="">John Doe</a></li>--}}
                            {{--<li class=""><a class="user" href="">John Doe</a></li>--}}
                            {{--<li class=""><a class="post" href="">Consectetur adipisicing elit. Iusto maxime molestiae--}}
                            {{--perspiciatis.</a></li>--}}
                            {{--<li class=""><a class="post" href="">Consectetur adipisicing elit. Iusto maxime molestiae--}}
                            {{--perspiciatis.</a></li>--}}
                            {{--<li class=""><a class="post" href="">Consectetur adipisicing elit. Iusto maxime molestiae--}}
                            {{--perspiciatis.</a></li>--}}
                        </ul>
                        <div class="read-more">
                            <button type="submit" class="more-btn">See all result for <strong
                                        class="plxKeyword"></strong></button>
                        </div>
                    </div>
                </form>
            </div>


        </div>

        <div class="d-flex align-items-center">
            <!-- START User Info-->
            <a href="{{Auth::user()->role_id==4?route('frontend.newlaunch'):'javascript://'}}"
               @if(Auth::user()->role_id!=4)data-toggle="modal" data-target="#proUser" @endif
               title="Launch An Event"  class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"><img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUBAMAAAB/pwA+AAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAtUExURf///////0dwTP////////////////////////////////////////////////zKVJ0AAAAPdFJOU/nfAAoqoYI5GGqwWc1AxF/GqhEAAACnSURBVAgdY1CCAOWbuQwQlnoAAzeEqbGAgYEXwnRkYGBgBjNVBHgYGB6BmY0MRRcYJoGYyg8YlBQYjBiUlI21GBgyEjiVGJQcOBOAmhgWKTFoCESDWFxGSgyqPAUgZpASUHSLAJDFBtTNoKQLEtwEZpo/YGAQB7KAoo0+DDyuYKZ65JEF4YJg5i6niR4buMDMx9pJSgnBYOaJO01KniCWEsOrEDANJADToyZjd5vZCQAAAABJRU5ErkJggg=="></a>
            <a href="{{route('frontend.home')}}"
               class="header-icon pg pg-alt_menu btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"
               title="Home"></a>
            {{--<a  href="{{route('frontend.home')}}" class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"><img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUBAMAAAB/pwA+AAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAtUExURf///////0dwTP////////////////////////////////////////////////zKVJ0AAAAPdFJOU/nfAAoqoYI5GGqwWc1AxF/GqhEAAACnSURBVAgdY1CCAOWbuQwQlnoAAzeEqbGAgYEXwnRkYGBgBjNVBHgYGB6BmY0MRRcYJoGYyg8YlBQYjBiUlI21GBgyEjiVGJQcOBOAmhgWKTFoCESDWFxGSgyqPAUgZpASUHSLAJDFBtTNoKQLEtwEZpo/YGAQB7KAoo0+DDyuYKZ65JEF4YJg5i6niR4buMDMx9pJSgnBYOaJO01KniCWEsOrEDANJADToyZjd5vZCQAAAABJRU5ErkJggg=="></a>
            <a href="{{Auth::user()->role_id==4?route('frontend.newlaunch'):'javascript://'}}"
               @if(Auth::user()->role_id!=4)data-toggle="modal" data-target="#proUser" @endif
               class="header-icon pg pg-alt_menu btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"
               title="Launch An Event"></a>--}}
            <a href="{{route('frontend.my.liked')}}"
               class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"
               title="My Liked"><img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUBAMAAAB/pwA+AAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAtUExURf///0dwTP///////////////////////////////////////////////////0Ev7+QAAAAOdFJOUw8ARCQ/ZtEHMuxgaG+d9WK6ngAAAHpJREFUCB1jEIQDBpHQqEIIj8Hu3buLUKbfu3fP0kDgIgOQCQHPGSo6oKCRoQ8h6gdjPgCpnbPt1r1378BMR3FBaSgTaIUwlKkoKCgDZSYIClpCmc8KBfKgzHcJZkATwSa8ezYPzgQyQKKcYBpITGQQVoICRgaIs0EkAA2ncXEBvGMPAAAAAElFTkSuQmCC"></a>
            <a href="{{route('frontend.my.follow')}}"
               class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"><i
                        class="fa fa-plus"></i></a>
            <div class="pull-left p-r-5 fs-14 font-heading hidden-md-down text-white">
                <span class="semi-bold">{{Auth::user()->name}}</span>
            </div>
            <div class="dropdown pull-right">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline sm-m-r-5">
{{--                <img src="{{asset('public/frontend-assets')}}/assets/img/profiles/avatar.jpg" alt="" data-src="{{asset('public/frontend-assets')}}/assets/img/profiles/avatar.jpg" data-src-retina="{{asset('public/frontend-assets')}}/assets/img/profiles/avatar_small2x.jpg" width="32" height="32">--}}
                    <img src="{{@Auth::user()->userDetails->profile_picture?asset('content-dir/profile_picture/'.Auth::user()->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}"
                         alt=""
                         data-src="{{@Auth::user()->userDetails->profile_picture?asset('content-dir/profile_picture/'.Auth::user()->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}"
                         data-src-retina="{{@Auth::user()->userDetails->profile_picture?asset('content-dir/profile_picture/'.Auth::user()->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}"
                         width="32" height="32">
                </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="{{route('frontend.my.profile')}}"
                       {{--                    <a href="{{Auth::user()->role_id==4?route('frontend.my.profile'):'javascript://'}}"--}}
                       {{--@if(Auth::user()->role_id!=4)data-toggle="modal" data-target="#proUserFeature"
                       @endif--}} class="dropdown-item"><i class="pg-outdent"></i> My Profile</a>
                    <a href="{{route('frontend.edit.myprofile')}}" class="dropdown-item"><i
                                class="pg-settings_small"></i>
                        Settings</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                       class="clearfix bg-master-lighter dropdown-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <span class="pull-left">Logout</span>
                        <span class="pull-right"><i class="pg-power"></i></span>
                    </a>
                </div>
            </div>
            <!-- END User Info-->
            <a href="#" class="header-icon btn-link m-l-10 pg pg-comment sm-no-margin d-inline-block"
               data-toggle="quickview" data-toggle-element="#quickview"></a>
        </div>
    </div>
</div>