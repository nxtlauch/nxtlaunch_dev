<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>NxtLaunch</title>
    <meta name="robots" content="noindex"/>
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
<div class="auth-wrap">
    <div class="container">
        <div class="auth-block">
            <div class="block-header">
                <img src="{{asset('public/frontend-assets')}}/assets/img/nxt_logo.png" alt="logo"
                     data-src="{{asset('public/frontend-assets')}}/assets/img/nxt_logo.png"
                     data-src-retina="{{asset('public/frontend-assets')}}/assets/img/nxt_logo_2x.png" height="60">
            </div>

            <div class="block-content">
                <form id="form-login"
                      method="post"
                      role="form"
                      action="{{route('new.user.choose.interests')}}">
                    {{csrf_field()}}
                    <h4 class="block-title">Interests</h4>
                    @if($interests->where('type',1)->count()>0)
                        <div class="inner-block">

                            <h4 class="block-title-alt">Popular in Tech</h4>
                            <div class="tags">
                                @foreach($interests->where('type',1) as $interest)
                                    <label class="tab-pill" for="interest{{$interest->id}}">
                                        <input id="interest{{$interest->id}}" type="checkbox" value="{{$interest->id}}"
                                               name="interests[]">
                                        <span>{{$interest->name}}</span>
                                    </label>
                                @endforeach

                            </div>

                        </div>
                    @endif

                    @if($interests->where('type',2)->count()>0)
                        <div class="inner-block">
                            <h4 class="block-title-alt">Popular in Music</h4>
                            <div class="tags">
                                @foreach($interests->where('type',2) as $interest)
                                    <label class="tab-pill" for="interest{{$interest->id}}">
                                        <input id="interest{{$interest->id}}" type="checkbox" value="{{$interest->id}}"
                                               name="interests[]">
                                        <span>{{$interest->name}}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($interests->where('type',3)->count()>0)
                        <div class="inner-block">
                            <h4 class="block-title-alt">Popular in Sports and Fitness</h4>
                            <div class="tags">
                                @foreach($interests->where('type',3) as $interest)
                                    <label class="tab-pill" for="interest{{$interest->id}}">
                                        <input id="interest{{$interest->id}}" type="checkbox" value="{{$interest->id}}"
                                               name="interests[]">
                                        <span>{{$interest->name}}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($errors->has('interests'))
                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('interests') }}</strong>
                                    </span>
                    @endif

                    <hr>

                    <div class="inner-block">
                        <h4 class="block-title">Pro User</h4>
                        @if(Session::has('confirm_pro'))
                            <input name="proUserCheck" type="hidden" value="yes">
                        @else
                            <div class="form-group">
                                <label>Are you interested to resister as pro user?</label>
                                <div class="radio m-t-0 radio-primary">
                                    <input class="proUserCheckYes" type="radio" checked="checked" value="yes"
                                           name="proUserCheck"
                                           id="yes">
                                    <label for="yes">Yes</label>
                                    <input class="proUserCheckNo" type="radio" value="no" name="proUserCheck" id="no">
                                    <label for="no">No</label>
                                </div>
                            </div>
                        @endif
                        <div id="proUserRegisterForm">

                            <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                                <label>What type of business you serve?</label>
                                <ul class="business-type-list">
                                    @foreach($categories as $key => $category)
                                        <li>
                                            <label for="userCategory{{$category->id}}" class="business-type"
                                                   data-toggle="tooltip"
                                                   title="{{$category->name}}">
                                                <input type="radio" id="userCategory{{$category->id}}"
                                                       name="category_name"
                                                       value="{{$category->name}}" {{$key == 0?'checked':''}}>
                                                <span class="box-icon local-business">
                                    <img src="{{$category->categoryImage->image}}">
                                </span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                                @if ($errors->has('category_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- START Form Control-->
                            <div class="form-group m-b-20{{ $errors->has('category_name') ? ' has-error' : '' }}">
                                <label for="">Tell something about your business...</label>
                                <textarea name="business_description" id="businessNote" rows="4" class="form-control"
                                          style="height: 100px"></textarea>
                                @if ($errors->has('business_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('business_description') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <!-- END Form Control-->
                    <button class="btn btn-info btn-cons m-t-10 m-b-15" type="submit">Continue</button>
                </form>
            </div>

            <div class="block-footer text-center m-t-30">
                © <?= date('Y') ?> NxtLaunch.
            </div>
        </div>
    </div>
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
        var proRegisterCheckboxYes = $('.proUserCheckYes');
        var proRegisterCheckboxNo = $('.proUserCheckNo');
        checkProRegister(proRegisterCheckboxYes, proRegisterCheckboxNo);

        $('input[name="proUserCheck"]').change(function () {
            checkProRegister(proRegisterCheckboxYes, proRegisterCheckboxNo);
        });

        $('#form-login').validate();

        function checkProRegister(yes, no) {
            console.log($(yes).prop('checked'));
            console.log($(no).prop('checked'));
            if ($(yes).prop('checked') === true) {
                $('#proUserRegisterForm').show();
                $("#businessNote").prop('required', true);

            } else if ($(no).prop('checked') === true) {
                $('#proUserRegisterForm').hide();
                $("#businessNote").prop('required', false);
            }
        }

        $(".full-width[multiple]").select2({
            placeholder: '--Select--'
        });
    });
</script>
</body>
</html>