<li class="chat-user-list clearfix">
    <a class="chat-click" data-href="{{route('frontend.chat.history')}}"
       data-id="{{$user->id}}" href="javascript://">
                                                <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt=""
                                 src="{{@$user->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.$user->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}"
                                 class="col-top">
                        </span>
        <p class="p-l-10 ">
            <span class="text-master">{{$user->name}}</span>
            {{--                                                    <span class="text-master">{{$user->name.'('.$user->messages->count().')'}}</span>--}}
        </p>
    </a>
</li>