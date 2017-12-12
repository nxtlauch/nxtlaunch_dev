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
                        <li class="breadcrumb-item active">User Report</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>User Report</h3>
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
                        <div class="card-title">User Report
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
                                <td>User Name</td>
                                <td width="50">:</td>
                                <td>
                                    {{$user->user->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td width="50">:</td>
                                <td>
                                    {{$user->created_at->diffForHumans()}}
                                </td>
                            </tr>
                            <tr>
                                <td>Reported by</td>
                                <td width="50">:</td>
                                <td>
                                    {{$user->reportedBy->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Reason</td>
                                <td width="50">:</td>
                                <td>
                                    {{$user->report_description}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="50"></td>
                                <td>

                                    <a href="javascript://" data-href="{{route('admin.userreport.suspend.user',$user->user->id)}}" class="btn btn-warning restrictUserReportDetails">Restrict User</a>&nbsp;
                                    <a href="javascript://" data-href="{{route('admin.userreport.delete.user',$user->user->id)}}" class="btn btn-danger deleteUserReportDetails">Delete User</a>
                                    <a href="javascript://" data-href="{{route('admin.delete.user.report',$user->id)}}"
                                       class="btn btn-danger deleteUserReport">Delete Report</a>
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
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <!-- END CORE TEMPLATE JS -->
    <script>
        $(".deleteUserReport").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete This Report ?');
        });
        $(".restrictUserReportDetails").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Suspend This User ?');
        });
        $(".deleteUserReportDetails").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete This User ?');
        });
    </script>
@endsection