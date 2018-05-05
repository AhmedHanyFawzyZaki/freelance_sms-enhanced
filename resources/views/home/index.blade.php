@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="col-xs-6 col-md-4 text-center">
                        <h2>
                            <a href="{{route('sms-log.index')}}" class="thumbnail">
                                <i class="fa fa-envelope"></i>
                                <p>SMS - Log</p>
                            </a>
                        </h2>
                    </div>
                    <div class="col-xs-6 col-md-4 col-md-offset-4 text-center">
                        <h2>
                            <a href="{{route('sms-marketing.index')}}" class="thumbnail">
                                <i class="fa fa-bar-chart"></i>
                                <p>SMS - Marketing</p>
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-danger">
                <div class="panel-heading">Scheduled Messages</div>

                <div class="panel-body">
                    <div class="col-xs-6 col-md-4 col-md-offset-4 text-center">
                        <h2>
                            <a href="{{route('sms-schedule.index')}}" class="thumbnail">
                                <i class="fa fa-calendar"></i>
                                <p>SMS - Schedule</p>
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
