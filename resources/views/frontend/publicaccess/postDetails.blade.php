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
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="plx__post" id="post_id_{{$post->id}}">
                                <div class="plx__post-header">
                                    <div class="plx__post-author-avatar"
                                         {{--                                                         style="background-image: url('{{asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>--}}
                                         style="background-image: url('{{@$post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                    <div class="plx__meta-text">
                                        <h4 class="plx__post-author-name">
                                            <strong>{{$post->user->name}}</strong></h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    @if($post->user_id != Auth::id())
                                        <a href="javascript://"
                                           data-href="{{route('frontend.post.details.follow')}}"
                                           data-id="{{$post->user->id}}"
                                           data-post="{{$post->id}}"
                                           class="redirectlogin plx__follow-btn {{$post->user->followers->contains('followed_by',Auth::id())?' added':''}}">{{$post->user->followers->contains('followed_by',Auth::id())?'Following':'Follow'}}</a>
                                    @endif
                                </div>
                                <div class="ratio-4-3 plx__post-thumb"
                                     style="background-image: url('{{asset('content-dir/posts/images/'.$post->image)}}')">
                                    <div class="ratio-inner">
                                        <img src="{{asset('content-dir/posts/images/'.$post->image)}}" alt="">
                                    </div>
                                </div>
                                <div class="plx__post-info">
                                    <div class="plx__time-countdown m-b-5">
                                                        <span class="plx__countdown"><span
                                                                    class="number">08</span>d : <span
                                                                    class="number">14</span>h : <span
                                                                    class="number">03</span>m : <span
                                                                    class="number">21</span>s</span>
                                    </div>
                                    <div class="plx___meta-actions">
                                        <a href="javascript://"
                                           data-href="{{route('frontend.post.details.like')}}"
                                           data-id="{{$post->id}}"
                                           title="{{$post->likes->contains('user.id',Auth::id())?'Unlike':'Like'}}"
                                           {{--                                                           class="plx__like {{$post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a>--}}
                                           class="redirectlogin plx__like {{$post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a>
                                        <a href="#" title="Comment" class="redirectlogin plx__comment"></a>
                                        <a href="#" title="Share" class="redirectlogin plx__share"></a>
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
                                        <p class="-post-title">{{$post->post_details}}</p>


                                        {{--<h5>Leave a comment</h5>--}}

                                        <h5>Comments ({{$post->comments->count()}})</h5>
                                        <hr>


                                        <ul class="plx__comment-list">
                                            @forelse($post->comments->sortByDesc('id') as $comment)
                                                {{--{{dd($comment->user->name)}}--}}
                                                <li>
                                                    <div class="user-avatar"
                                                         style="background-image: url('{{@$comment->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$comment->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                                    <div class="comment-text">
                                                        <p class="text"><strong
                                                                    class="m-r-5">{{$comment->user->name}}</strong>
                                                            {{$comment->comment}}</p>
                                                        <p class="muted-text">{{@$comment->created_at->diffForHumans()}}</p>
                                                    </div>
                                                </li>
                                            @empty
                                                <p>No comments yet</p>
                                            @endforelse
                                        </ul>

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

                <a href="{{route('frontend.post.details',$post->id)}}" class="btn btn-info">Login</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>