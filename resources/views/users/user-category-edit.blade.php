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
    <style>
        /*Business Type*/
        .business-type-list {
            padding: 0;
            margin: 0;
        }

        .business-type-list li {
            display: inline-block;
            text-align: center;
        }

        .business-type-list li input[type='radio'] {
            display: none;
        }

        .business-type-list li span {
            display: block;
        }

        .business-type-list .box-info {
            /*padding: 10px;*/
        }

        .business-type-list .box-icon {
            background-position: center center;
            background-repeat: no-repeat;
            -webkit-background-size: contain;
            background-size: contain;
            width: 60px;
            height: 60px;
            border: 1px solid rgba(0, 0, 0, .1);
            font-size: 0;
            line-height: 60px;
            text-align: center;
            cursor: pointer;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        .business-type-list input[type='radio']:checked ~ .box-icon {
            border: 1px solid #459DE1;
            background-color: rgba(69, 157, 225, 0.1);
        }
    </style>
@endsection

@section('contents')
    {{--{{dd($icons)}}--}}
    <!-- START PAGE CONTENT -->
    <div class="content ">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Edit User</h3>
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

            <div class="container-fluid container-fixed-lg bg-white">
                <div class="card card-transparent">
                    {{--<div class="card-header ">
                        <div class="card-title">Profile Picture
                        </div>
                    </div>--}}
                    <div class="card-block">
                        <form method="post" action="{{route('admin.user.category.edit',$category->id)}}" class="row">
                            {{csrf_field()}}
                            <div class="col-md-9">
                                {{--<form action="#">--}}
                                {{-- <div class="row">
                                     <div class="col-md-9">--}}
                                <div class="form-group ">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" required
                                           value="{{old('name')?old('name'):$category->name}}">
                                </div>
                                {{--</div>
                            </div>--}}

                                <div class="form-group">
                                    <p>Icon</p>
                                    <ul class="business-type-list">
                                        @foreach($icons as $icon)
                                            <li>
                                                <label for="userCategory{{$icon->id}}" class="business-type"
                                                       data-toggle="tooltip">
                                                    <input type="radio" id="userCategory{{$icon->id}}"
                                                           name="category_image_id"
                                                           value="{{$icon->id}}" {{$category->category_image_id == $icon->id?'checked':''}}>
                                                    <span class="box-icon local-business">
                                    <img src="{{$icon->image}}">
                                </span>
                                                </label>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="#" class="btn btn-default">Cancel</a>
                                {{--</form>--}}
                            </div>
                        </form>
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