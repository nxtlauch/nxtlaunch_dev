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
                                <ul class="plx__tabs-alt forPost clearfix">
                                    <li class="tab-item"><a class="active" href="#myListLaunches">Launches</a>
                                    </li>
                                    <li class="tab-item"><a href="#myListLaunched">Launched</a></li>
                                </ul>

                                <div id="myListLaunches" class="forPostContent tab-content active">
                                    @forelse($posts->where('post.expire_date', '>', \Carbon\Carbon::now()->toDateTimeString()) as $post)
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
                                        <h4 class="text-center">No Post</h4>
                                    @endforelse
                                </div>

                                <div id="myListLaunched" class="forPostContent tab-content">
                                    @forelse($posts->where('post.expire_date', '<', \Carbon\Carbon::now()->toDateTimeString()) as $post)
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
                                                            <span title="{{\Carbon\Carbon::parse($post->expire_date)->format('M d, Y H:i')}}" class="plx__countdown text-danger"
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
                                        <h4 class="text-center">No Post</h4>
                                    @endforelse
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
        /*$(document).on("click", ".plx__like", function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            var post_id = $(this).data('id');
            console.log(link);
            console.log(post_id);

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
                    'post_id': post_id
                },
                dataType: 'json',
                success: function (data) {
                    $("#post_id_" + post_id).empty();
                    $("#post_id_" + post_id).html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        $(document).on("click", ".plx__follow-btn", function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            var user_id = $(this).data('id');
            var post_id = $(this).data('post');

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
                    'user_id': user_id,
                    'post_id': post_id
                },
                dataType: 'json',
                success: function (data) {

                    $("#likeRender").empty();
                    $("#likeRender").html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });*/
    </script>

@endsection