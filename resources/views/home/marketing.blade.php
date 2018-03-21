@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">SMS - Marketing</div>

                <div class="panel-body">
                    <div class="col-xs-6 col-md-4 text-center">
                        <h2>
                            <a href="{{route('sms-log.index')}}" class="thumbnail">
                                <i class="fa fa-envelope"></i>
                                <p>SMS - Log</p>
                            </a>
                        </h2>
                    </div>
                    <div class="col-xs-6 col-md-4 text-center">
                        <h2>
                            <a href="{{route('home.marketing')}}" class="thumbnail">
                                <i class="fa fa-bar-chart"></i>
                                <p>SMS - Marketing</p>
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
