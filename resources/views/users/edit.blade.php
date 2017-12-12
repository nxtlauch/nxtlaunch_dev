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

            <form method="post" action="{{route('admin.user.edit',$user->id)}}"
                  class="container-fluid   container-fixed-lg bg-white" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card card-transparent">
                    <div class="card-header ">
                        <div class="card-title">Profile Picture
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="file" name="profile_picture"/>
                                {{--<div class="slim"
                                     data-ratio="1:1"
                                     data-label="Drop Profile photo here"
                                     data-size="400,400"
                                     data-max-file-size="2">
                                    @if ( $user->userDetails->profile_picture )
                                        <img src="{{asset('content-dir/profile_picture/'.$user->userDetails->profile_picture) }}" />
                                    @endif
                                    <input type="file" name="profile_picture"/>
                                </div>--}}
                            </div>
                            <div class="col-md-9">
                                {{--<form action="#">--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required ">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control" required
                                                   value="{{old('name')?old('name'):$user->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required">
                                            <label>Phone</label>
                                            <input name="phone" type="text" class="form-control" required
                                                   value="{{old('phone')?old('phone'):$user->phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  form-group-default required">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                           placeholder="ex: some@example.com" required readonly
                                           value="{{old('email')?old('email'):$user->email}}">
                                </div>
                                {{--<div class="form-group  form-group-default">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" placeholder="" value="+0123456789">
                                </div>--}}
                                <div class="form-group  form-group-default">
                                    <label>Description</label>
                                    <textarea name="business_description" rows="3"
                                              class="form-control"
                                              required>{{$user->userDetails->business_description}}</textarea>
                                </div>
                                <div class="form-group form-group-default form-group-default-select2">
                                    <label>Business Type</label>
                                    <select name="category_name" class=" full-width" data-init-plugin="select2">
                                        <option value="Local business or place" {{($user->userDetails->category_name=="Local business or place")?'selected':''}} >
                                            Local business or place
                                        </option>
                                        <option value="Company or Organization" {{($user->userDetails->category_name=="Company or Organization")?'selected':''}}>
                                            Company or Organization
                                        </option>
                                        <option value="Brand or product" {{($user->userDetails->category_name=="Brand or product")?'selected':''}}>
                                            Brand or product
                                        </option>
                                        <option value="Cause/Community" {{($user->userDetails->category_name=="Cause/Community")?'selected':''}}>
                                            Cause/Community
                                        </option>
                                        <option value="Entertainment" {{($user->userDetails->category_name=="Entertainment")?'selected':''}}>
                                            Entertainment
                                        </option>
                                        <option value="Artist, Band or Public Figure" {{($user->userDetails->category_name=="Artist, Band or Public Figure")?'selected':''}}>
                                            Artist, Band or Public Figure
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="#" class="btn btn-default">Cancel</a>
                                {{--</form>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>

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