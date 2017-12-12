<!-- START OVERLAY -->
<div class="overlay hide" data-pages="search">
    <!-- BEGIN Overlay Content !-->
    <div class="overlay-content has-results m-t-20">
        <!-- BEGIN Overlay Header !-->
        <div class="container-fluid">
            <!-- BEGIN Overlay Logo !-->
            <img class="overlay-brand" src="{{asset('public/frontend-assets')}}/assets/img/logo.png" alt="logo"
                 data-src="{{asset('public/frontend-assets')}}/assets/img/logo.png"
                 data-src-retina="assets/img/logo_2x.png" width="78" height="22">
            <!-- END Overlay Logo !-->
            <!-- BEGIN Overlay Close !-->
            <a href="#" class="close-icon-light overlay-close text-black fs-16">
                <i class="pg-close"></i>
            </a>
            <!-- END Overlay Close !-->
        </div>
        <!-- END Overlay Header !-->
        <form method="get" action="{{route('frontend.search')}}">
            <div class="container-fluid">
                <div class="inline-block">
                    <div class="radio left">
                        <input id="launches" type="radio" value="1" checked="checked" name="searchType">
                        <label for="launches">Launches</label>
                    </div>
                </div>
                <div class="inline-block">
                    <div class="radio left">
                        <input id="launchers" type="radio" value="2" name="searchType">
                        <label for="launchers">Launchers</label>
                    </div>
                </div>
                <div class="inline-block">
                    <div class="radio left">
                        <input id="tags" type="radio" value="1" name="searchType">
                        <label for="tags">Tags</label>
                    </div>
                </div>
                <div class="inline-block">
                    <div class="radio left">
                        <input id="Places" type="radio" value="2" name="searchType">
                        <label for="Places">Places</label>
                    </div>
                </div>
                <!-- END Overlay Controls !-->
            </div>

            <div class="container-fluid">
                <!-- BEGIN Overlay Controls !-->
                <input id="overlay-search" type="text" name="q" class="no-border overlay-search bg-transparent"
                       placeholder="Search..."
                       autocomplete="off" spellcheck="false" required>
                <br>
                {{--<div class="inline-block">
                    <div class="checkbox right">
                        <input id="checkboxn" type="checkbox" value="1" checked="checked">
                        <label for="checkboxn"><i class="fa fa-search"></i> Search within page</label>
                    </div>
                </div>--}}
                <div class="inline-block m-l-10">
                    <p class="fs-13">Press enter to search</p>
                </div>
                <!-- END Overlay Controls !-->
            </div>


            {{--<button type="submit" class="btn btn-success">Search</button>--}}
        </form>

        <div class="search-tab">
            <a href="#" class="tab-item"></a>
        </div>

        <!-- BEGIN Overlay Search Results, This part is for demo purpose, you can add anything you like !-->
        <div class="container-fluid">
      <span>
            <strong>Popular Posts:</strong>
        </span>
            {{--<div id="overlay-suggestions" class="m-t-10">--}}
            <div class="m-t-10">
                <div class="row">
                    <div class="col-md-5 col-sm-6">
                        @forelse($search_suggestion as $post)
                            <a href="{{route('frontend.post.details',$post->id)}}">
                                <div class="plx__post alt">
                                    <div class="ratio-4-3 plx__post-thumb"
                                         style="background-image: url('{{asset('content-dir/posts/images/'.$post->image) }}')"></div>
                                    <div class="plx__post-info">
                                        <div class="plx__post-header">
                                            <div class="plx__post-author-avatar"
                                                 style="background-image: url('{{@$post->user->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$post->user->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')"></div>
                                            <div class="plx__meta-text">
                                                <h4 class="plx__post-author-name">
                                                    <strong>{{@$post->user->name}}</strong></h4>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="post-texts">
                                            <p class="post-title" style="color: #000;">{{$post->post_details}}</p>
                                        </div>
                                        <div class="plx___meta-actions">
                                            <a href="{{route('frontend.post.details',$post->id)}}" title="Like"
                                               class="plx__like {{$post->likes->contains('user.id',Auth::id())?' liked':' -liked'}}"></a>
                                            <span>{{$post->likes_count}}</span>
                                            <a href="{{route('frontend.post.details',$post->id)}}" title="Like"
                                               class="plx__comment"></a>
                                            <span>{{$post->comments->count()}}</span>
                                            <a href="{{route('frontend.post.details',$post->id)}}" title="Like"
                                               class="plx__share"></a>
                                            <span>0</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @empty
                        @endforelse
                        {{--<div class="plx__post alt">
                            <div class="ratio-4-3 plx__post-thumb"
                                 style="background-image: url('https://i.gadgets360cdn.com/large/iphone_x_story_1505365092746.jpg')"></div>
                            <div class="plx__post-info">
                                <div class="plx__post-header">
                                    <div class="plx__post-author-avatar"
                                         style="background-image: url('{{asset('public/frontend-assets')}}/assets/img/profiles/avatar.jpg')"></div>
                                    <div class="plx__meta-text">
                                        <h4 class="plx__post-author-name"><strong>Apple</strong></h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="post-texts">
                                    <p class="post-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequatur eveniet expedita fugit illo magnam minus natus odit quaerat unde. Aspernatur culpa esse obcaecati.</p>
                                </div>
                                <div class="plx___meta-actions">
                                    <a href="#" title="Like" class="plx__like liked"></a> <span>21K</span>
                                    <a href="#" title="Like" class="plx__comment"></a> <span>32</span>
                                    <a href="#" title="Like" class="plx__share"></a> <span>212</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="plx__post alt">
                            <div class="ratio-4-3 plx__post-thumb"
                                 style="background-image: url('https://i.gadgets360cdn.com/large/iphone_x_story_1505365092746.jpg')"></div>
                            <div class="plx__post-info">
                                <div class="plx__post-header">
                                    <div class="plx__post-author-avatar"
                                         style="background-image: url('{{asset('public/frontend-assets')}}/assets/img/profiles/avatar.jpg')"></div>
                                    <div class="plx__meta-text">
                                        <h4 class="plx__post-author-name"><strong>Apple</strong></h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="post-texts">
                                    <p class="post-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequatur eveniet expedita fugit illo magnam minus natus odit quaerat unde. Aspernatur culpa esse obcaecati.</p>
                                </div>
                                <div class="plx___meta-actions">
                                    <a href="#" title="Like" class="plx__like liked"></a> <span>21K</span>
                                    <a href="#" title="Like" class="plx__comment"></a> <span>32</span>
                                    <a href="#" title="Like" class="plx__share"></a> <span>212</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>--}}
                    </div>
                </div>
            </div>
            <br>
            {{--<div class="search-results m-t-40">
                <p class="bold">Pages Search Results</p>
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>
                                    <img width="50" height="50" src="{{asset('public/frontend-assets')}}/assets/img/profiles/avatar.jpg" data-src="{{asset('public/frontend-assets')}}/assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on pages</h5>
                                <p class="hint-text">via john smith</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                    </div>
                </div>
            </div>--}}
        </div>
        <!-- END Overlay Search Results !-->
    </div>
    <!-- END Overlay Content !-->
</div>
<!-- END OVERLAY -->