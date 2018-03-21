<form action="{{route('send-sms-post')}}" class="form-horizontal" method="post">
<div class="panel clear">
    <div class="panel-heading">
        <p class="help-block">Fields with <span class="required text-danger">*</span> are required.</p>
    </div>
    <div class="panel-body">
        @if($model->exists)
        <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-md-6 form-group{{ $errors->has('sent_to') ? ' has-error' : '' }}">
            <label for="sent_to" class="col-md-3 control-label">Send To Number <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <input id="sent_to" type="input" class="form-control" name="sent_to" value="{{ old('sent_to') ? old('sent_to') : $model->sent_to }}">

                @if ($errors->has('sent_to'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sent_to') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('message') ? ' has-error' : '' }}">
            <label for="message" class="col-md-3 control-label">SMS Message <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <textarea id="message" class="form-control" name="message">{{ old('message') ? trim(old('message')) : trim($model->message) }}</textarea>

                @if ($errors->has('message'))
                    <span class="help-block">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="panel-footer col-md-12">

        <div class="text-right col-md-6">
            <input type="submit" value="Send">
        </div>
    </div>
</div>
</form>
