<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Nxtlaunch - </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />

    {{--
    # Header FIles
    --}}
    @include('includes.header.header_files')
</head>
<body class="fixed-header ">

{{--
# Sidebar
--}}
@include('includes.sidebar.sidebar')

<!-- START PAGE-CONTAINER -->
<div class="page-container ">
    {{--
    # Header
    --}}
    @include('includes.header.header')

    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">

        @yield('contents')

        {{--
        # Footer (Copyright)
        --}}
        @include('includes.footer.footer')
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTAINER -->

{{--
# Quick Sidebar
--}}
@include('includes.sidebar.quick_sidebar')

{{--
# Search Overlay
--}}
@include('includes.sidebar.search_overlay')

{{--
# Footer FIles
--}}
@include('includes.footer.footer_files')
</body>
</html>