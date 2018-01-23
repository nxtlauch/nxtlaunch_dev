<input type="hidden" name="post_id" value="{{@$post_id}}">
<div class="modal-body">
    <div class="radio radio-success inline m-t-0">
        <input id="sevenDays" name="reminder_before" type="radio" value="1" {{(@$cstm_notification->reminder_before==1 || !$cstm_notification)?'checked':''}}>
        <label for="sevenDays">7 Days</label>
        <br>
        <input id="oneDay" name="reminder_before" type="radio" value="2" {{(@$cstm_notification->reminder_before==2)?'checked':''}}>
        <label for="oneDay">1 Day</label>
        <br>
        <input id="oneHour" name="reminder_before" type="radio" value="3" {{(@$cstm_notification->reminder_before==3)?'checked':''}}>
        <label for="oneHour">1 Hour</label>
        <br>
        <input id="twentyMins" name="reminder_before" type="radio" value="4" {{(@$cstm_notification->reminder_before==4)?'checked':''}}>
        <label for="twentyMins">@Launch Time</label>
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
