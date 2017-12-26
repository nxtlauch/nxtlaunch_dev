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
                            {{--<div class="col-md-1 col-lg-1"></div>--}}
                            <div class="col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-4 d-flex flex-column">
                                        <form action="{{route('frontend.filter')}}" class="plx__filter-bar">
                                            <h4 id="toggleFilter" class="plx__widget-title clearfix">Filter By

                                            </h4>
                                            <div class="filter-list">
                                                <ul class="filter-block">
                                                    <li>
                                                        <label for="all" class="filter-item">
                                                            <input id="all" name="f1" value="all"
                                                                   type="checkbox" {{@$f1=='all'?' checked':''}}>
                                                            <span>All</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="random" class="filter-item">
                                                            <input id="random" name="f1" value="random"
                                                                   type="checkbox" {{@$f1=='random'?' checked':''}}>
                                                            <span>Random</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                                <ul class="filter-block">
                                                    <li>
                                                        <label for="aroundMe" class="filter-item">
                                                            <input id="aroundMe" name="f2" value="around_me"
                                                                   type="checkbox" {{@$f2=='around_me'?' checked':''}}>
                                                            <span>Around Me</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="nationality" class="filter-item">
                                                            <input id="nationality" name="f2" value="nationality"
                                                                   type="checkbox" {{@$f2=='nationality'?' checked':''}}>
                                                            <span>Nationality</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="worldWide" class="filter-item">
                                                            <input id="worldWide" name="f2" value="worldwide"
                                                                   type="checkbox" {{@$f2=='worldwide'?' checked':''}}>
                                                            <span>World Wide</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                                <ul class="filter-block">
                                                    <li>
                                                        <label for="today" class="filter-item">
                                                            <input id="today" name="f3" value="today"
                                                                   type="checkbox" {{@$f3=='today'?' checked':''}}>
                                                            <span>Today</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="thisWeek" class="filter-item">
                                                            <input id="thisWeek" name="f3" value="week"
                                                                   type="checkbox" {{@$f3=='week'?' checked':''}}>
                                                            <span>This Week</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="thisMonth" class="filter-item">
                                                            <input id="thisMonth" name="f3" value="month"
                                                                   type="checkbox" {{@$f3=='month'?' checked':''}}>
                                                            <span>This Month</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="thisYear" class="filter-item">
                                                            <input id="thisYear" name="f3" value="year"
                                                                   type="checkbox" {{@$f3=='year'?' checked':''}}>
                                                            <span>This Year</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                                <ul class="filter-block">
                                                    <li>
                                                        <label for="closestLaunches" class="filter-item">
                                                            <input id="closestLaunches" name="f4" value="closest"
                                                                   type="checkbox" {{@$f4=='closest'?' checked':''}}>
                                                            <span>Closest launches</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="latestLaunches" class="filter-item">
                                                            <input id="latestLaunches" name="f4" value="latest"
                                                                   type="checkbox" {{@$f4=='latest'?' checked':''}}>
                                                            <span>Latest launches</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                                <button type="submit"
                                                        class="btn {{--pull-right btn-link--}} btn-block btn-primary">
                                                    Done
                                                </button>
                                                @if(@$cancel)
                                                    <a href="{{route('frontend.home')}}"
                                                       class="btn btn-block btn-default">
                                                        Clear Filter
                                                    </a>
                                                @endif

                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-lg-9 col-sm-8 d-flex flex-column" id="postrender">
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