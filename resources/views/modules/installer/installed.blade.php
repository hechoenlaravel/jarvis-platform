@extends('LaravelAdmin::layouts.main')
@section('pageTitle')
    Install
@endsection
@section('content')
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="https://github.com/hechoenlaravel/jarvis-platform" target="_blank"><b>Jarvis</b>PLATFORM</a>
        </div>
        <div class="alert alert-danger">
            {!! Lang::get('installer::install.installed') !!}
        </div>
    </div>
@stop