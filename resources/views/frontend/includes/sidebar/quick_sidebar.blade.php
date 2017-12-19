{{--@if(Auth::user()->role_id==4)--}}
<!--START QUICKVIEW -->
<div id="quickview" class="quickview-wrapper" data-pages="quickview">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active" data-target="#messages" data-toggle="tab">
            <a href="#">Messages</a>
        </li>
    </ul>
    <a class="btn-link quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview"><i
                class="pg-close"></i></a>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active no-padding" id="messages">
            <div class="view-port clearfix" id="chat">
                <div id="chatrefresh" class="view chat-view bg-white">

                    <div class="navbar navbar-default">
                        <div class="navbar-inner">
                            @if(Auth::user()->role_id==4)
                                <a title="New Conversion" href="javascript:;"
                                   class="inline action p-l-10 link text-master newConversionForm">
                                    <i class="pg-plus"></i>
                                </a>
                            @endif
                            <div class="view-heading first">
                                Chat List
                            </div>
                        </div>
                    </div>

                    <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                        <div class="list-view-group-container">
                            <div class="form-group p-l-15 p-r-15">
                                <input id="myChatInput" onkeyup="myChatFunction()" type="text" class="form-control"
                                       placeholder="Search...">
                            </div>
                            <ul id="myChatUL">
                                @forelse($all_conversation as $user)
                                    @if($user->members->contains('user_id',Auth::id()) || $user->user_id==Auth::id())
                                        @include('frontend.includes.sidebar.chatcontent.conversationList')
                                    @endif
                                @empty
                                @endforelse
                            </ul>
                            {{--<ul id="myChatUL">
                                @forelse($all_users as $user)
                                    @if($user->id==Auth::id())
                                        @continue
                                    @endif

                                    <li class="chat-user-list clearfix">
                                        <a class="chat-click" data-href="{{route('frontend.chat.history')}}"
                                           data-id="{{$user->id}}" href="javascript://">
                    <span class="thumbnail-wrapper d32 circular bg-success">
                        <img width="34" height="34" alt=""
                             src="{{@$user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.png')}}"
                             class="col-top">
                    </span>
                                            <p class="p-l-10 ">
                                                <span class="text-master">{{$user->name.'('.$user->messages->count().')'}}</span>
                                            </p>
                                        </a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>--}}
                        </div>
                    </div>
                </div>
                <!-- BEGIN Conversation View  !-->

                <div class="view chat-view bg-white clearfix">

                    <div class="navbar navbar-default">
                        <div class="navbar-inner">
                            <a href="javascript:;"
                               class="link closeConversionForm text-master inline action p-l-10 p-r-10">
                                <i class="pg-arrow_left"></i>
                            </a>
                            <div class="view-heading">
                                New Conversation
                            </div>
                            {{--<a href="#" class="link text-master inline action p-r-10 pull-right ">--}}
                            {{--<i class="pg-more"></i>--}}
                            {{--</a>--}}
                        </div>
                    </div>


                    <form method="post" action="{{route('frontend.conversation.save')}}" class="chat-inner"
                          id="my-conversation">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input name="name" type="text" placeholder="Enter conversation name"
                                   class="conversationName form-control" required>
                        </div>
                        <div class="form-group">
                            <select name="user_id[]" class="userIdClass full-width" data-placeholder="Select User"
                                    data-init-plugin="select2" multiple required>
                                @forelse($all_users as $user)
                                    @if($user->id==Auth::id())
                                        @continue
                                    @endif
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Create</button>
                    </form>


                    {{--<div class="b-t b-grey bg-white clearfix p-l-10 p-r-10">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-1 p-t-15">--}}
                    {{--<a href="#" class="link text-master"><i class="fa fa-plus-circle"></i></a>--}}
                    {{--</div>--}}
                    {{--<div class="col-8 no-padding">--}}
                    {{--<input type="text" class="form-control chat-input" data-chat-input="" data-chat-conversation="#my-conversation" placeholder="Say something">--}}
                    {{--</div>--}}
                    {{--<div class="col-2 link text-master m-l-10 m-t-15 p-l-10 b-l b-grey col-top">--}}
                    {{--<a href="#" class="link text-master"><i class="pg-camera"></i></a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END QUICKVIEW-->
{{--@endif--}}