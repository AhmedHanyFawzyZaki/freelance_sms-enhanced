@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form action="{{route('upload-excel-post')}}" class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="panel clear">
                            <div class="panel-body">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="col-md-6 form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                    <label for="file" class="col-md-3 control-label">File <span class="required text-danger">*</span></label>

                                    <div class="col-md-9">
                                        <input id="file" type="file" class="form-control" name="file">

                                        @if ($errors->has('file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer col-md-12 text-right">
                                <!--<input type="submit" value="Upload" name="upload" class="btn btn-success">-->
                                <input type="submit" value="Import & Send" name="uploadsend" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
