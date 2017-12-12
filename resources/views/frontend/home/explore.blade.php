<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Nxtlanuch</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    {{--Header Files--}}
    <link href="{{asset('public/frontend-assets')}}/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('public/frontend-assets')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('public/frontend-assets')}}/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('public/frontend-assets')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.css"
          rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('public/frontend-assets')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet"
          type="text/css" media="screen"/>
    <link href="{{asset('public/frontend-assets')}}/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet"
          type="text/css" media="screen"/>

    <link href="{{asset('public/frontend-assets')}}/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{asset('public/frontend-assets')}}/pages/css/themes/modern.css"
          rel="stylesheet" type="text/css"/>
    <link class="plx__stylesheet" href="{{asset('public/frontend-assets')}}/assets/css/plx__style.css" rel="stylesheet"
          type="text/css"/>

</head>

<body class="fixed-header horizontal-menu horizontal-app-menu ">
<!-- START PAGE-CONTAINER -->
{{--Header--}}
<div class="header custom-bg p-r-0 bg-primary">
    <div class="header-inner header-md-height container plx__padding">
        <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu text-white"
           data-toggle="horizontal-menu"></a>

        <div class="">
            <a href="{{route('frontend.home')}}" class="brand inline no-border hidden-xs-down">
                <img src="{{asset('public/frontend-assets/assets/img/logo_white.png')}}" alt="logo"
                     data-src="{{asset('public/frontend-assets/assets/img/logo_white.png')}}"
                     data-src-retina="{{asset('public/frontend-assets/assets/img/logo_white_2x.png')}}" width="78"
                     height="22">
            </a>


            {{--<a href="#" class="search-link hidden-md-down" data-toggle="search"><i class="pg-search"></i>Type anywhere
                to <span class="bold">search</span></a>--}}
        </div>

        <div class="d-flex align-items-center">
            <!-- START User Info-->
            <a href="javascript://"
               class="header-icon btn-link m-l-10 p-r-15 sm-no-margin d-inline-block redirectlogin"><img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUBAMAAAB/pwA+AAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAtUExURf///////0dwTP////////////////////////////////////////////////zKVJ0AAAAPdFJOU/nfAAoqoYI5GGqwWc1AxF/GqhEAAACnSURBVAgdY1CCAOWbuQwQlnoAAzeEqbGAgYEXwnRkYGBgBjNVBHgYGB6BmY0MRRcYJoGYyg8YlBQYjBiUlI21GBgyEjiVGJQcOBOAmhgWKTFoCESDWFxGSgyqPAUgZpASUHSLAJDFBtTNoKQLEtwEZpo/YGAQB7KAoo0+DDyuYKZ65JEF4YJg5i6niR4buMDMx9pJSgnBYOaJO01KniCWEsOrEDANJADToyZjd5vZCQAAAABJRU5ErkJggg=="></a>
            <a href="javascript://"
               class="header-icon pg pg-alt_menu btn-link m-l-10 p-r-15 sm-no-margin d-inline-block redirectlogin"
               title="Launch An Event"></a>

        </div>
    </div>
</div>
{{--End Header--}}



{{--Search Overlay--}}
{{--@include('frontend.includes.sidebar.search_overlay')--}}

{{--Footer Files--}}
<!-- BEGIN VENDOR JS -->
<script src="{{asset('public/frontend-assets/assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/frontend-assets/assets/plugins/jquery/jquery-1.11.1.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets/assets/plugins/modernizr.custom.js')}}" type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-ui/jquery-ui.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/tether/js/tether.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-unveil/jquery.unveil.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-ios-list/jquery.ioslist.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript"
        src="{{asset('public/frontend-assets')}}/assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="{{asset('public/frontend-assets')}}/assets/plugins/classie/classie.js"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/switchery/js/switchery.min.js"
        type="text/javascript"></script>
<!-- END VENDOR JS -->


<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{asset('public/frontend-assets/pages/js/pages.min.js')}}"></script>
<!-- END CORE TEMPLATE JS -->

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

        $(".redirectlogin").click(function (e) {
            $("#shahinRedirect").modal('show');
        });
    }(jQuery))
</script>

<!-- BEGIN PAGE LEVEL JS -->
<script src="{{asset('public/frontend-assets')}}/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->

</body>
</html>