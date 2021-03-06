<form action="{{$model->exists ? route('sms-marketing.update', $model->id) : route('sms-marketing.store')}}" class="form-horizontal" method="post">
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
                <label for="target_number" class="col-md-3 control-label">Target Number <span class="required text-danger">*</span></label>

                <div class="col-md-9">
                    <input id="target_number" type="input" class="form-control" name="target_number" value="{{ old('target_number') ? old('target_number') : $model->target_number }}">

                    @if ($errors->has('target_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('target_number') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

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
        </div>

        <div class="panel-footer col-md-12">

            <div class="text-right col-md-6">
                <input type="submit" value="Save">
            </div>
        </div>
    </div>
</form>
