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
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>User List</h3>
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
                        <div class="card-title">User List
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-hover table-condensed no-footer">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Join Date</th>
                                <th>:(</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Followers</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                            $randNumber = rand(1, 2);

                            if ($randNumber == 1) {
                                $status = "Regular";
                                $statusClass = "";
                            } else {
                                $status = "Pro";
                                $statusClass = "label-info";
                            }
                            ?>
                            <tr>
                                <td>joliver</td>
                                <td>Johnny Oliver</td>
                                <td>joliver@example.com</td>
                                <td>+0123456789</td>
                                <td>22/07/2017</td>
                                <td>:(</td>
                                <td>$ <?= rand(120, 1200)?>.00</td>
                                <td><?= rand(0, 400)?></td>
                                <td><span class="label <?=$statusClass?>"><?=$status?></span></td>
                                <td class="text-right">
                                    <a href="{{url('/adminusers/edit/12')}}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                                    <a href="#" class="btn  btn-warning btn-xs" data-toggle="tooltip" title="Suspend"><i class="fa fa-ban"></i></a>
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