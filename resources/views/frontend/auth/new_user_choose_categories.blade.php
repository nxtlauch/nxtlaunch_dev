<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>NxtLaunch</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
    {{--<link rel="apple-touch-icon" href="pages/ico/60.png">--}}
    {{--<link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">--}}
    {{--<link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">--}}
    {{--<link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">--}}
    {{--<link rel="icon" type="image/x-icon" href="favicon.ico" />--}}
    {{--<meta name="apple-mobile-web-app-capable" content="yes">--}}
    {{--<meta name="apple-touch-fullscreen" content="yes">--}}
    {{--<meta name="apple-mobile-web-app-status-bar-style" content="default">--}}
    <meta content="" name="description"/>
    <meta content="" name="author"/>
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
    <link class="plx-stylesheet" href="{{asset('public/frontend-assets')}}/assets/css/plx__style.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript">
        window.onload = function () {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{{asset('public/frontend-assets')}}/pages/css/windows.chrome.fix.css" />'
        }
    </script>

    <style>
        .select2-results .select2-results__option--highlighted {
            background-color: #E8E9EA !important;
        }

        .select2-results__option[aria-selected='false'] {
            background-color: #ffffff !important;
        }

        .select2-results__option {
            background-color: #E8E9EA !important;
        }
    </style>
</head>
<body class="fixed-header ">
<div class="login-wrapper ">
    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="{{asset('public/frontend-assets')}}/assets/img/bg_home.png"
             data-src="{{asset('public/frontend-assets')}}/assets/img/bg_home.png"
             data-src-retina="{{asset('public/frontend-assets')}}/assets/img/demo//assets/img/bg_home.png" alt=""
             class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
            <h2 class="semi-bold text-white">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque libero maxime non porro, quia
                voluptates!</h2>
            <p class="small">
                © <?= date('Y') ?> NxtLaunch.
            </p>
        </div>
        <!-- END Background Caption-->
    </div>
    <!-- END Login Background Pic Wrapper-->

    <!-- START Login Right Container-->
    <div class="login-container bg-white">
        <div class="p-l-30 p-r-30 p-t-30 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <h4 class="semi-bold text-center">Choose category</h4>
            <hr>
            <!-- START Login Form -->
            <form id="form-login" class="p-t-15" method="post" role="form"
                  action="{{route('new.user.choose.interests')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Choose your interests categories</label>
                    <select name="interests[]" id="" class="full-width" multiple required>
                        @foreach($interests as $interest)
                            <option value="{{$interest->id}}">{{$interest->name}}</option>
                        @endforeach
                    </select>
                </div>


                <!-- END Form Control-->
                <button class="btn btn-block btn-primary btn-cons m-t-10 m-b-15" type="submit">Submit</button>
            </form>
            <!--END Login Form-->
        </div>
    </div>
    <!-- END Login Right Container-->
</div>
<!-- BEGIN VENDOR JS -->
<script src="{{asset('public/frontend-assets')}}/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery/jquery-1.11.1.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
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
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<!-- END VENDOR JS -->
<script src="{{asset('public/frontend-assets')}}/pages/js/pages.min.js"></script>

<script>
    $(document).ready(function () {
        $(".full-width[multiple]").select2({
            placeholder: '--Select--'
        });
    });
    $('#form-login').validate();
</script>
</body>
</html>