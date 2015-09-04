@extends('LaravelAdmin::layouts.main')
@section('pageTitle')
    Install
@endsection
@section('content')
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="https://github.com/hechoenlaravel/jarvis-platform" target="_blank"><b>Jarvis</b>PLATFORM</a>
        </div>
        <p>{!! Lang::get('installer::install.title') !!}</p>
        @if($errors->count() > 0)
            <div class="alert alert-danger">
                <p>{!! Lang::get('installer::install.errors') !!}</p>
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(['url' => route('installerPost')]) !!}
        <div class="lockscreen-item">
            <div class="input-group">
                {!! Form::text('db_host', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => Lang::get('installer::install.db_host')]) !!}
                <div class="input-group-addon">
                    <i class="fa fa-server text-muted"></i>
                </div>
            </div>
            <div class="input-group">
                {!! Form::text('db_name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => Lang::get('installer::install.db_name')]) !!}
                <div class="input-group-addon">
                    <i class="fa fa-database text-muted"></i>
                </div>
            </div>
            <div class="input-group">
                {!! Form::text('db_user', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => Lang::get('installer::install.db_user')]) !!}
                <div class="input-group-addon">
                    <i class="fa fa-user text-muted"></i>
                </div>
            </div>
            <div class="input-group">
                {!! Form::password('db_pass', ['class' => 'form-control', 'required' => 'required', 'placeholder' => Lang::get('installer::install.db_pass')]) !!}
                <div class="input-group-addon">
                    <i class="fa fa-lock text-muted"></i>
                </div>
            </div>
        </div>
        <div class="lockscreen-item">
            <button class="btn btn-block btn-primary">
                {!! Lang::get('installer::install.submit') !!}
            </button>
        </div>
        {!! Form::close() !!}
    </div>
@stop