@extends('layouts.master')
@section('styles')

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
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid   container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->

            <div class="card card-borderless">
                <ul class="nav nav-tabs nav-tabs-simple" role="tablist" data-init-reponsive-tabs="dropdownfx">
                    <li class="nav-item">
                        <a class="active" data-toggle="tab" role="tab" data-target="#mainSettings" href="#">Main</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab" data-target="#secondarySettings">Secondary</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab" data-target="#addSettings">Ads</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="mainSettings">
                        <br>
                        <div class="col-lg-10">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Website Title</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                        <div class="form-group form-group-default">
                                            <label>Meta Description</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                        <div class="form-group form-group-default">
                                            <label>Contact Email</label>
                                            <input type="email" class="form-control" value="">
                                        </div>
                                        <div class="form-group form-group-default">
                                            <label>Time Zone</label>
                                            <select name="" id="" class="form-control">
                                                <option value="">--Select--</option>
                                                <option value="1">Time Zone 1</option>
                                                <option value="2">Time Zone 2</option>
                                                <option value="3">Time Zone 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                        <div class="form-group form-group-default">
                                            <label>Twitter</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                        <div class="form-group form-group-default">
                                            <label>Google Plus</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane " id="secondarySettings">
                        <br>
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Avatar Max Upload Size (Mb)</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label>Photo Maximum Mpload Size</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label>Banded Words (Separeted by comma)</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>

                    <div class="tab-pane" id="addSettings">
                        <br>
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Top Ads Code</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label>Bottom Ads Code</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label>Side Ads Code</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
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
    <script src="{{asset('public/assets/plugins/bootstrap-collapse/bootstrap-tabcollapse.js')}}" type="text/javascript"></script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <!-- END CORE TEMPLATE JS -->

    <script>
        $(document).keypress(function (e) {
            console.log(e.which);
        })
    </script>
@endsection