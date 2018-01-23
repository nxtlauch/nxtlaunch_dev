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
                                <h4 class="m-b-30">All Notifications</h4>
                                <!-- START Notification -->
                                <div class="notification-panel" style="width: 100%;">
                                    <!-- START Notification Body-->
                                    <div class="notification-body" style="max-height: none;">
                                        <!-- START Notification Item-->
                                        @forelse($all_notifications as $notification)
                                            @if($notification->noti_for==2 && $notification->noti_activity==6)
                                                @php
                                                    $now=Carbon\Carbon::now();
                                                    $expired_date=new \Carbon\Carbon($notification->post->expire_date);
                                                    $diffInDays=$expired_date->diffInDays($now);
                                                    $diffInHuman=$expired_date->diffForHumans($now);
                                                @endphp
                                                {{--@if($notification->post->expire_date < \Carbon\Carbon::now()->toDateTimeString())
                                                    @continue
                                                @elseif($diffInDays>7)
                                                    @continue
                                                @endif--}}
                                            @endif
                                            <div class="notification-item {{$notification->status==1?' unread':''}} noti_id-{{$notification->id}} clearfix">
                                                <div class="heading">
                                                    <a href="{{route('frontend.notification.details', $notification->id)}}"
                                                       class="text-info plx__one-line-clamp"
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
                                                            <span><strong>{{$notification->user->name}}</strong> {{$expired_date>$now?' will launch':' launched'}}
                                                                his event<strong>  {{$diffInHuman}}</strong></span>
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
                                        @empty
                                            <div class="notification-item clearfix">
                                                <div class="heading">
                                                    <a href="javascript://" class="text-info">
                                                        <i class="fa fa-info-circle m-r-10"></i>
                                                        <span>No Notification yet</span>
                                                    </a>
                                                </div>
                                            </div>
                                    @endforelse
                                    <!-- END Notification Item-->
                                    </div>
                                    <!-- END Notification Body-->
                                </div>
                                <!-- END Notification -->
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