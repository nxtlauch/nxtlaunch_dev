<!-- BEGIN VENDOR JS -->
<script src="{{asset('public/frontend-assets')}}/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery/jquery-1.11.1.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/js/jquery.cookie.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-ui/jquery-ui.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/tether/js/tether.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-unveil/jquery.unveil.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-ios-list/jquery.ioslist.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript"
        src="{{asset('public/frontend-assets')}}/assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="{{asset('public/frontend-assets')}}/assets/plugins/classie/classie.js"></script>
<script src="{{asset('public/frontend-assets')}}/assets/plugins/switchery/js/switchery.min.js"
        type="text/javascript"></script>
<script src="{{asset('public/frontend-assets')}}/assets/js/jquery.countdown.min.js"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{asset('public/frontend-assets/pages/js/pages.js')}}"></script>
<!-- END CORE TEMPLATE JS -->
{{--toast--}}
<script src="{{ asset('public/assets/js/toast/jquery.toast.js') }}" type="text/javascript"></script>
{{--end toast--}}

@yield('scripts')
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{asset('public/frontend-assets/assets/js/scripts.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->

<script>
    function myFunction() {
        // Declare variables
        var input, filter, ul, li, a, i;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    function myChatFunction() {
        // Declare variables
        var input, filter, ul, li, a, p, i, span;
        input = document.getElementById('myChatInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("myChatUL");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            span = li[i].getElementsByClassName("text-master")[0];
            if (span.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    $('.main-search-form').one("click", function (e) {
        'use strict';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '{{route('frontend.search.datalist')}}',
            data: {
                '_token': $('input[name=_token]').val()
            },
            dataType: 'json',
            success: function (data) {
                $("#myUL").empty();
                $("#myUL").html(data);

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>

<script>
    /*Like post*/
    $(document).on("click", ".plx__like", function (e) {
        e.preventDefault();
        var link = $(this).data('href');
        var post_id = $(this).data('id');

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
                var likeUnlike = $("#post_id_" + post_id).find('.plx__like');
                var currentCount = $('#post_id_' + post_id).find('.likeCount').text();
                if (data.status == 1) {
                    likeUnlike.addClass('liked');
                    likeUnlike.attr('title', 'Unlike');
                    $('#post_id_' + post_id).find('.likeCount').text(parseInt(currentCount) + 1);
                }
                else {
                    likeUnlike.removeClass('liked');
                    likeUnlike.attr('title', 'Like');
                    $('#post_id_' + post_id).find('.likeCount').text(parseInt(currentCount) - 1);
                }
                $("#post_id_" + post_id).find('.Plx__like__count').html(data.content);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    /*follow*/
    $(document).on("click", ".plx__follow-btn", function (e) {
        e.preventDefault();
        var link = $(this).data('href');
        var user_id = $(this).data('id');

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
                'user_id': user_id
            },
            dataType: 'json',
            success: function (data) {
                var followUnfollow = $(".user-follow_" + user_id)
                if (data.status == 1) {
                    followUnfollow.addClass('added');
                    followUnfollow.html('Following');
                }
                else {
                    followUnfollow.removeClass('added');
                    followUnfollow.html('Follow');
                }
//                    $(".user-follow_" + user_id).removeClass('add')

                /*$("#postrender").empty();
                $("#postrender").html(data);
                shouldInit();*/
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    /*End follow*/

    /*Comment */
    $(document).on("submit", "form.postComment", function (e) {
        e.preventDefault();
        var formObj = $(this);
        var comment = formObj.find('.textareaComment').val();
        var formURL = formObj.attr("action");
        var post_id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: formURL,
            data: {
                '_token': $('input[name=_token]').val(),
                'comment': comment
            },
            dataType: 'json',
            success: function (data) {
                $("#post_id_" + post_id).find('.Plx__comment__count').html(data.content);
                $('#commentFor-' + post_id).append(data.comment);
                formObj.find('.textareaComment').val('');

                var showingCommentCount = $("#post_id_" + post_id).find('.showingCommentCount'),
                    showingCommentCountValue = $(showingCommentCount).val();

                /*var currentCount = $('#post_id_' + post_id).find('.commentsCount').text();
                $('#post_id_' + post_id).find('.commentsCount').text(parseInt(currentCount) + 1);*/
                var currentShowing = $('#post_id_' + post_id).find('.load-more-comment').data('count');
                if (parseInt(showingCommentCountValue) < 2) {
                    // $('#post_id_' + post_id).find('.load-more-comment').attr('data-count', (parseInt(currentShowing) + 1));
                    $(showingCommentCount).val(parseInt(showingCommentCountValue) + 1);
                }


                if ($('ul#commentFor-' + post_id + ' li').length > 2) {
                    $('#commentFor-' + post_id + " li").first().remove();
                    // $("#post_id_" + post_id).find('.no-more-comment').addClass('hidden');
                    $("#post_id_" + post_id).find('.load-more-comment').removeClass('hidden');
                }
                formObj.find('.submit-btn').prop('disabled', true);

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });

    /*Post Report*/
    $(document).on("submit", "form#reportForm", function (e) {
        e.preventDefault();
        var link = '{{route('frontend.report.post')}}';
        var report_description = $('#reportLink').val();
        var post_id = $('#PostID').val();
        $("#reportModal").modal('hide');
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
                'report_description': report_description,
                'post_id': post_id
            },
            dataType: 'json',
            success: function (data) {
                $("#post_id_" + post_id).find('.plx__report12').html('Reported');
                $("#post_id_" + post_id).find('.plx__report12').removeClass('plx__report12');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });
    /*Post Report*/
    $(document).on("submit", "form#my-conversation", function (e) {
        e.preventDefault();
        var link = '{{route('frontend.conversation.save')}}';
        var name = $('#my-conversation').find('.conversationName').val();
        var user_id = $('#my-conversation').find('.userIdClass').val();
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
                'name': name,
                'user_id': user_id
            },
            dataType: 'json',
            success: function (data) {
                $('#my-conversation').find('.conversationName').val('');
                $('#myChatUL').prepend(data.content)
                asset = $("#chatrefresh").html();
                $("#chatrefresh").empty();
                $('#chat').removeClass('push-parrallax');
                $("#chatrefresh").html(data.chatHistory);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });

    var asset;
    $(document).on("click", ".chat-click", function (e) {
        e.preventDefault();

        var link = $(this).data('href');

        var to_id = $(this).data('id');

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
                'to_id': to_id
            },
            dataType: 'json',
            success: function (data) {
                asset = $("#chatrefresh").html();
                $("#chatrefresh").empty();
                $("#chatrefresh").html(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    $(document).on("click", "#chat-insert", function (e) {
        e.preventDefault();

        var link = $(this).data('href');

        var to_id = $(this).data('id');

        var message = $('#chat_input').val();

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
                'to_id': to_id,
                'message': message,
            },
            dataType: 'json',
            success: function (data) {
                $("#chatrefresh").empty();
                $("#chatrefresh").html(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    $(document).on("click", ".load-more-comment", function (e) {
        e.preventDefault();
        var loadMoreBtn = $(this);
        var post_id = $(loadMoreBtn).data('id');
        //var count = $(loadMoreBtn).data('count');
        var count = $("#post_id_" + post_id).find('.showingCommentCount').val();
        var link = '{{route('frontend.commentload')}}';
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
                'post_id': post_id,
                'skip': count,
            },
            dataType: 'json',
            success: function (data) {
                $('#commentFor-' + post_id).prepend(data.content);

                $("#post_id_" + post_id).find('.showingCommentCount').val(parseInt(count) + data.count);

                if (data.count < 10) {
                    // $("#post_id_" + post_id).find('.no-more-comment').removeClass('hidden');
                    $("#post_id_" + post_id).find('.load-more-comment').addClass('hidden');

                }
                /*formObj.find('.textareaComment').val('');
                $('#commentFor-' + post_id).find('.plx__comment-list .empty').remove();
                var currentCount = $('#post_id_' + post_id).find('.commentsCount').text();
                $('#post_id_' + post_id).find('.commentsCount').text(parseInt(currentCount) + 1);*/
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on("click", ".back-chat-list", function (e) {
        e.preventDefault();
        $("#chatrefresh").html(asset);
    });
    //    $(document).on("click", ".plx__share", function (e) {
    //        e.preventDefault();
    //        $("#shareModal").modal('show');
    //
    //    });
    /*Copy Link*/
    $('.copyLink').on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var targetInput = $(this).attr('href');
        $(targetInput).select();
        document.execCommand('copy');
        $(this).closest('.social-list-modal').hide();
    });
    /*$(document).on("click", "#copyLinkText", function (e) {
        $("#Sharelink").select();
        document.execCommand('copy');
        $("#copyLink").modal('hide');
    });*/
    /*End Copy Link*/

    $(document).on("click", ".plx__report12", function (e) {
        e.preventDefault();
        var post_id = $(this).data('post');
        $('#reportLink').val('');
        $('#PostID').val(post_id);
        $("#reportModal").modal('show');

    });
    $(document).on("click", ".search-keyword", function (e) {
        e.preventDefault();
        var input = $(this).html();
        $("#myInput").val(input);
        $("#plx__mainSearch").submit();
    });

    /*$(document).ready(function () {
        // Read the cookie and if it's defined scroll to id
        var scroll = $.cookie('scroll');
        if(scroll){
            scrollToID(scroll, 1000);
            $.removeCookie('scroll');
        }
        // Handle event onclick, setting the cookie when the href != #
        $('.notification-item a').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var href = $(this).attr('href');
            if (href === '#') {
                scrollToID(id, 1000);
            } else {
                $.cookie('scroll', id);
                window.location.href = href;
            }
        });
        // scrollToID function
        function scrollToID(id, speed) {
            var offSet = 70;
            var obj = $('#' + id).offset();
            var targetOffset = obj.top - offSet;
            $('html,body').animate({ scrollTop: targetOffset }, speed);
        }
    });*/
</script>