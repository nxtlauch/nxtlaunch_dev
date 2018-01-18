@extends('frontend.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('public/slim/css/slim.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend-assets/assets/css/jquery.datetimepicker.min.css')}}"/>
@endsection

@section('contents')


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
                                <div class="plx__post">
                                    <div class="plx__post-header">
                                        <div class="plx__meta-text">
                                            <h4 class="plx__post-author-name">Launch Event</h4>
                                        </div>
                                    </div>
                                    <form class="plx__post-info" method="post"
                                          action="{{route('frontend.editlaunch',$post->id)}}"
                                          enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group{{ $errors->has('post_details') ? ' has-error' : '' }}">
                                            <label for="">Talk something about the event
                                                <small>(max 255 char)</small>
                                            </label>
                                            <textarea id="" name="post_details" rows="5" style="height: 140px;"
                                                      class="form-control"
                                                      maxlength="255">{{old('post_details')?old('post_details'):$post->post_details}}</textarea>
                                            @if ($errors->has('post_details'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('post_details') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('expire_date') ? ' has-error' : '' }}">
                                            <label for="">Launch Date</label>

                                            <input type='text' class="form-control" name="expire_date"
                                                   value="{{old('expire_date')?old('expire_date'):$post->expire_date}}"
                                                   id='datetimepicker' readonly/>

                                            @if ($errors->has('expire_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expire_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                                            <label for="">Link
                                            </label>
                                            <input class="form-control" type="text" name="link"
                                                   value="{{old('link')?old('link'):$post->link}}">
                                            @if ($errors->has('link'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                            <label for="">Category</label>
                                            <div class="tags">
                                                @php($current=$post->postCategories->pluck('category_id'))
                                                @php($category_id=(old('category_id')?old('category_id'):$post->category_id))

                                                @if($categories->where('type',1)->count()>0)
                                                    <div class="inner-block">

                                                        <h4 class="block-title-alt">Popular in Tech</h4>

                                                        <div class="tags">
                                                            @foreach($categories->where('type',1) as $interest)
                                                                <label class="tab-pill" for="interest{{$interest->id}}">
                                                                    <input id="interest{{$interest->id}}"
                                                                           type="checkbox"
                                                                           value="{{$interest->id}}"
                                                                           {{$current->contains($interest->id)?'checked':''}}
                                                                           name="category_id[]">
                                                                    <span>{{$interest->name}}</span>
                                                                </label>
                                                            @endforeach

                                                        </div>

                                                    </div>
                                                @endif

                                                @if($categories->where('type',2)->count()>0)
                                                    <div class="inner-block">
                                                        <h4 class="block-title-alt">Popular in Music</h4>
                                                        <div class="tags">
                                                            @foreach($categories->where('type',2) as $interest)
                                                                <label class="tab-pill" for="interest{{$interest->id}}">
                                                                    <input id="interest{{$interest->id}}"
                                                                           type="checkbox"
                                                                           value="{{$interest->id}}"
                                                                           {{$current->contains($interest->id)?'checked':''}}
                                                                           name="category_id[]">
                                                                    <span>{{$interest->name}}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($categories->where('type',3)->count()>0)
                                                    <div class="inner-block">
                                                        <h4 class="block-title-alt">Popular in Sports and Fitness</h4>
                                                        <div class="tags">
                                                            @foreach($categories->where('type',3) as $interest)
                                                                <label class="tab-pill" for="interest{{$interest->id}}">
                                                                    <input id="interest{{$interest->id}}"
                                                                           type="checkbox"
                                                                           value="{{$interest->id}}"
                                                                           {{$current->contains($interest->id)?'checked':''}}
                                                                           name="category_id[]">
                                                                    <span>{{$interest->name}}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                {{--@foreach($categories as $category)
                                                    <label class="tab-pill" for="interest{{$category->id}}">
                                                        <input id="interest{{$category->id}}"
                                                               {{$current->contains($category->id)?'checked':''}}
                                                               type="checkbox"
                                                               value="{{$category->id}}"
                                                               name="category_id[]">
                                                        <span>{{$category->name}}</span>
                                                    </label>
                                                @endforeach--}}
                                            </div>

                                            {{--<select name="category_id" id="" class="form-control">
                                                <option value="">Select Category</option>
                                                @php($category_id=(old('category_id')?old('category_id'):$post->category_id))
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{($category_id==$category->id)?'selected':''}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>--}}
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        {{--<div class="form-group m-b-20{{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label for="">Upload Photo</label>
                                            <input type="file" accept="image/*" name="image" class="form-control">
                                            @if ($errors->has('image'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                            @endif
                                        </div>--}}
                                        <div class="form-group m-b-20{{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label for="">Upload Photo</label>
                                            <div class="slim"
                                                 data-ratio="3:2"
                                                 data-label="Drop Event photo here"
                                                 data-min-size="600,400"
                                                 data-max-file-size="2">
                                                <img src="{{asset('content-dir/posts/images/'.$post->image)}}" alt=""/>
                                                <input type="file" name="image"/>
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                            @endif
                                        </div>


                                        <button class="btn btn-block btn-primary">Update Event</button>
                                    </form>
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
    <script src="{{asset('public/slim/js/slim.kickstart.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('public/frontend-assets')}}/assets/js/jquery.datetimepicker.full.min.js"></script>


    <script>
        (function ($) {
            "use strict";
            toggleFilterBar();
//            $( window ).resize(function() {
//                toggleFilterBar();
//            });
            function toggleFilterBar() {
                if ($(window).width() < 576) {
                    $('#toggleFilter').on('click', function (e) {
                        e.preventDefault();
                        $('.filter-list').slideToggle();
                    })
                }
            }

            $('#datetimepicker').datetimepicker({
                minDate: 0,
                yearStart: (new Date()).getFullYear(),
            });
        }(jQuery))
    </script>

@endsection