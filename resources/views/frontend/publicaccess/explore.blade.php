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
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="row">

                                    <div class="col-lg-12 col-sm-12 d-flex flex-column">
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
                                                    <div class="post-texts">
                                                        @if($post->likes->count())
                                                            <p class="text-muted"><strong>Liked
                                                                    by {{$post->likes->first()->user->name}}</strong>
                                                                @if($post->likes->count()-1)
                                                                    and
                                                                    {{$post->likes->count()-1}}
                                                                    others</p>
                                                        @endif
                                                        @else
                                                            <p class="text-muted"><strong>No like yet</strong></p>
                                                        @endif
                                                        <p class="post-title">{{$post->post_details}}</p>
                                                        <p><a href="javascript://">View all
                                                                comments({{$post->comments->count()}})</a></p>
                                                        @if($post->comments->count()>0)
                                                            <div class="plx__comments">
                                                                <p>
                                                                    <strong>{{$post->comments->last()->user->name}}</strong> {{$post->comments->last()->comment}}
                                                                </p>
                                                            </div>
                                                        @else
                                                            <div class="plx__comments">
                                                                <p>No comment yet</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse

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

    <!-- END PAGE CONTAINER -->

    <div class="modal fade" id="shahinRedirect" role="dialog">
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
    </div>
@endsection
