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
            <h4 class="semi-bold text-center">Pro User Registration</h4>
            <hr>
            <!-- START Login Form -->
            <form id="form-login" class="p-t-15" method="post" role="form" action="{{route('pro.user.registration')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Are you interested to resister as pro user?</label>
                    <div class="radio m-t-0 radio-primary">
                        <input class="proUserCheckYes" type="radio" checked="checked" value="yes" name="proUserCheck"
                               id="yes">
                        <label for="yes">Yes</label>
                        <input class="proUserCheckNo" type="radio" value="no" name="proUserCheck" id="no">
                        <label for="no">No</label>
                    </div>
                </div>
                <div id="proUserRegisterForm">

                    <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                        <label>What type of business you serve?</label>
                        <ul class="business-type-list">
                            @foreach($categories as $key => $category)
                                <li>
                                    <label for="userCategory{{$category->id}}" class="business-type"
                                           data-toggle="tooltip"
                                           title="{{$category->name}}">
                                        <input type="radio" id="userCategory{{$category->id}}" name="category_name"
                                               value="{{$category->name}}" {{$key == 0?'checked':''}}>
                                        <span class="box-icon local-business">
                                    <img src="{{$category->categoryImage->image}}">
                                </span>
                                    </label>
                                </li>
                            @endforeach
                            {{--<li>
                                <label for="coro" class="business-type" data-toggle="tooltip"
                                       title="Company or Organization">
                                    <input type="radio" id="coro" name="category_name" value="Company or Organization">
                                    <span class="box-icon local-business">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsBAMAAADsqkcyAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAnUExURTIyMjAwMDIyMjIyMjIyMjIyMjIyMjIyMjMzMzIyMjIyMjIyMjIyMoGK6V4AAAANdFJOUx4Fbd/6f5i+RDtYLKiN1ZT6AAABhElEQVQoFa2SPU/CQBjH2+QS1x7lpbQsJQ6okyHCivSEGFkQagyjBiYXI5HFARMlJEyXyOYAiYaZj2CM38vnXnrcEePEv8nd5den/z4vZ2GhtdzlZok9X9sJnhguwvvz6mwYg8LkHceFqByRMqhp4A+ar3UYeWtLzqKdBg6OVwxkLjS8Vy8mimzBIdohms4VTp2KI18rCnutgdJdXWG8P1IatjcYUXGGNTmyBBHNnWQrmWqquoX9a7/n9YLLLYxt/lgYLWxuKEzcVq5ZiDIEI0I4FzgYO2NnhmcYlV6WLFxg7yh/EJScQ/BO3xSLS4ndRq6Z5SbUhU7UJGbfcfG8ocfCJKFgMmnjBJemTDM8fUZ09aWwaCx41w2ThcVkY8tGtHOvoqnmPQ81rIpnEckv6aZ4A2+Kf4eJlPW8RfFzmN+DjmXxuneWEDFbI2/Wtm+/7w2geGewVpmkl7iTevSfGB5RA4OpnPy/+LXb7/7E/NrH3T5c/mG8hn7fsgtvKmRj+EM7wb/vX5XtazDf+AAAAABJRU5ErkJggg==">
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label for="borp" class="business-type" data-toggle="tooltip" title="Brand or product">
                                    <input type="radio" id="borp" name="category_name" value="Brand or product">
                                    <span class="box-icon local-business">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsBAMAAADsqkcyAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAnUExURTIyMjIyMjIyMi8vLzMzMzIyMjIyMjIyMjIyMjIyMjIyMjExMTIyMvM8KvMAAAANdFJOU/sPPAIlw6XqeFSOZdgs6YuPAAACVElEQVQoFW3Sy08TURQG8AtteUgXpgNigouGUVjI5s43HebhQlIjiW5KKmqIC0hNiIYFCmLFTZWFLlwQRo3LiY3RqAsSVHxsiPW18I/yO/MQTTjpzJzzu2fuTO9chQNDZVr6/PrV46xAyvq9Ks5eUmtmOpCwjnreEUqPimHiCe82jaQcK5hxEvPQIQP65MNPlBMDf9n+aWKkpnqVcR+I2uLSPf0NwfLlKUDvNeD1pKx/G3btqhTwwio220zYXVnF+FemJR64ZQT9CW+bVsFguomjwPgMFlko6HVM16nkFmCvYbgh7N/AFUO4hOuYQnknyAsPbwTdorD5W5euH8LbhtzF2AT8GZmzZZAvYruasVwfGId3oPQAZmOVbugXOB1WGlBWXvfts9tEpeF3oIKcxSdLSDfD73g5KL8TdCV1ynGf8utuTn8xODIf8nTe9Lrsbiin7q5YyqSoBk9Rx8oL+x03x5LxJHk0u/NQ7oqXzo3WhozyZnI8lZSEPljX4NQDvgknWk8UbLdrxmTbqfPPN7GUsdsFjbI52SYvoRxmPtiG1Ca5bFY6GfP7Wv14C/KphpUuCgc/4lhd1kjB60bLlPZzcsJilR+CzHV1bgrEa+L287PFXG7rWkie4KHnN/R3XtnNjeFwE8YxcQfOasKIQuw2q8JjhSrmTSbshjMA/bL4ZuvZIrf3kGyqmBEtQD/dU71zJizu3oy92ztMBw0+MrrALO3GkeK9uLKiu/E1mQQ4q+a2zox+WP5l/McYWVJKFZ4nmE0ilT16PMN/ed+YyXsfEH8AfeDmBPk9O2MAAAAASUVORK5CYII=">
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label for="corc" class="business-type" data-toggle="tooltip" title="Cause/Community">
                                    <input type="radio" id="corc" name="category_name" value="Cause/Community">
                                    <span class="box-icon local-business">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsBAMAAADsqkcyAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAnUExURTQ0NDIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMtdkbyoAAAANdFJOUwb4Ha1YQnYy4JTNZ7w5OuRjAAACE0lEQVQoFYWSwWvTcBTHv02TpU166G9Zu1Z3iB3uoJdmA53gIbkIu6VCQdFDM6VM8ZDiSb20OkeRHTKcCvUSL8pghyqIyjysB2XMf8r30qSNWvALeb/3Pvz6fb/f+xVIpFqGn+SptbOzNZ8qOVVN4BQ4BCSf67F0YQALwEfAEsOEovHGCSTCjpnfflSa4AH0Ip4B68gMcTDBa5CLcC4/LCFjY22CPb8QQu5VbGjH6tkJLpzp+YBCn1p5dzzB2NgEvgvxC1jZn9KLLy+5N4y716znyp0rnxK+LA5PKoZJd7F6u6didcylfouOHHCRp3563+QUhacU1qOUD48LYZQ7Li3lKOXrIz7igNP4yh2Xiqv06e0X7Xb7XpUCyXtNYdS2YfVnyEhM6XcpeTzmf+UQfnLk5twHWMwHHfxUusrRFzAeiTBjD6SFrR3HPJCLmliKMHnkzVsQSyOBz1LAlrx7rCzd26vHxRR7Lk08eYIprvLGvdTu2++pkOeZnLMp3P/B3mr5a4uahgSgBcDctucTnqvLXSBbJxrFnJ1tMQ71MI21ocZY2rVsMumClAuoS/WEvbHyioCyyDga983NCHON6LmSp0vhRosOkfwt2WQs3fBVaxgXjM83Tc39BkHCWyWUmtcjk3iwpccfGunBSjVk/Q2s6sNl7Kt11MxUy9h1vDio1mZoDx63+ltlSM0ZMv+w/G/xGxgCfUnxMOeQAAAAAElFTkSuQmCC">
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label for="entertainment" class="business-type" data-toggle="tooltip"
                                       title="Entertainment">
                                    <input type="radio" id="entertainment" name="category_name" value="Entertainment">
                                    <span class="box-icon local-business">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsBAMAAADsqkcyAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAqUExURTIyMjIyMjIyMjIyMjIyMjIyMi0tLTIyMjExMTIyMjIyMjIyMjIyMjIyMlYwqwMAAAAOdFJOU5nPULR2DwIlYIXpOvqK48hiEAAAAaxJREFUKBWt0s9LwlAcAPAXWBAUNC0pKYhRBtKhsAzCQKw8dMqSaXhZ2vvOqFOJgRIogSV06FDSoYtYUtF5hJ0sooudgk71v/R9m7k98RR94f367Lvv3ttGoG2Qtgp/ZKVgUY2Cv0Vi3oWPstT0BtP5C4D1cjO/wdVZlpi8/k3XeeddX6dTDdc54WbLREAOcAy7KYgWHMJGF8+bzv3a1Pimr8hz/PhOAojZ8jxvuwMIyr3Ks1wHCahSz/McX4q9wWQ4W+R5u5/mIUJXnDzTLwlhhzvlniiKLj92o1bsxAlMwFPGSwIXDo/GOXa/Keigxr06rZ072eQJ4Ezjbo1DJWJjjuwzWBFUkIUUwAHHaQ/ubxU7sckU703alTGvtYKzJh/hlL56bcvuCsAJx1DDrzlpxwQl0Hgky4ZaRgpXK5gdfzbzUCT1eGjH67FOM7tUANaMnYQxB+RPAAuOxr4zjJVb2LrB0TjlHmM4HXlQcTCYIUAuy0qbijCEXN1/9eI0PXKRaXAwOj0X0n/lGe0NBvsIIcPYCOmZwq5jQGNa+ObiUtKY1WgN0gr6+l/4ByBmc7cVp1eSAAAAAElFTkSuQmCC">
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label for="artist" class="business-type" data-toggle="tooltip"
                                       title="Artist, Band or Public Figure">
                                    <input type="radio" id="artist" name="category_name"
                                           value="Artist, Band or Public Figure">
                                    <span class="box-icon local-business">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsBAMAAADsqkcyAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAnUExURTIyMjIyMjIyMjQ0NDIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMpmuunQAAAANdFJOU/quxAIQYDPYIeiUSHextzKuAAAB/ElEQVQoFXWSv2/TQBTHX47UxkmHk4yYGCxFqpBgqPMcx7UzRHEhS4crroSQGBI6dQtKqVRgsOSNKQIKQmKwZDYYKnmBzVJYkPijeGe3zlkqt7x7n/veu/fjAG9ccCNFFT86qjUKHgBEiM8Teabgy69/ujgBTcWH90Ir8Zhj/Wgp2AY4/Yx4brc8pmBx/6Al1WlvqmKe4EK8egr6vqViK0RrBAB3+p33SpBi7TIUcBe5qeIp49qc6AuGKva4fgg7OIdvdItWXc6c6DvYcXlHxcHqAR7AG5ezXMXDLiK/wLiidZDYREwjR2RSu4k97iHGby34VNJa3afG2WD81Zs4oMZ5388xzUteJ2gdk78IZ2YTX0ofomG7iWdLxADM0VYDe6uc3jTabjmcOpOpVM0eblF4Kb9+kmeUyeqIYREp2Jd3f0FkJbLcWi1aPx8/Ab4W673lBgfGgibGZtn4ojA3+ERzrdfPtDjrg5HUmLILjERkY9Pu/Ja0ymSyjSea8yXcNe2qyArzzFms/W3c7fm3S3GJfYYTHeMl7i398mNWQcQp8i7yHIcfRjQ7uahK10h8MAP6CP1bg6pTEttd+k/JUI6ngdtUTVhkiL521VepHrBUEy+NkPpt8I8ycvVkauQ+nEmv0HNpKuwcI+6XHiaVKfO+2qrmegwqo/1/8D/0qNSbpqYXSAAAAABJRU5ErkJggg==">
                                    </span>
                                </label>
                            </li>--}}
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


                <!-- END Form Control-->
                <button class="btn btn-block btn-primary btn-cons m-t-10 m-b-15" type="submit">Continue</button>
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
                {{--/*setTimeout(function () {--}}
                {{--window.location.replace("{{url('/')}}");--}}
                {{--}, 500);*/--}}
            }
        }

    })
</script>
</body>
</html>