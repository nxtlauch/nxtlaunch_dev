@extends('layouts.master')
@section('styles')

@endsection

@section('contents')
    {{--{{dd($categories)}}--}}
    <!-- START PAGE CONTENT -->
    <div class="content ">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                    <!-- END BREADCRUMB -->

                    <div class="card card-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Categories</h3>
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
                    {{--<div class="card-header ">
                        <a href="#" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Category</a>
                        <div class="card-title">Categories
                        </div>
                    </div>--}}
                    <div class="card-block">
                        <div class="row">
                            {{--<div class="col-md-3">
                                <br>
                                <form method="post" action="{{route('admin.categories')}}">
                                    {{csrf_field()}}
                                    <div class="form-group form-group-default{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label>Category Name</label>
                                        <input type="Text" name="name" class="form-control"
                                               value="{{old('name')?old('name'):''}}"
                                               placeholder="Enter a category name">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Category</button>
                                </form>
                            </div>--}}
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <table class="table table-hover table-condensed no-footer">
                                    <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Icon</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td><img src="{{$category->categoryImage->image}}" alt=""/></td>
                                            <td class="text-right">
                                                <a href="{{route('admin.user.category.edit',$category->id)}}" class="btn btn-info btn-xs"
                                                   data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="javascript://" data-status="{{$category->status}}"
                                                   data-href="{{route('admin.change.user.category.status',$category->id)}}"
                                                   class="btn  {{$category->status==1?' btn-danger':' btn-success'}} btn-xs shahinDelete"
                                                   data-toggle="tooltip"
                                                   title="{{$category->status==1?'Deactivate':'Activate'}}"><i
                                                            class="fa {{$category->status==1?' fa-trash':' fa-check'}}"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
            var status = $(this).data('status');
            $('#shahinWarning').modal('show');
            $('#link').attr('href', link);
            if (status == 1) {
                $('.modal-title').text('Deactivate Category ?');
            } else {
                $('.modal-title').text('Activate Category ?');
            }
        });
    </script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{asset('public/pages/js/pages.min.js')}}"></script>
    <!-- END CORE TEMPLATE JS -->
@endsection