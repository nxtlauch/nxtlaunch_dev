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
                                <form id="post-filter" class="form-inline m-b-15" method="post"
                                      action="{{route('frontend.filter.posts')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="page" value="{{@$page}}">
                                    <div class="form-group form-group-sm m-b-15 m-r-15">
                                        <label for=""><i class="fa fa-sort-amount-asc"></i>&nbsp; </label>
                                        &nbsp;&nbsp;&nbsp;
                                        <select name="time" id="" class="filterInput plx__form-control">
                                            <option value="0" selected>Anytime</option>
                                            <option value="1" {{@$time==1?'selected':''}}>Today</option>
                                            <option value="2" {{@$time==2?'selected':''}}>This Week</option>
                                            <option value="3" {{@$time==3?'selected':''}}>This Month</option>
                                            <option value="4" {{@$time==4?'selected':''}}>This Year</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-group-sm m-b-15 m-r-15">
                                        <select name="location" id="" class="filterInput plx__form-control">
                                            <option value="0" selected>Global</option>
                                            <option value="1" {{@$location==1?'selected':''}}>Nearest</option>
                                        </select>
                                    </div>
                                    <a href="{{@$page==1?route('frontend.home'):route('frontend.home.explore')}}" class="clearFilterBtn hidden">&times; Clear Filter</a>
                                </form>
                                <div class="" id="postrender">
                                    @include('frontend.home.render.indexrender')
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
        $(document).on("submit", "form#post-filter", function (e) {
            e.preventDefault();
            var url = "{{route('frontend.filter.posts')}}";
            var formData = new FormData($("#post-filter")[0]);
            $.ajax({
                type: "POST",
                url: url,
                enctype: 'multipart/form-data',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == 1) {
                        $("#postrender").html(data.content);
                    } else {
                        alert(data.content);
                    }
                }
            });
        });

        (function ($) {
            "use strict";
            toggleFilterBar();

            $('.filterInput').change(function () {
                var url = "{{route('frontend.filter.posts')}}";
                var formData = new FormData($("#post-filter")[0]);
                $.ajax({
                    type: "POST",
                    url: url,
                    enctype: 'multipart/form-data',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (data) {
                        if (data.status == 1) {
                            $("#postrender").html(data.content);
                        } else {
                            alert(data.content);
                        }
                        $('.clearFilterBtn').removeClass('hidden');
                        shouldInit();
                        hashTag();
                    }
                });
            });

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