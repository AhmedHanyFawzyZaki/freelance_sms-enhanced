<form action="{{$model->exists ? route('sms-schedule.update', $model->id) : route('sms-schedule.store')}}" class="form-horizontal" method="post">
    <div class="panel clear">
        <div class="panel-heading">
            <p class="help-block">Fields with <span class="required text-danger">*</span> are required.</p>
        </div>
        <div class="panel-body">
            @if($model->exists)
            <input type="hidden" name="_method" value="PUT">
            @endif
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="col-md-6 form-group{{ $errors->has('target_number') ? ' has-error' : '' }}">
                <label for="target_number" class="col-md-3 control-label">Number <span class="required text-danger">*</span></label>

                <div class="col-md-9">
                    <input id="target_number" type="input" class="form-control" name="target_number" value="{{ old('target_number') ? old('target_number') : $model->target_number }}">

                    @if ($errors->has('target_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('target_number') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('send_type') ? ' has-error' : '' }}">
                <label for="send_type" class="col-md-3 control-label">Send Type <span class="required text-danger">*</span></label>

                <div class="col-md-9">

                    <select name="send_type" id="send_ty" onchange="checkSendType()" class="form-control">
                        <option value="1" {{ old('send_type') == 1 || $model->send_type == 1 ? 'selected': '' }} >One Time Only</option>
                        <option value="2" {{ old('send_type') == 2 || $model->send_type == 2 ? 'selected': '' }} >Recurring</option>
                    </select>

                    @if ($errors->has('send_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('send_type') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('send_start_date') ? ' has-error' : '' }}">
                <label for="send_start_date" class="col-md-3 control-label">Start Sending Date <span class="required text-danger">*</span></label>

                <div class="col-md-9">
                    <input id="send_start_date" type="input" class="form-control" name="send_start_date" value="{{ old('send_start_date') ? old('send_start_date') : $model->send_start_date }}">

                    @if ($errors->has('send_start_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('send_start_date') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                <label for="message" class="col-md-3 control-label">Message <span class="required text-danger">*</span></label>

                <div class="col-md-9">
                    <textarea id="message" class="form-control" name="message">{{ old('message') ? trim(old('message')) : trim($model->message) }}</textarea>

                    @if ($errors->has('message'))
                    <span class="help-block">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="clear"></div>

            <div class="col-md-6 form-group{{ $errors->has('is_suspended') ? ' has-error' : '' }}">
                <label for="is_suspended" class="col-md-3 control-label"></label>

                <div class="col-md-9">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_suspended" value="1" {{ old('is_suspended') || $model->is_suspended ? 'checked': '' }} > Is Suspended?
                        </label>
                    </div>

                    @if ($errors->has('is_suspended'))
                    <span class="help-block">
                        <strong>{{ $errors->first('is_suspended') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            
            <div class="col-md-6 form-group{{ $errors->has('schedule_id') ? ' has-error' : '' }}" id="sch_div">
                <label for="schedule_id" class="col-md-3 control-label">Every <span class="required text-danger">*</span></label>

                <div class="col-md-9">

                    <select name="schedule_id" class="form-control">
                        <option value=""></option>
                        @foreach($sch_lkp as $sl)
                        <option value="{{$sl->id}}" {{ old('schedule_id') == $sl->id || $model->schedule_id == $sl->id ? 'selected': '' }} >{{ $sl->title }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('schedule_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('schedule_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="panel-footer col-md-12">

            <div class="text-right col-md-6">
                <input type="submit" value="Save">
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        checkSendType();
    });
    function checkSendType() {
        var send_type = $('#send_ty').val();
        if (send_type == 1) {
            $('#sch_div').hide();
        } else {
            $('#sch_div').show();
        }
    }
</script>
