@extends('frontend.layouts.master')

@section('styles')

@endsection

@section('contents')
    {{--{{dd($brands)}}--}}

    <div class="page-container ">
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
            <!-- START PAGE CONTENT -->
            <div class="content">
                <div class="plx__container">
                    <!-- START CONTAINER FLUID -->
                    <div class=" container  container-fixed-lg">
                        <!-- BEGIN PlACE PAGE CONTENT HERE -->
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <ul class="brand-list">
                                    @forelse($brands as $brand)
                                        <li>
                                            <a href="#">
                                                <div class="brand-avatar ratio-1-1"
                                                     {{--style="background-image: url('http://waterfaucets.net/wp-content/uploads/2017/05/remarkable-apple-office-interior-design-office-interior-design-retail-design.jpg')">--}}
                                                     style="background-image: url('{{@$brand->userDetails->profile_picture?asset('content-dir/profile_picture/'.@$brand->userDetails->profile_picture):asset('public/frontend-assets/assets/img/profiles/avatar.jpg')}}')">
                                                </div>
                                                <div class="brand-details">
                                                    <div class="brand-details-header">
                                                        <h2 class="brand-name">{{$brand->name}}</h2>
                                                        <p class="brand-bio">{{@$brand->userDetails->business_description}}</p>
                                                        {{--<a href="javascript://" class="plx__follow-btn">Follow</a>--}}
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">This Month</span>
                                                            <span class="number">{{@$brand->posts->where('created_at','>=',date("Y-m-d H:i:s", strtotime('-1 month')))->count()}}</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Post</span>
                                                            <span class="number">{{@$brand->posts->count()}}</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4">
                                                            <span class="muted-title">Total Follower</span>
                                                            <span class="number">{{@$brand->followers->count()}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>


                        <!-- END PLACE PAGE CONTENT HERE -->
                    </div>
                    <!-- END CONTAINER FLUID -->
                </div>
            </div>
            <!-- END PAGE CONTENT -->

            @include('frontend.includes.footer.footer')
        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>

@endsection

@section('scripts')


@endsection