@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="col-xs-6 col-md-4 text-center">
                        <h1>
                            <a href="{{route('sms-log.index')}}" class="thumbnail">
                                <i class="fa fa-envelope"></i>
                                <p>SMS - Log</p>
                            </a>
                        </h1>
                    </div>
                    <div class="col-xs-6 col-md-4 text-center">
                        <h1>
                            <a href="#" class="thumbnail">
                                <i class="fa fa-money"></i>
                                <p>Test</p>
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
