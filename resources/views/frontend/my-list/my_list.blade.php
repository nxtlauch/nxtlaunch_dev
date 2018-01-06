@extends('frontend.layouts.master')

@section('styles')

@endsection

@section('contents')
    {{--{{dd($brands->followersOf)}}--}}

    <div class="page-container ">
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
            <!-- START PAGE CONTENT -->
            <div class="content followingList">
                <div class="plx__container">
                    <!-- START CONTAINER FLUID -->
                    <div class=" container  container-fixed-lg">
                        <!-- BEGIN PlACE PAGE CONTENT HERE -->
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <ul class="plx__tabs">
                                    <li class="tab-item"><a href="#followingPosts" class="active"><i
                                                    class="pg-alt_menu"></i> Following Posts</a></li>
                                    <li class="tab-item"><a href="#followingUsers"><i class="pg-plus"></i>
                                            Following Users</a></li>
                                </ul>

                                <div id="plx__tabs-content">
                                    <div id="followingPosts" class="plx__tabs-item active">
                                        <ul class="plx__tabs-alt forPost clearfix">
                                            <li class="tab-item"><a class="active" href="#myListLaunches">Launches</a>
                                            </li>
                                            <li class="tab-item"><a href="#myListLaunched">Launched</a></li>
                                        </ul>

                                        <div id="myListLaunches" class="forPostContent tab-content active">
                                            @forelse($posts->where('post.expire_date','>',Carbon\Carbon::now()->toDateTimeString())->sortByDesc('id') as $post)
                                                {{--{{dd($post->post)}}--}}
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
                                                            {{--<a href="{{route('frontend.home')."#post_id_".$post->post->id}}" title="Comment" class="plx__comment"></a>--}}
                                                            <a href="{{route('frontend.post.details',$post->post->id)}}"
                                                               title="Comment" class="plx__comment"></a>
                                                            <span>{{$post->post->comments->count()}}</span>
                                                            <a href="javascript://" title="Share" class="plx__share"></a> <span>0</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            @empty
                                                <h4 class="text-center">You didn't follow any post yet</h4>
                                            @endforelse
                                        </div>

                                        <div id="myListLaunched" class="forPostContent tab-content">
                                            @forelse($posts->where('post.expire_date','<',Carbon\Carbon::now()->toDateTimeString())->sortByDesc('id') as $post)
                                                {{--{{dd($post->post)}}--}}
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
                                                            {{--<a href="{{route('frontend.home')."#post_id_".$post->post->id}}" title="Comment" class="plx__comment"></a>--}}
                                                            <a href="{{route('frontend.post.details',$post->post->id)}}"
                                                               title="Comment" class="plx__comment"></a>
                                                            <span>{{$post->post->comments->count()}}</span>
                                                            <a href="javascript://" title="Share" class="plx__share"></a> <span>0</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            @empty
                                                <h4 class="text-center">You didn't follow any post yet</h4>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div id="followingUsers" class="plx__tabs-item">
                                    <ul class="brand-list">
                                        @forelse($brands as $brand)
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
                                            <h3 class="text-center">You Didn't Follow any user yet</h3>
                                        @endforelse

                                        {{--<li>
                                            <a href="#">
                                                <div class="brand-avatar ratio-1-1"
                                                     style="background-image: url('http://waterfaucets.net/wp-content/uploads/2017/05/remarkable-apple-office-interior-design-office-interior-design-retail-design.jpg')">
                                                </div>
                                                <div class="brand-details">
                                                    <div class="brand-details-header">
                                                        <h2 class="brand-name">Apple Inc</h2>
                                                        <p class="brand-bio">Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit. Ad alias assumenda id in iste sint.</p>
                                                        --}}{{--<a href="javascript://" class="plx__follow-btn">Follow</a>--}}{{--
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">New Post</span>
                                                            <span class="number">02</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Post</span>
                                                            <span class="number">256</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Follower</span>
                                                            <span class="number">23K</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="brand-avatar ratio-1-1"
                                                     style="background-image: url('http://waterfaucets.net/wp-content/uploads/2017/05/remarkable-apple-office-interior-design-office-interior-design-retail-design.jpg')">
                                                </div>
                                                <div class="brand-details">
                                                    <div class="brand-details-header">
                                                        <h2 class="brand-name">Apple Inc</h2>
                                                        <p class="brand-bio">Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit. Ad alias assumenda id in iste sint.</p>
                                                        --}}{{--<a href="javascript://" class="plx__follow-btn">Follow</a>--}}{{--
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">New Post</span>
                                                            <span class="number">02</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Post</span>
                                                            <span class="number">256</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Follower</span>
                                                            <span class="number">23K</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="brand-avatar ratio-1-1"
                                                     style="background-image: url('http://waterfaucets.net/wp-content/uploads/2017/05/remarkable-apple-office-interior-design-office-interior-design-retail-design.jpg')">
                                                </div>
                                                <div class="brand-details">
                                                    <div class="brand-details-header">
                                                        <h2 class="brand-name">Apple Inc</h2>
                                                        <p class="brand-bio">Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit. Ad alias assumenda id in iste sint.</p>
                                                        --}}{{--<a href="javascript://" class="plx__follow-btn">Follow</a>--}}{{--
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">New Post</span>
                                                            <span class="number">02</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Post</span>
                                                            <span class="number">256</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Follower</span>
                                                            <span class="number">23K</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="brand-avatar ratio-1-1"
                                                     style="background-image: url('http://waterfaucets.net/wp-content/uploads/2017/05/remarkable-apple-office-interior-design-office-interior-design-retail-design.jpg')">
                                                </div>
                                                <div class="brand-details">
                                                    <div class="brand-details-header">
                                                        <h2 class="brand-name">Apple Inc</h2>
                                                        <p class="brand-bio">Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit. Ad alias assumenda id in iste sint.</p>
                                                        --}}{{--<a href="javascript://" class="plx__follow-btn">Follow</a>--}}{{--
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">New Post</span>
                                                            <span class="number">02</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Post</span>
                                                            <span class="number">256</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Follower</span>
                                                            <span class="number">23K</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>--}}
                                    </ul>
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

@endsection