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
                        <li class="breadcrumb-item active">Posts</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Post List</h3>
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
            <div class="container-fluid container-fixed-lg bg-white">
                <div class="card card-transparent">
                    <div class="card-header ">
                        <div class="card-title">Post List
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-hover table-condensed no-footer">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Post Title</th>
                                <th>Post Date</th>
                                <th>Nextluanch Time</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                            ?>
                            <tr>
                                <td>joliver</td>
                                <td><strong>Lorem ipsum dolor sit amet.</strong></td>
                                <td>22/07/2017</td>
                                <td>4:50am</td>
                                <td class="text-right">
                                    <a href="#" class="btn btn-primary btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{url('/adminusers/edit/12')}}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn  btn-warning btn-xs" data-toggle="tooltip" title="Restrict"><i class="fa fa-ban"></i></a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
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
@endsection

@section('scripts')
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <!-- END CORE TEMPLATE JS -->
@endsection