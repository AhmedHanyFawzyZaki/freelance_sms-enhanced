@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><b>History</b> Of Target Number: {{$model->target_number}}</h4></div>

                <div class="panel-body">
                    <div class="clear"></div>
                    <div class="panel panel-danger">
                        <div class="panel-heading"><h4><b>Outbound SMS</b></h4></div>

                        <div class="panel-body">
                            <div class="pull-right">
                                <a href="{{route('send-sms')}}?number={{$model->target_number}}" class="btn btn-default">Send SMS</a>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Message</th>
                                        <th>Date of creation</th>
                                        <th>Errors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($outbounds) > 0)
                                    @foreach($outbounds as $ob)
                                    <tr>
                                        <td>{{$ob->sent_from}}</td>
                                        <td>{{$ob->sent_to}}</td>
                                        <td>{{$ob->message}}</td>
                                        <td>{{$ob->created_at}}</td>
                                        <td>{{substr($ob->error_msg, 0 ,143)}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="4"><span>No Outbound Messages Found</span></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="panel panel-success">
                        <div class="panel-heading"><h4><b>Inbound SMS</b></h4></div>

                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Message</th>
                                        <th>Date of creation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($inbounds) > 0)
                                    @foreach($inbounds as $i=>$ib)
                                    <tr>
                                        <td>{{$ib->sent_from}}</td>
                                        <td>{{$ib->sent_to}}</td>
                                        <td>{{$ib->message}}</td>
                                        <td>{{$ob->created_at}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="4"><span>No Inbound Messages Found</span></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
