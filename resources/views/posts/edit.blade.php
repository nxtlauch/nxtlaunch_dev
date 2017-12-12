@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('public/slim/css/slim.min.css')}}">

    <link href="{{asset('public/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('public/assets/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet"
          type="text/css" media="screen">
    <link href="{{asset('public/assets/plugins/summernote/css/summernote.css')}}" rel="stylesheet" type="text/css"
          media="screen">
    <link href="{{asset('public/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet"
          type="text/css" media="screen">
    <link href="{{asset('public/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet"
          type="text/css" media="screen">
@endsection

@section('contents')
    {{--{{dd($post)}}--}}
    <!-- START PAGE CONTENT -->
    <div class="content ">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Post</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Edit Post</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->

        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid   container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->

            <div class="container-fluid   container-fixed-lg bg-white">
                <div class="card card-transparent">
                    <div class="card-header ">
                        <div class="card-title">Edit Post
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-9">
                                <form method="post" action="{{route('admin.post.edit',$post->id)}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default disabled">
                                                <label>Name</label>
                                                <input type="text" class="form-control" value="{{$post->user->name}}"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="form-group  form-group-default required">
                                        <label>Post Title</label>
                                        <input type="email" class="form-control" placeholder="" required
                                               value="{{$post->post_title}}">
                                    </div>--}}
                                    {{--<div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group form-group-default input-group">
                                                <div class="form-input-group">
                                                    <label>Post Date</label>
                                                    <input type="text" class="form-control" placeholder="Pick a date"
                                                           id="datepicker-component2" value="{{$post->created_at->format('d/m/Y')}}">
                                                </div>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group  form-group-default">
                                                <label>Post Time</label>
                                                <div class="input-group bootstrap-timepicker">
                                                    <input id="timepicker" type="text" class="form-control">
                                                    <span class="input-group-addon"><i class="pg-clock"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="form-group  form-group-default">
                                        <label>Description</label>
                                        <textarea class="form-control"
                                                  name="post_details">{{$post->post_details}}</textarea>
                                    </div>
                                    <div class="form-group  form-group-default required">
                                        <label>Post Image</label>
                                        <div class="form-group m-b-20{{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label for="">Upload Photo</label>
                                            {{--<div class="slim" data-label="Drop profile photo here" data-size="200, 200" data-ratio="1:1">
                                                <label for="">Upload Photo</label>
                                                --}}{{--@if ( $user->avatar )
                                                    <img src="{{ $user->avatar }}" />
                                                @endif--}}{{--
                                                <input type="file" name="image" />
                                            </div>--}}
                                            {{--<div class="slim"
                                                 data-ratio="3:2"
                                                 data-label="Drop Event photo here"
                                                 data-size="600,400"
                                                 data-max-file-size="2">
                                                <img src="{{asset('content-dir/posts/images/'.$post->image) }}"/>
                                                <input type="file" name="image"/>
                                            </div>--}}
                                        </div>
                                        <input name="image" type="file" accept="image/*" class="form-control">
                                    </div>
                                    <p><strong>POST STATISTICS</strong></p>
                                    <table>
                                        <tr>
                                            <td>Post Likes</td>
                                            <td>:</td>
                                            <td>{{$post->likes_count}}</td>
                                        </tr>
                                        <tr>
                                            <td>Post Comments</td>
                                            <td>:</td>
                                            <td>{{$post->comments_count}}</td>
                                        </tr>
                                        <tr>
                                            <td>Post Shared</td>
                                            <td>:</td>
                                            <td>{{$post->shares_count}}</td>
                                        </tr>
                                        <tr>
                                            <td>Post Reported</td>
                                            <td>:</td>
                                            <td><?= rand(100, 200) ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <button type="submit" class="btn btn-primary">Update Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END PLACE PAGE CONTENT HERE -->
        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->
@endsection

@section('scripts')
    <script src="{{asset('public/slim/js/slim.kickstart.min.js')}}"></script>

    <script src="{{asset('public/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/plugins/jquery-autonumeric/autoNumeric.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/plugins/dropzone/dropzone.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/summernote/js/summernote.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('public/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/bootstrap-typehead/typeahead.bundle.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/bootstrap-typehead/typeahead.jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/handlebars/handlebars-v4.0.5.js')}}"></script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <script src="{{asset('public/assets/js/form_elements.js')}}" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
@endsection