@extends('frontend.layouts.master')

@section('styles')

@endsection

@section('contents')

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
                            <div class="col-md-8" id="likeRender">
                                @include('frontend.followings.render.followingrender')
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

    <script>
        /*$(document).on("click", ".plx__like", function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            var post_id = $(this).data('id');
            console.log(link);
            console.log(post_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: link,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'post_id': post_id
                },
                dataType: 'json',
                success: function (data) {
                    $("#post_id_" + post_id).empty();
                    $("#post_id_" + post_id).html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        $(document).on("click", ".plx__follow-btn", function (e) {
            e.preventDefault();
            var link = $(this).data('href');
            var user_id = $(this).data('id');
            var post_id = $(this).data('post');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: link,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'user_id': user_id,
                    'post_id': post_id
                },
                dataType: 'json',
                success: function (data) {

                    $("#likeRender").empty();
                    $("#likeRender").html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });*/
    </script>

@endsection