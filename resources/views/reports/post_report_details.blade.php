@extends('layouts.master')
@section('styles')

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
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Post Report</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Post Report</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid   container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->

            <div class="container-fluid   container-fixed-lg bg-white">
                <div class="card card-transparent">
                    <div class="card-header ">
                        <div class="card-title">Post Report
                        </div>
                    </div>
                    <div class="card-block">
                        <style>
                            .plx__table td {
                                vertical-align: top;
                                line-height: 2;
                                padding: 5px;
                            }
                        </style>
                        <table class="plx__table">
                            <tr>
                                <td>Post Author Name</td>
                                <td width="50">:</td>
                                <td>
                                    {{$postReport->post->user->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Post Description</td>
                                <td width="50">:</td>
                                <td>
                                    {{$postReport->post->post_details}}
                                </td>
                            </tr>
                            <tr>
                                <td>Post Photo</td>
                                <td width="50">:</td>
                                <td>
                                    <img src="{{asset('content-dir/posts/images/'.$postReport->post->image)}}" alt=""
                                         width="200">
                                </td>
                            </tr>
                            <tr>
                                <td>Report Description</td>
                                <td width="50">:</td>
                                <td>
                                    {{$postReport->report_description}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="50"></td>
                                <td>
                                    <a href="javascript://"
                                       data-href="{{route('admin.report.suspend.user',$postReport->post->user->id)}}"
                                       class="btn  btn-warning btn-xs restrictUser" data-toggle="tooltip"
                                       title="Restrict User"><i class="fa fa-ban"></i> Restrict User</a>
                                    <a href="javascript://"
                                       data-href="{{route('admin.report.suspend.post',$postReport->post->id)}}"
                                       class="btn  btn-warning btn-xs restrictPost" data-toggle="tooltip"
                                       title="Restrict Post"><i class="fa fa-ban"></i> Restrict Post</a>
                                    <a href="javascript://" data-href="{{route('admin.delete.report',$postReport->id)}}"
                                       class="btn  btn-danger btn-xs deleteReport" data-toggle="tooltip"
                                       title="Delete Report"><i class="fa fa-trash"></i> Delete Report</a>
                                    <a href="javascript://"
                                       data-href="{{route('admin.report.delete.user',$postReport->post->user->id)}}"
                                       class="btn  btn-danger btn-xs deleteUser" data-toggle="tooltip"
                                       title="Delete User"><i class="fa fa-trash"></i> Delete User</a>
                                </td>
                            </tr>
                        </table>
                    </div>
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
        $(".restrictUser").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Restrict This User ?');
        });
        $(".restrictPost").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Restrict This Post ?');
        });
        $(".deleteUser").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete This User ?');
        });
        $(".deleteReport").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete This Report ?');
        });
    </script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <!-- END CORE TEMPLATE JS -->
@endsection