@extends('frontend.publicaccess.unauthmaster')


@section('unAuthContents')
    <div class="page-container ">
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
            <!-- START PAGE CONTENT -->
            <div class="content -plx__home">
                <div class="plx__container">
                    <!-- START CONTAINER FLUID -->
                    <div class=" container  container-fixed-lg">
                        <!-- BEGIN PlACE PAGE CONTENT HERE -->


                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                @forelse($posts as $post)
                                    <div class="plx__post">
                                        <div class="plx__post-header">
                                            <div class="plx__post-author-avatar"
                                                 style="background-image: url('{{asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                            <div class="plx__meta-text">
                                                <h4 class="plx__post-author-name">
                                                    <strong>{{$post->user->name}}</strong></h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <a href="javascript://"
                                               class="plx__follow-btn redirectlogin">Follow</a>
                                            <p class="post-title">{{$post->post_details}}</p>
                                            <p class=""><a target="_blank" href="{{$post->link}}">{{$post->link}}</a></p>
                                        </div>
                                        <div class="ratio-4-3 plx__post-thumb"
                                             style="background-image: url('{{asset('content-dir/posts/images/'.$post->image)}}')"></div>
                                        <div class="plx__post-info">
                                            <div class="plx__time-countdown m-b-5">
                                                @php($days=\Carbon\Carbon::parse($post->expire_date)->diffInDays())
                                                <span title="{{\Carbon\Carbon::parse($post->expire_date)->format('M d, Y H:i')}}"
                                                      data-toggle="tooltip"
                                                      class="plx__countdown {{$days<7?'text-danger':($days<30?'text-warning':'text-success')}}"
                                                      data-date-time="{{$post->expire_date}}">
                    <span class="number day">08</span>d :
                    <span class="number hour">14</span>h :
                    <span class="number minutes">03</span>m :
                    <span class="number seconds">21</span>s
                </span>
                                            </div>
                                            <div class="plx___meta-actions">
                                                <a href="#" title="Like"
                                                   class="plx__like -liked redirectlogin"></a>
                                                <a href="#" title="Comment"
                                                   class="plx__comment redirectlogin"></a>
                                                <a href="#" title="Share" class="plx__share redirectlogin"></a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
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

    <!-- END PAGE CONTAINER -->

    {{--<div class="modal fade" id="shahinRedirect" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Login Needed</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure ? </p>
                </div>
                <div class="modal-footer">

                    <a href="{{route('login')}}" class="btn btn-info">Login</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>--}}

    <div class="modal fade slide-up disable-scroll" id="shahinRedirect" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-body text-center m-t-20">
                        <h5 class="no-margin p-b-10">Please login to continue...</h5>
                        <a href="{{route('login')}}" class="btn btn-sm btn-primary btn-cons">Log In</a>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
@endsection
