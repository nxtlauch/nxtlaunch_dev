<div class="header custom-bg p-r-0 bg-primary">
    <div class="header-inner header-md-height container plx__padding">
        <div class="d-flex align-items-center">
            <a href="{{route('frontend.home')}}" class="brand inline no-border hidden-xs-down">
                <img class="for-desktop" src="{{asset('public/frontend-assets/assets/img/logo_white.png')}}" alt="logo"
                     data-src="{{asset('public/frontend-assets/assets/img/logo_white.png')}}"
                     data-src-retina="{{asset('public/frontend-assets/assets/img/logo_white_2x.png')}}" width="78"
                     height="22">

                <img class="for-mobile" src="{{asset('public/frontend-assets/assets/img/nxt_logo.png')}}" alt="logo"
                     data-src="{{asset('public/frontend-assets/assets/img/nxt_logo.png')}}"
                     data-src-retina="{{asset('public/frontend-assets/assets/img/nxt_logo_2x.png')}}"
                     height="30">
            </a>

        @php
            $notifications= \App\Notification::where('noti_to', Auth::id())->orderBy('created_at','desc')->get();
        @endphp

        <!-- START NOTIFICATION LIST -->
            <ul class="notification-list no-margin b-grey b-l b-r no-style p-l-30 p-r-20">
                <li class="p-r-10 inline">
                    <div class="dropdown">
                        <a href="javascript:;" id="notification-center" class="header-icon"
                           data-toggle="dropdown">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAUCAYAAACEYr13AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABENpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1wUmlnaHRzOk1hcmtlZD0iVHJ1ZSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDoyRDRCNzY5NkYwNEExMUU3QjQyQUI1N0RGODAzOEU2OCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDoyRDRCNzY5NUYwNEExMUU3QjQyQUI1N0RGODAzOEU2OCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxNSAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpCRjU3MjI3N0YwNDkxMUU3ODkyN0YyQzI3RDhENzUyQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpCRjU3MjI3OEYwNDkxMUU3ODkyN0YyQzI3RDhENzUyQiIvPiA8ZGM6cmlnaHRzPiA8cmRmOkFsdD4gPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5DQzAgUHVibGljIERvbWFpbiBEZWRpY2F0aW9uIGh0dHA6Ly9jcmVhdGl2ZWNvbW1vbnMub3JnL3B1YmxpY2RvbWFpbi96ZXJvLzEuMC88L3JkZjpsaT4gPC9yZGY6QWx0PiA8L2RjOnJpZ2h0cz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7rX28XAAABo0lEQVR42ozUSyhEURzH8TszaDQLFvJ+NSkpVvJKFliQhYVSZGFDwsLGBkXETtkhykZZsJEpamZKspIsZoGVx0RIeZY8out7+F/dxr3Dvz7T3Dtnfud/zpk7Dl3XNYvyYAFJOIYDuQhhCufGwBjNuuIRwD5cuIYbvdhFO/xqoMOmA1V5GMEtPuTeNIqwiFb4ogVkoxpqwJ1024UVXGAOdSoglTdXNiE9KJQvv8rMExhGCao0AkKYR47qxsQRcT2GVVRhDV5Mqg8OcIQwBhEbEdKLSrleQhdqkf+1fF62kIEN/bsOZZALuXJvXAISkG7uTM2wzVqGUIBZ0/rXcYkn9NnttEoZwCLK8KL/Lh+aIvbjh9FWSNYa1O1LBTVaBSjNsok7eIsS8o4AKuA0ByjdeNb/V2qSPRQ7Tdsxg3Jsan9XrPxCPeYO3OhAFlqwbDN7ULp1GsdopBZjGffol0c3A14k4Aan8ng/m4/R0IYhPMpMF+i0Oz6DsQeZSEaK/BeoSsMoEqPuhiTVwI8HizUP/qeDepTiDWcI4wSPaECcXQOfAgwA44VltlR0kAsAAAAASUVORK5CYII=" alt="">
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
                                                            liked your post <strong> {{@$notification->post->post_details}}</strong></span>
                                                    @elseif($notification->noti_for==2 && $notification->noti_activity==2)
                                                        <i class="fa fa-comments-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong> commented in you post <strong> {{@$notification->post->post_details}}</strong></span>
                                                    @elseif($notification->noti_for==2 && $notification->noti_activity==4)
                                                        <i class="fa fa-comments-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong> following your post <strong> {{@$notification->post->post_details}}</strong></span>

                                                    @elseif($notification->noti_for==2 && $notification->noti_activity==5)
                                                        <i class="fa fa-comments-o m-r-10"></i>
                                                        <span><strong>{{$notification->user->name}}</strong> Launched a new Event<strong> {{@$notification->post->post_details}}</strong></span>
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
            {{--<a href="{{Auth::user()->role_id==4?route('frontend.newlaunch'):'javascript://'}}"
               @if(Auth::user()->role_id!=4)data-toggle="modal" data-target="#proUser" @endif
               title="Launch An Event"  class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"><img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUBAMAAAB/pwA+AAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAtUExURf///////0dwTP////////////////////////////////////////////////zKVJ0AAAAPdFJOU/nfAAoqoYI5GGqwWc1AxF/GqhEAAACnSURBVAgdY1CCAOWbuQwQlnoAAzeEqbGAgYEXwnRkYGBgBjNVBHgYGB6BmY0MRRcYJoGYyg8YlBQYjBiUlI21GBgyEjiVGJQcOBOAmhgWKTFoCESDWFxGSgyqPAUgZpASUHSLAJDFBtTNoKQLEtwEZpo/YGAQB7KAoo0+DDyuYKZ65JEF4YJg5i6niR4buMDMx9pJSgnBYOaJO01KniCWEsOrEDANJADToyZjd5vZCQAAAABJRU5ErkJggg=="></a>--}}

            <a href="{{Auth::user()->role_id==4?route('frontend.newlaunch'):'javascript://'}}"
               @if(Auth::user()->role_id!=4)data-toggle="modal" data-target="#proUser" @endif
               title="Launch An Event"  class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"><img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAUCAYAAABWMrcvAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA25pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo1QjI5NEFGM0YwNDkxMUU3OEI2ODg5NDcxRkQ3MUM5QiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0NjU5NjhEM0YwNEExMUU3QkI4OEIyNzcyQzU0ODU0OCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0NjU5NjhEMkYwNEExMUU3QkI4OEIyNzcyQzU0ODU0OCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxNSAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1YTFlZjA5Mi00YWE1LTY1NDgtOGIxMC03YTc0NGU5Y2Q0NTAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NUIyOTRBRjNGMDQ5MTFFNzhCNjg4OTQ3MUZENzFDOUIiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz77+R4VAAABHUlEQVR42mL4//8/AxZsB8QXgNgWmzw2DapA/O0/BHyF8glq2vofFWwlpMniP3ZggayOiQEVRDNgByji6JrscWiyw6VJDIglcWiSgspjaAJJCEHZL4G4Goj/QflCUHkMTTxQ/m8g3gvEbUB8FEkdDzZNHFC6G4iToOwgIN4EZTNj0/QTSnsBcTqUnQvEhlD2H7hKpPDnBeJP0Hi5A8SGQPwdyv8ElceI3Bgg/g1VBKJ/IUUuiB+Lrin2P3EgDqZJGimBEgIg58qCAqIAiDmhcXIX5E20iAXx70DlQSFcCNLkhhSSk4H4IpqmS0A8CSmkXUDO+wG1Oh3qv2I0J5VAxVOh/B8MUEYaWhaJBuKZ0BBFFgdrhDEYSMApAAEGALQbAGqyEck6AAAAAElFTkSuQmCC"></a>
            <a href="{{route('frontend.home.explore')}}"
               class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"
               title="Explore">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAFqSURBVDhPvZQ9S8NgFIVDhVIt+DGIq6ODXbu0OLgLDorYsT+gIC7+AXHxrwgO6iYubm4OSgfxo4JLQUFQp8TnxNOaVgtNgx54+t733JuTFJI3+DdFUZSDahiGRVtd4Y1DRTBTsP27GMgzWIcmdcT6BoewoT5rGe7Uk1TLiy9OCrMIW9DyrIbP4Ag+4ACrwHrvXku41g2+nxRDj99WMym8Pfcn2c5rzv4Dy4Sg7oRW4jCJTU1mv/DjwI6wqvYVojD9q0yBObxb9x6F6xv1PDZ8oIS35nZSq25/KU2ghH/iEc2oHoMFt1M/od7BOXgyqreh5pHUgQ1YhGVTgncYLRB7B/+KdUpQX3t29ED3ToVqKXNgv4YKRC/09mHWo9kD9UP/FXYpZ+BHIL02DP5S2J/DCqXer3XqS/vPcKFaotYBoQOl94jD2ATpGJZsd8W1OhuTwU2oU+Y90isa0wyUvB0o5vQtl7Xa+msFwSeK6Yg8Ru6J7AAAAABJRU5ErkJggg==" alt="">
            </a>
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
               class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"
               title="My Liked"><img height="17"
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAUCAYAAABSx2cSAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MUU4RjM0OTZGMDRBMTFFN0IwQkVBNEU3NDg2MzBCNjEiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MUU4RjM0OTVGMDRBMTFFN0IwQkVBNEU3NDg2MzBCNjEiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6REZGODAxMTNGMDQ4MTFFNzkwODhGODZCNTVGODQyQ0YiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6REZGODAxMTRGMDQ4MTFFNzkwODhGODZCNTVGODQyQ0YiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5zK7bkAAABhElEQVR42pyUvS9EQRTFZ5hdH7EiEYREIiERjUYkJKJRiGIbidofoFLoFTodjShEIVHQahRK4rNRit2EXWxBVPYtuzvOfY5k8jL7wU1+++7bzL1nzp33nrbWHiqlpkBe1R/N4FyjOEDSpP4eBYOfd5AAy6ANrINX6QzKoMEp+AQdYDpcY39iEyhyARadex9bUmTodQz0gBjoBUnwRGXtKJdpcVzqxHMayQB4YXFnnZ7Thp2k4xkwVC1RWUeUS1zTF06cnnccPzdgpYbnvV/PX6DL6Z5g5xFgI8qytp3WAvH8gKQf3IM4c4kir9Ftx5lnTOSpiTn3xjOkRie3olxAcgLm+GcKHIFdz7aLtLUKJg238egseAN34LrKMWVBqyjLkXSDfTZaoEKqiudB8CzKAb3M0rPmdbjGQxJO+wPJLZhn0Sm4BNv07IblINfAkCQtfIOyXCD+Dzi0SiHDHRXlHBsscZIbIMcdVHolZ2SwUpznGf/rY3AMJjg45fHpC9np1bcAAwBtzc0MpxoRXAAAAABJRU5ErkJggg==">
            </a>
            {{--<a href="{{route('frontend.my.follow')}}"
               class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block"><i
                        class="fa fa-plus"></i></a>--}}
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

            {{--chat --}}
            {{--<a href="#" class="header-icon btn-link m-l-10 pg pg-comment sm-no-margin d-inline-block"
               data-toggle="quickview" data-toggle-element="#quickview"></a>--}}
        </div>
    </div>
</div>