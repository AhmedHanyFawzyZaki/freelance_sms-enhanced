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
                                    <a href="{{ route('sms-log.index') }}">
                                        <span class="glyphicon glyphicon glyphicon-list"></span>
                                        SMS Log List
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sms-log.create') }}">
                                        <span class="glyphicon glyphicon glyphicon-plus-sign"></span>
                                        Create SMS Log
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    @include('log.form')
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
