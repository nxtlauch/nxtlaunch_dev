<!-- BEGIN Header  !-->
<div class="navbar navbar-default">
    <div class="navbar-inner">
        <a href="javascript://;" class="back-chat-list link text-master inline action p-l-10 p-r-10"
           data-navigate="view"
           data-view-animation="push-parrallax">
            <i class="pg-arrow_left"></i>
        </a>
        <div class="view-heading">
            {{$user->name}}
            {{--<div class="fs-11 hint-text">Online</div>--}}
        </div>
        <a href="#" class="link text-master inline action p-r-10 pull-right ">
            <i class="pg-more"></i>
        </a>
    </div>
</div>
<!-- END Header  !-->
<!-- BEGIN Conversation  !-->
<div class="chat-inner" id="my-conversation">
    <!-- BEGIN From Me Message  !-->
    @forelse($messages as $message)
        @if($message->from_id==Auth::id())
            <div class="message clearfix">
                <div class="chat-bubble from-me">
                    {{$message->message}}
                </div>
            </div>
        @else
            <div class="message clearfix">
                <div class="profile-img-wrapper m-t-5 inline">
                    <img class="col-top" width="30" height="30"
                         src="{{@$message->message_from->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$message->message_from->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}"
                         alt="">
                </div>
                <div class="chat-bubble from-them">
                    {{$message->message}}
                </div>
            </div>
        @endif
    @empty
        <p>start your conversation....</p>
    @endforelse
</div>
<!-- BEGIN Conversation  !-->
<!-- BEGIN Chat Input  !-->
<div class="b-t b-grey bg-white clearfix p-l-10 p-r-10">
    <div class="row">
        <div class="col-1 p-t-15">
            {{--<a href="#" class="link text-master"><i class="fa fa-plus-circle"></i></a>--}}
        </div>
        <div class="col-8 no-padding">
            <input id="chat_input" type="text" class="form-control chat-input" placeholder="Say something">
        </div>
        <div class="col-2 link text-master m-l-10 m-t-15 p-l-10 b-l b-grey col-top">
            <a id="chat-insert" href="#" data-href="{{route('frontend.send.message')}}" data-id="{{$user->id}}"
               class="link text-master"><i class="fa fa-paper-plane"></i></a>
        </div>
    </div>
</div>
<!-- END Chat Input  !-->