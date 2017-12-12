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
                        <li class="breadcrumb-item active">User Reports</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>User Reports</h3>
                            </div>
                            <div class="col-md-6">
                                <form action="#" class="form-inline pull-right">
                                    <input type="search" class="form-control" placeholder="Search">
                                </form>
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
                        <div class="card-title">User Reports
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-hover no-footer">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Reported by</th>
                                <th>Reported Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{$user->user->name}}</td>
                                    <td>{{$user->reportedBy->name}}</td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                    <td class="text-right">
                                        <a href="{{route('admin.report.userDetails',$user->id)}}" class="btn btn-primary btn-xs"
                                           data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> View</a>
                                        <a href="javascript://" data-href="{{route('admin.suspend.user',$user->user->id)}}" class="btn  btn-warning btn-xs restrictUser" data-toggle="tooltip"
                                           title="Restrict User"><i class="fa fa-ban"></i> Restrict User</a>
                                        <a href="javascript://" data-href="{{route('admin.delete.user.report',$user->id)}}" class="btn  btn-danger btn-xs deleteUserReport" data-toggle="tooltip"
                                           title="Deleted Report"><i class="fa fa-trash"></i> Deleted Report</a>
                                        <a href="javascript://" data-href="{{route('admin.delete.user',$user->user->id)}}" class="btn  btn-danger btn-xs deleteUser" data-toggle="tooltip"
                                           title="Deleted User"><i class="fa fa-trash"></i> Deleted User</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center">No User Report Found</td>
                                </tr>
                            @endforelse
                            </tbody>
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
        $(".restrictUser").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Restrict This User ?');
        });
        $(".deleteUser").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete This User ?');
        });
        $(".deleteUserReport").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete This Report ?');
        });
    </script>
@endsection