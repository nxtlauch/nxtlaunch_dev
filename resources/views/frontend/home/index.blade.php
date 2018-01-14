@extends('frontend.layouts.master')

@section('styles')

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
                            <div class="col-md-2 col-lg-2"></div>
                            <div class="col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 d-flex flex-column" id="postrender">
                                        <form class="form-inline m-b-15" method="post"
                                              action="{{route('frontend.filter.posts')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="page" value="{{@$page}}">
                                            <div class="form-group form-group-sm m-b-15 m-r-15">
                                                <label for="">Filter by</label> &nbsp; &nbsp;
                                                <select name="time" id="" class="form-control form-control-sm">
                                                    <option value="0" selected>Anytime</option>
                                                    <option value="1" {{@$time==1?'selected':''}}>Today</option>
                                                    <option value="2" {{@$time==2?'selected':''}}>This Week</option>
                                                    <option value="3" {{@$time==3?'selected':''}}>This Month</option>
                                                    <option value="4" {{@$time==4?'selected':''}}>This Year</option>
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm m-b-15 m-r-15">
                                                <select name="location" id="" class="form-control form-control-sm">
                                                    <option value="0" selected>Global</option>
                                                    <option value="1" {{@$location==1?'selected':''}}>Nearest</option>
                                                    {{--<option value="1" {{@$location==1?'selected':''}}>3 km</option>--}}
                                                    {{--<option value="2" {{@$location==2?'selected':''}}>8 km</option>--}}
                                                    {{--<option value="3" {{@$location==3?'selected':''}}>16 km</option>--}}
                                                    {{--<option value="4" {{@$location==4?'selected':''}}>40 km</option>--}}
                                                    {{--<option value="5" {{@$location==5?'selected':''}}>80</option>--}}
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm m-b-15">
                                                <button type="submit" class="btn  btn-success btn-sm">Filter</button>
                                            </div>
                                        </form>

                                        @include('frontend.home.render.indexrender')
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

    <script>

        (function ($) {
            "use strict";
            toggleFilterBar();

            function toggleFilterBar() {
                if ($(window).width() < 576) {
                    $('#toggleFilter').on('click', function (e) {
                        e.preventDefault();
                        $('.filter-list').slideToggle();
                    })
                }
            }
        }(jQuery))
    </script>

@endsection