<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <div class="sidebar-overlay-slide from-top" id="appMenu">
        <div class="row">
            <div class="col-xs-6 no-padding">
                <a href="#" class="p-l-40"><img src="{{asset('public/assets/img/demo/social_app.svg')}}" alt="socail">
                </a>
            </div>
            <div class="col-xs-6 no-padding">
                <a href="#" class="p-l-10"><img src="{{asset('public/assets/img/demo/email_app.svg')}}" alt="socail">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 m-t-20 no-padding">
                <a href="#" class="p-l-40"><img src="{{asset('public/assets/img/demo/calendar_app.svg')}}" alt="socail">
                </a>
            </div>
            <div class="col-xs-6 m-t-20 no-padding">
                <a href="#" class="p-l-10"><img src="{{asset('public/assets/img/demo/add_more.svg')}}" alt="socail">
                </a>
            </div>
        </div>
    </div>
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="{{asset('public/assets/img/logo_white.png')}}" alt="logo" class="brand"
             data-src="{{asset('public/assets/img/logo_white.png')}}"
             data-src-retina="{{asset('public/assets/img/logo_white_2x.png')}}" width="78" height="22">
        <div class="sidebar-header-controls">
            <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20 hidden-md-down"
                    data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
            </button>
            <button type="button" class="btn btn-link hidden-md-down" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
            <li class="m-t-30 ">
                <a href="{{route('admin.dashboard')}}" class="detailed">
                    <span class="title">Dashboard</span>
                </a>
                <span class="bg-success icon-thumbnail"><i class="pg-home"></i></span>
            </li>
            <li class="">
                <a href="{{route('admin.users')}}" class="detailed">
                    <span class="title">Users</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-user-circle"></i></span>
            </li>
            <li>
                <a href="javascript:;"><span class="title">Posts</span>
                    <span class=" arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-file-text"></i></span>
                <ul class="sub-menu">
                    <li class="">
                        <a href="{{route('admin.posts')}}">Post List</a>
                        <span class="icon-thumbnail">PL</span>
                    </li>
                    <li class="">
                        <a href="{{route('admin.categories')}}">Categories</a>
                        <span class="icon-thumbnail">C</span>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><span class="title">Reports</span>
                    <span class=" arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-line-chart"></i></span>
                <ul class="sub-menu">
                    <li class="">
                        <a href="{{route('admin.report.users')}}">User Reports</a>
                        <span class="icon-thumbnail">RU</span>
                    </li>
                    <li class="">
                        <a href="{{route('admin.post.reports')}}">Post Reports</a>
                        <span class="icon-thumbnail">RP</span>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{url('/admin/settings')}}" class="detailed">
                    <span class="title">Settings</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-cog"></i></span>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->