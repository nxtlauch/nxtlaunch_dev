<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Nxtlaunch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="_token" content="{!! csrf_token() !!}"/>

    {{--Header Files--}}
    @include('frontend.includes.header.header_files')

    {{--<link rel="apple-touch-icon" href="pages/ico/60.png">--}}
    {{--<link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">--}}
    {{--<link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">--}}
    {{--<link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">--}}
    {{--<link rel="icon" type="image/x-icon" href="favicon.ico" />--}}
</head>

<body class="fixed-header horizontal-menu horizontal-app-menu ">
{{--{{dd($all_users)}}--}}
<!-- START PAGE-CONTAINER -->
{{--Header--}}
@include('frontend.includes.header.header')

    @yield('contents')

<!-- END PAGE CONTAINER -->
{{--Quick Sidebar--}}
@include('frontend.includes.sidebar.quick_sidebar')

{{--Search Overlay--}}
{{--@include('frontend.includes.sidebar.search_overlay')--}}

{{--Pro User Warning--}}
@include('frontend.includes.modal.proUserWarning')
{{--Footer Files--}}



@include('frontend.includes.footer.footer_files')

@include('toast.toast')

</body>
</html>