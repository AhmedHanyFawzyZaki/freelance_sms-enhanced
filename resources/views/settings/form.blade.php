<form action="{{$model->exists ? route('settings.update', $model->id) : route('settings.store')}}" class="form-horizontal" method="post">
<div class="panel clear">
    <div class="panel-heading">
        <p class="help-block">Fields with <span class="required text-danger">*</span> are required.</p>
    </div>
    <div class="panel-body">
        @if($model->exists)
        <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-3 control-label">Name <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <input id="name" type="input" class="form-control" name="name" value="{{ old('name') ? old('name') : $model->name }}">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-3 control-label">Email <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ? old('email') : $model->email }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('default_message') ? ' has-error' : '' }}">
            <label for="default_message" class="col-md-3 control-label">Message <span class="required text-danger">*</span></label>

            <div class="col-md-9">
                <textarea id="default_message" class="form-control" name="default_message">{{ old('default_message') ? trim(old('default_message')) : trim($model->default_message) }}</textarea>

                @if ($errors->has('default_message'))
                    <span class="help-block">
                        <strong>{{ $errors->first('default_message') }}</strong>
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
