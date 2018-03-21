@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="pull-right">
                        <a href="{{route('sms-marketing.create')}}" class="btn btn-default">Create Target Number</a>
                    </div>
                    <div class="pull-left">
                        <a href="{{route('upload-excel')}}" title="Upload csv to send mass sms" class="btn btn-danger">Upload CSV</a>
                    </div>
                    <div class="clear"><br><br></div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="">Number</th>
                                <th class="button-column"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($model) > 0)
                            @foreach($model as $i=>$m)
                            <tr>
                                <th scope="row">{{$i+1}}</th>
                                <td>{{$m->target_number}}</td>
                                <td class="button-column">
                                    <a class="btn btn-xs btn-success" href="{{ route('sms-marketing.show', $m->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View History</a>
                                    <a class="btn btn-xs btn-primary" href="{{ route('sms-marketing.edit', $m->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('sms-marketing.destroy', $m->id) }}" method="POST" style="display: inline;" onsubmit="if (confirm('Are you sure you want to delete this item?')) {
                                          return true
                                      } else {
                                          return false
                                      }
                                      ;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr><td colspan="3"><span>Nothing Found</span></td></tr>
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
