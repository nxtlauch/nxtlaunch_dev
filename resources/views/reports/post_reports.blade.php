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
                        <li class="breadcrumb-item active">Post Reports</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Post Reports</h3>
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
                        <div class="card-title">Post Reports
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-hover no-footer">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Post Title</th>
                                <th>Report Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($postReports as $post)
                                <tr>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->post->post_details}}</td>
                                    <td>{{$post->created_at->diffForHumans()}}</td>
                                    <td class="text-right">
                                        <a href="{{route('admin.post.report.details',$post->id)}}"
                                           class="btn btn-primary btn-xs"
                                           data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> View</a>
                                        <a href="javascript://" data-href="{{route('admin.suspend.user',$post->post->user->id)}}" class="btn  btn-warning btn-xs restrictUser" data-toggle="tooltip"
                                           title="Restrict User"><i class="fa fa-ban"></i> Restrict User</a>
                                        <a href="javascript://" data-href="{{route('admin.suspend.post',$post->post->id)}}" class="btn  btn-warning btn-xs restrictPost" data-toggle="tooltip"
                                           title="Restrict Post"><i class="fa fa-ban"></i> Restrict Post</a>
                                        <a href="javascript://" data-href="{{route('admin.delete.report',$post->id)}}" class="btn  btn-danger btn-xs deleteReport" data-toggle="tooltip"
                                           title="Delete Report"><i class="fa fa-trash"></i> Delete Report</a>
                                        <a href="javascript://" data-href="{{route('admin.delete.user',$post->post->user->id)}}" class="btn  btn-danger btn-xs deleteUser" data-toggle="tooltip"
                                           title="Delete User"><i class="fa fa-trash"></i> Delete User</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center;">No Post Report yet</td>
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