@extends('layouts.master')
@section('styles')
    <link href="{{asset('public/assets/plugins/nvd3/nv.d3.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('public/assets/plugins/mapplic/css/mapplic.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/rickshaw/rickshaw.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet"
          type="text/css" media="screen">
    <link href="{{asset('public/assets/plugins/jquery-metrojs/MetroJs.css')}}" rel="stylesheet" type="text/css"
          media="screen"/>
@endsection

@section('contents')
    <!-- START PAGE CONTENT -->
    <div class="content ">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Dashboard</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-transparent">
                        <div class="card-header ">
                            <div class="card-title">Latest Users
                            </div>
                        </div>
                        <div class="card-block">
                            <table class="table table-hover no-footer">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->email}}</td>
                                        <td class="text-right">
                                            @if($user->role_id==4)
                                                <a href="{{route('admin.user.edit',$user->id)}}"
                                                   class="btn  btn-info btn-xs" data-toggle="tooltip"
                                                   title="Edit User"><i class="fa fa-edit"></i></a>
                                            @endif
                                            <a href="javascript://" data-href="{{route('admin.delete.user',$user->id)}}"
                                               class="btn btn-danger btn-xs shahinDelete" data-toggle="tooltip"
                                               title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center">No user Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="...">
                            {{ $users->links() }}
                        </nav>
                    </div>
                    <div class="card card-transparent">
                        <div class="card-header ">
                            <div class="card-title">Latest Post
                            </div>
                        </div>
                        <div class="card-block">
                            <table class="table table-hover table-condensed no-footer">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Post Title</th>
                                    <th>Total View</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($posts as $post)
                                    <tr>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->post_details}}</td>
                                        <td>user@user.com</td>
                                        <td class="text-right">
                                            <a href="#" class="btn  btn-info btn-xs" data-toggle="tooltip" title="View"><i
                                                        class="fa fa-eye"></i></a>
                                            <a href="javascript://" data-href="{{route('admin.delete.post',$post->id)}}"
                                               class="btn btn-danger btn-xs shahinDeletepost" data-toggle="tooltip"
                                               title="Delete"><i class="fa fa-trash"></i></a>

                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="widget-14 card no-border  no-margin widget-loader-circle">
                        <div class="container-xs-height full-height">
                            <div class="row-xs-height">
                                <div class="col-xs-height">
                                    <div class="card-header ">
                                        <div class="card-title">Server load
                                        </div>
                                        <div class="card-controls">
                                            <ul>
                                                <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i
                                                                class="card-icon card-icon-refresh"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-xs-height">
                                <div class="col-xs-height">
                                    <div class="p-l-20 p-r-20">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12">
                                                <h4 class="bold no-margin">5.2GB</h4>
                                                <p class="small no-margin">Total usage</p>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <h5 class=" no-margin p-t-5">227.34KB</h5>
                                                <p class="small no-margin">Currently</p>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <h5 class=" no-margin p-t-5">117.65MB</h5>
                                                <p class="small no-margin">Average</p>
                                            </div>
                                            <div class="col-lg-3 visible-xlg">
                                                <div class="widget-14-chart-legend bg-transparent text-black no-padding pull-right"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-xs-height">
                                <div class="col-xs-height relative bg-master-lightest">
                                    <div class="widget-14-chart_y_axis"></div>
                                    <div class="widget-14-chart rickshaw-chart top-left top-right bottom-left bottom-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <!-- START WIDGET D3 widget_graphOptionsWidget-->
                    <div class="widget-16 card no-border  no-margin widget-loader-circle">
                        <div class="card-header ">
                            <div class="card-title">Page Options
                            </div>
                            <div class="card-controls">
                                <ul>
                                    <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i
                                                    class="card-icon card-icon-refresh"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-16-header padding-20 d-flex">
                            <span class="icon-thumbnail bg-master-light pull-left text-master">ws</span>
                            <div class="flex-1 full-width overflow-ellipsis">
                                <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">Pages
                                    name
                                </p>
                                <h5 class="no-margin overflow-ellipsis ">Webarch Sales Analysis</h5>
                            </div>
                        </div>
                        <div class="p-l-25 p-r-45 p-t-25 p-b-25">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <p class="hint-text all-caps font-montserrat small no-margin ">Views</p>
                                    <p class="all-caps font-montserrat  no-margin text-success ">14,256</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <p class="hint-text all-caps font-montserrat small no-margin ">Today</p>
                                    <p class="all-caps font-montserrat  no-margin text-warning ">24</p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <p class="hint-text all-caps font-montserrat small no-margin ">Week</p>
                                    <p class="all-caps font-montserrat  no-margin text-success ">56</p>
                                </div>
                            </div>
                        </div>
                        <div class="relative no-overflow">
                            <div class="widget-16-chart line-chart" data-line-color="success" data-points="true"
                                 data-point-color="white" data-stroke-width="2">
                                <svg></svg>
                            </div>
                        </div>
                        <div class="b-b b-t b-grey p-l-20 p-r-20 p-b-10 p-t-10">
                            <p class="pull-left">Post is Public</p>
                            <div class="pull-right">
                                <input type="checkbox" data-init-plugin="switchery"/>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="b-b b-grey p-l-20 p-r-20 p-b-10 p-t-10">
                            <p class="pull-left">Maintenance mode</p>
                            <div class="pull-right">
                                <input type="checkbox" data-init-plugin="switchery" checked="checked"/>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="p-l-20 p-r-20 p-t-10 p-b-10 ">
                            <p class="pull-left no-margin hint-text">Super secret options</p>
                            <a href="#" class="pull-right"><i class="fa fa-arrow-circle-o-down text-success fs-16"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </div>
            </div>
            <!-- END PLACE PAGE CONTENT HERE -->
        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->
    @include('includes.modals.warning')
@endsection

@section('scripts')
    <script>
        $(".shahinDelete").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete User ?');
        });

        $(".shahinDeletepost").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete Post ?');
        });
    </script>
    <script src="{{asset('public/assets/plugins/nvd3/lib/d3.v3.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/nvd3/nv.d3.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/nvd3/src/utils.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/nvd3/src/tooltip.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/nvd3/src/interactiveLayer.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/nvd3/src/models/axis.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/nvd3/src/models/line.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/nvd3/src/models/lineWithFocusChart.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/mapplic/js/hammer.js')}}"></script>
    <script src="{{asset('public/assets/plugins/mapplic/js/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('public/assets/plugins/mapplic/js/mapplic.js')}}"></script>
    <script src="{{asset('public/assets/plugins/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/jquery-metrojs/MetroJs.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/skycons/skycons.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"
            type="text/javascript"></script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <!-- END CORE TEMPLATE JS -->
    <script src="{{asset('public/assets/js/dashboard.js')}}" type="text/javascript"></script>

    <script>
        $(document).keypress(function (e) {
            console.log(e.which);
        });

    </script>
@endsection