@extends('frontend.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('public/slim/css/slim.min.css')}}">
@endsection

@section('contents')

    <div class="page-container ">
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
            <!-- START PAGE CONTENT -->
            <div class="content">
                <div class="plx__container">
                    <!-- START CONTAINER FLUID -->
                    <div class=" container  container-fixed-lg">
                        <!-- BEGIN PlACE PAGE CONTENT HERE -->
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="card card-default">
                                    <div class="card-header ">
                                        <div class="card-title">
                                            Profile Edit
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <form role="form" method="post" action="{{route('frontend.edit.myprofile')}}"
                                              enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label>Profile Picture</label>
                                                <input type="file" class="form-control" name="profile_picture"/>
                                                {{--<div class="slim"
                                                     data-ratio="1:1"
                                                     data-label="Drop Profile photo here"
                                                     data-size="400,400"
                                                     data-max-file-size="2">
                                                    @if ( Auth::user()->userDetails->profile_picture )
                                                        <img src="{{asset('content-dir/profile_picture/'.Auth::user()->userDetails->profile_picture) }}"/>
                                                    @endif
                                                    <input type="file" name="profile_picture"/>
                                                </div>--}}
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control"
                                                       value="{{old('name')?old('name'):Auth::user()->name}}">
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" name="business_description" class="form-control"
                                                       value="{{old('business_description')?old('business_description'):Auth::user()->userDetails->business_description}}">
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            {{--<div class="form-group">
                                                <label>Username</label>
                                                <input type="email" class="form-control" value="username" disabled="">
                                            </div>--}}
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                       value="{{old('email')?old('email'):Auth::user()->email}}"
                                                       readonly>
                                            </div>
                                            {{--<div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" name="old_password" class="form-control">
                                                @if ($errors->has('old_password'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                                @endif
                                            </div>--}}
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="new_password" class="form-control">
                                                @if ($errors->has('new_password'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="confirm_password" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
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

@endsection

@section('scripts')
    <script src="{{asset('public/slim/js/slim.kickstart.min.js')}}"></script>

@endsection