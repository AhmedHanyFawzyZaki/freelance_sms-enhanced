<form action="{{$model->exists ? route('home.update', $model->id) : route('home.store')}}" class="form-horizontal" method="post">
<div class="panel clear">
    <div class="panel-heading">
        <p class="help-block">Fields with <span class="required text-danger">*</span> are required.</p>
    </div>
    <div class="panel-body">
        @if($model->exists)
        <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-md-6 form-group{{ $errors->has('number') ? ' has-error' : '' }}">
            <label for="number" class="col-md-3 control-label">Number <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <input id="number" type="input" class="form-control" name="number" value="{{ old('number') ? old('number') : $model->number }}">

                @if ($errors->has('number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('number') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
            <label for="msg" class="col-md-3 control-label">Message <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <textarea id="msg" class="form-control" name="msg">{{ old('msg') ? trim(old('msg')) : trim($model->msg) }}</textarea>

                @if ($errors->has('msg'))
                    <span class="help-block">
                        <strong>{{ $errors->first('msg') }}</strong>
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
