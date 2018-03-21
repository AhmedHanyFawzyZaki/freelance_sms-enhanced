@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><b>History</b> Of Target Number: {{$model->target_number}}</h4></div>

                <div class="panel-body">
                    <!--<div class="col-lg-12 control-menu">
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#"></a>
                            </div>
                            <ul id="yw2" class="nav navbar-nav pull-right" role="menu">
                                <li>
                                    <a href="{{ route('sms-marketing.index') }}">
                                        <span class="glyphicon glyphicon glyphicon-list"></span>
                                        Numbers List
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sms-marketing.create') }}">
                                        <span class="glyphicon glyphicon glyphicon-plus-sign"></span>
                                        Create number
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sms-marketing.edit', $model->id) }}">
                                        <span class="glyphicon glyphicon glyphicon-edit"></span>
                                        Edit number
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('sms-marketing.destroy', $model->id) }}" method="POST" style="display: inline;" onsubmit="if (confirm('Are you sure you want to delete this item?')) {
                                                return true
                                            } else {
                                                return false
                                            }
                                            ;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="show-delete-btn" type="submit"><i class="glyphicon glyphicon-trash"></i> Delete number</button>
                                    </form>
                                </li>
                            </ul>
                        </nav>
                    </div>-->

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
