<input type="hidden" name="post_id" value="{{@$post_id}}">
<div class="modal-body">
    <div class="radio radio-success inline m-t-0">
        <input id="sevenDays" name="stickup_toggler" type="radio" value="full">
        <label for="sevenDays">Before 7 days</label>
        <br>
        <input id="oneDay" name="stickup_toggler" type="radio" value="default" checked="">
        <label for="oneDay">Before 1 day</label>
        <br>
        <input id="oneHour" name="stickup_toggler" type="radio" value="mini">
        <label for="oneHour">Before 1 Hour</label>
        <br>
        <input id="twentyMins" name="stickup_toggler" type="radio" value="mini">
        <label for="twentyMins">Before 20 min</label>
    </div>

    {{--<div class="form-group">
        <label class="radio-inline"><input type="radio" name="reminder_before"
                                           value="1" {{(@$cstm_notification->reminder_before==1 || !$cstm_notification)?'checked':''}}>Before
            7 days</label>
        <label class="radio-inline"><input type="radio" name="reminder_before"
                                           value="2" {{(@$cstm_notification->reminder_before==2)?'checked':''}}>Before 1
            day</label>
        <label class="radio-inline"><input type="radio" name="reminder_before"
                                           value="3" {{(@$cstm_notification->reminder_before==3)?'checked':''}}>Before 1
            hour</label>
        <label class="radio-inline"><input type="radio" name="reminder_before"
                                           value="4" {{(@$cstm_notification->reminder_before==4)?'checked':''}}>Before
            20 min</label>
    </div>--}}
</div>
