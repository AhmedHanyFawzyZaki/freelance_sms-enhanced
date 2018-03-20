@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="col-lg-12 control-menu">
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#"></a>
                            </div>
                            <ul id="yw2" class="nav navbar-nav pull-right" role="menu">
                                <li>
                                    <a href="{{ route('home.index') }}">
                                        <span class="glyphicon glyphicon glyphicon-list"></span>
                                        Numbers List
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('home.create') }}">
                                        <span class="glyphicon glyphicon glyphicon-plus-sign"></span>
                                        Create number
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('home.destroy', $model->id) }}" method="POST" style="display: inline;" onsubmit="if (confirm('Are you sure you want to delete this item?')) {
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
                    </div>

                    @include('home.form')
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
