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
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>User List</h3>
                            </div>
                            <div class="col-md-6">
                                <form action="{{route('admin.users.search')}}" class="form-inline pull-right">
                                    <input name="q" type="search" class="form-control" placeholder="Search" required>
                                    <input class="btn" type="submit" value="Search"/>
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Join Date</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Followers</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{date('d/m/Y', strtotime($user->created_at))}}</td>
                                    <td>Canada</td>
                                    <td>
                                        <span class="label {{($user->role_id==4)?'label-info':''}}">{{($user->role_id==3)?'Regular':(($user->role_id==4)?'Pro':'')}}</span>
                                    </td>
                                    <td>{{$user->followers_count}}</td>
                                    <td class="text-right">
                                        @if($user->role_id==4)
                                            <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-info btn-xs"
                                               data-toggle="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                                        @endif

                                        <a href="javascript://" data-href="{{route('admin.delete.user',$user->id)}}"
                                           class="btn btn-danger btn-xs shahinDelete" data-toggle="tooltip"
                                           title="Delete"><i class="fa fa-trash"></i></a>

                                        <a href="javascript://"
                                           data-href="{{route('admin.suspend.user',$user->id)}}"
                                           class="btn  btn-warning btn-xs shahinSuspend" data-toggle="tooltip"
                                           title="Suspend"><i class="fa fa-ban"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                   <td colspan="9">No user Found</td>
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
    <script>
        $(".shahinDelete").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Delete User ?');
        });
        $(".shahinSuspend").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Suspend User ?');
        });
    </script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <!-- END CORE TEMPLATE JS -->
@endsection