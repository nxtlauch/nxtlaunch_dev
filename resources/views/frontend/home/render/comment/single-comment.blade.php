<li>
    {{--<div class="user-avatar"--}}
    {{--style="background-image: url('{{@$comment->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$comment->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.png')}}')"></div>--}}

    <div class="comment-text">
        <p class="text"><span
                    class="semi-bold-alt m-r-5">{{$comment->user->name}}</span>
            {{$comment->comment}} {{--<small> &nbsp;&nbsp;&nbsp;--<i>{{@$comment->created_at->diffForHumans()}}</i></small>--}}</p>
        {{--<p class="muted-text">{{@$comment->created_at->diffForHumans()}}</p>--}}
    </div>
</li>