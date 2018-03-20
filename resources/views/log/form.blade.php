<form action="{{$model->exists ? route('sms-log.update', $model->id) : route('sms-log.store')}}" class="form-horizontal" method="post">
<div class="panel clear">
    <div class="panel-heading">
        <p class="help-block">Fields with <span class="required text-danger">*</span> are required.</p>
    </div>
    <div class="panel-body">
        @if($model->exists)
        <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-md-6 form-group{{ $errors->has('sent_from') ? ' has-error' : '' }}">
            <label for="sent_from" class="col-md-3 control-label">SMS Ph# Received From <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <input id="number" type="input" class="form-control" name="sent_from" value="{{ old('sent_from') ? old('sent_from') : $model->sent_from }}">

                @if ($errors->has('sent_from'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sent_from') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('message') ? ' has-error' : '' }}">
            <label for="message" class="col-md-3 control-label">SMS Message Received <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <textarea id="message" class="form-control" name="message">{{ old('message') ? trim(old('message')) : trim($model->message) }}</textarea>

                @if ($errors->has('message'))
                    <span class="help-block">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('sent_to') ? ' has-error' : '' }}">
            <label for="sent_to" class="col-md-3 control-label">Twilio # Sent to <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <input id="sent_to" type="input" class="form-control" name="sent_to" value="{{ old('sent_to') ? old('sent_to') : $model->sent_to }}">

                @if ($errors->has('sent_to'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sent_to') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('reply') ? ' has-error' : '' }}">
            <label for="reply" class="col-md-3 control-label">Twilio Message Reply Sent <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <textarea id="reply" class="form-control" name="reply">{{ old('reply') ? trim(old('reply')) : trim($model->reply) }}</textarea>

                @if ($errors->has('reply'))
                    <span class="help-block">
                        <strong>{{ $errors->first('reply') }}</strong>
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
