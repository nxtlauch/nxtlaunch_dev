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
                        <li class="breadcrumb-item active">Posts</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Post List</h3>
                            </div>
                            <div class="col-md-6">
                                <form action="{{route('admin.posts.search')}}" class="form-inline pull-right">
                                    <input name="q"  type="search" class="form-control" placeholder="Search" required>
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
                            @forelse($posts as $post)
                                {{--{{dd($post)}}--}}
                                {{--{{dd($post->created_at)}}--}}
                                <tr>
                                    <td>{{$post->user->name}}</td>
                                    <td><strong>{{$post->post_details}}</strong></td>
                                    <td>{{$post->created_at->format('d/m/Y')}}</td>
                                    <td>{{date('d/m/Y H:i a', strtotime($post->expire_date))}}</td>
                                    <td class="text-right">
                                        <a href="#" class="btn btn-primary btn-xs" data-toggle="tooltip" title="View"><i
                                                    class="fa fa-eye"></i></a>
                                        <a href="{{route('admin.post.edit',$post->id)}}" class="btn btn-info btn-xs"
                                           data-toggle="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                                        <a href="javascript://" data-href="{{route('admin.delete.post',$post->id)}}"
                                           class="btn btn-danger btn-xs shahinDelete" data-toggle="tooltip"
                                           title="Delete"><i class="fa fa-trash"></i></a>
                                        <a href="javascript://" data-href="{{route('admin.suspend.post',$post->id)}}"
                                           class="btn  btn-warning btn-xs shahinSuspend" data-toggle="tooltip"
                                           title="Restrict"><i class="fa fa-ban"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center">No user Found</td>
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
            $('.modal-title').text('Delete Post ?');
        });
        $(".shahinSuspend").click(function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            $('.modal-title').text('Suspend Post ?');
        });
    </script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <!-- END CORE TEMPLATE JS -->
@endsection