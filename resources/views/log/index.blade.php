@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="pull-right">
                        @if($seen)
                        <a href="{{route('sms-log.index')}}" class="btn btn-default">Show Un-exported Logs</a>
                        @else
                        <a href="{{route('sms-log.indexSeen')}}" class="btn btn-default">Show Exported Logs</a>
                        @endif
                        <a href="{{route('sms-log.export')}}?type={{$seen}}" class="btn btn-danger">Export CSV</a>
                    </div>
                    <div style="clear:both;">
                        <br><br>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="">SMS Ph# Received From</th>
                                <th>SMS Message Received</th>
                                <th class="">Twilio # Sent to</th>
                                <th class="button-column">Twilio Message Reply Sent</th>
                                <th class="">Creation Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($model) > 0)
                            @foreach($model as $i=>$m)
                            <tr>
                                <td>{{$m->sent_from}}</td>
                                <td>{{$m->message}}</td>
                                <td>{{$m->sent_to}}</td>
                                <td>{{$m->reply}}</td>
                                <td>{{$m->created_at}}</td>
                                <!--<td class="button-column">
                                    <a class="btn btn-xs btn-primary" href="{{ route('sms-log.edit', $m->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('sms-log.destroy', $m->id) }}" method="POST" style="display: inline;" onsubmit="if (confirm('Are you sure you want to delete this item?')) {
                                                return true
                                            } else {
                                                return false
                                            }
                                            ;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>-->
                            </tr>
                            @endforeach
                            @else
                            <tr><td colspan="5"><span>Nothing Found</span></td></tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $model->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
