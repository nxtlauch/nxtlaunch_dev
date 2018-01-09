<!-- Modal -->
<div class="modal fade" id="proUser" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Only Pro User can Launch Event</h4>
            </div>
            <div class="modal-body">
                <h5>Want to be Pro-User ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{route('pro.user.registration')}}" class="btn btn-success">Yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="proUserFeature" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">This Feature is Only for Pro User</h4>
            </div>
            <div class="modal-body">
                <h5>Want to be Pro-User ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{route('pro.user.registration')}}" class="btn btn-success">Yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="shareModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Share On Social Media</h4>
            </div>
            <div class="modal-body">
                <div class="m-t-15">
                    <a id="facebook-url" target="_blank" class="btn btn-social-icon btn-facebook"
                       style="background-color: #3b5998;">
                        <span class="fa fa-facebook" style="color: white;"> Facebook</span>
                    </a>
                    <a id="google-url" target="_blank" class="btn btn-social-icon btn-google"
                       style="background-color: #a32b1c;">
                        <span class="fa fa-google" style="color: white;"> Google+</span>
                    </a>
                    <a id="twitter-url" target="_blank" class="btn btn-social-icon btn-twitter"
                       style="background-color: #1583d7">
                        <span class="fa fa-twitter" style="color: white;"> Twitter</span>
                    </a>
                    <a class="btn btn-info">
                        <span class="fa fa-clipboard plx___copy-link" style="color: white;"> Copy Url</span>
                    </a>
                </div>
                <input type="text" class="form-control m-t-15" id="Sharelink" readonly/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

{{--<div class="modal fade" id="copyLink" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Copy Link </h4>
            </div>
            <div class="modal-body">
                <textarea type="hidden" rows="3" class="form-control" id="Sharelink" readonly style="resize: none;"></textarea>
            </div>
            <div class="modal-footer">
                --}}{{--<a id="link" class="btn btn-info"  >Confirm</a>--}}{{--
                --}}{{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}{{--
                <button type="button" class="btn btn-default" id="copyLinkText">Copy</button>
            </div>
        </div>

    </div>
</div>--}}

<div class="modal fade" id="reportModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form id="reportForm" method="post" class="modal-content">
            <input id="PostID" type="hidden" name="post_id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Tell the reason why the post is inappropriate? </h6>
            </div>
            <div class="modal-body">
                <textarea rows="4" class="form-control" id="reportLink" style="resize: none; height: 80px"
                          required></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Report</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>

    </div>
</div>

<div class="modal fade" id="customNotificationModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        {{--<form id="customNotificationForm" action="{{route('frontend.save.custom.notification')}}" method="post"--}}
        <form id="customNotificationForm" class="modal-content">
            {{--<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">When you want to get this post notification ?</h6>
            </div>--}}

            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                </button>
                <h5>Notification <span class="semi-bold">Settings</span></h5>
                <p class="p-b-10">When you want to get this post notification?</p>
            </div>

            <div class="refresh-custom-notification-modal">

            </div>
            <div class="modal-footer text-left">
                <button type="submit" class="btn btn-info">Save</button>
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            </div>
        </form>

    </div>
</div>
