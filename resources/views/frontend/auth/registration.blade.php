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
</head>
<body class="fixed-header ">
<div class="login-wrapper ">
    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
    {{--<div class="plx__block top left">--}}
    {{--<span class="text-block text-bold lg">455K</span>--}}
    {{--<span class="mid-text">Total Posts</span>--}}
    {{--</div>--}}
    {{--<div class="plx__block bottom left">--}}
    {{--<span class="text-block text-bold md">4000+</span>--}}
    {{--<span class="mid-text">Total Registered Users</span>--}}
    {{--</div>--}}
    {{--<div class="plx__block top right">--}}
    {{--<span class="text-block text-bold sm">1500+</span>--}}
    {{--<span class="mid-text">Total Brands</span>--}}
    {{--</div>--}}
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
    <div class="login-container bg-white" style="overflow-x: hidden;">
        <div class="p-l-50 text-center m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{{asset('public/frontend-assets')}}/assets/img/nxt_logo.png" alt="logo"
                 data-src="{{asset('public/frontend-assets')}}/assets/img/nxt_logo.png"
                 data-src-retina="{{asset('public/frontend-assets')}}/assets/img/nxt_logo_2x.png" height="60">
            <p class="p-t-35">Sign up to see what's coming up</p>

            <a href="{{url('login/facebook')}}" class="btn btn-block btn-info">Sign Up with Facebook</a>

            <div class="text-center m-b-5 m-t-20">
                <strong>OR</strong>
            </div>

            <!-- START Login Form -->
            <form id="form-login" class="p-t-15" role="form" method="POST" action="{{ route('register') }}">
            {{csrf_field()}}
            <!-- START Form Control-->
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="controls">
                        <input type="text" name="name" placeholder="Full Name" class="form-control" required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <div class="controls">
                        <input type="text" name="phone" placeholder="Phone" class="form-control" required>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <div class="controls">
                        <input type="text" name="location" placeholder="Location" class="form-control" required>
                        @if ($errors->has('location'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="controls">
                        <input type="text" id="email" name="email" placeholder="Email" class="form-control" autocomplete="off" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group m-b-30{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="controls">
                        <input type="password" name="password" placeholder="Password" autocomplete="new-password" class="form-control" minlength="6"
                               required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!-- END Form Control-->
                <button class="btn btn-block btn-primary btn-cons m-t-10 m-b-15" type="submit">Sign Up</button>
                <div class="text-center"><strong>OR</strong></div>
                <a href="{{route('frontend.home')}}" class="btn btn-block btn-default m-t-10 m-b-30">Explore</a>
                <p>By signing up, you agree to our TERMS and Privacy Policy</p>
                {{--<p>
                    <small>for business, celebrity and band</small>
                </p>--}}
                <hr>
                <p class="semi-bold">Have an account? <a href="{{route('login')}}">Login</a></p>
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
    $(function () {
        /*$('#form-login').blur(function() {
            $('#form-login').validate();
        });*/

        $('#form-login').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{route('registration.check.email')}}",
                        type: "get",
                        data: {
                            email: function() {
                                return $( "#email" ).val();
                            }
                        }
                    },

                }
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Please enter a valid email address",
                    remote: "This email is already registered"
                },
            },

            onkeyup: false,
            // onfocusout: false,
            focusCleanup: true,
        })
    })
</script>
</body>
</html>