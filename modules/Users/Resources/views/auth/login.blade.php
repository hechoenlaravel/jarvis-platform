@extends('layouts.main')
@section('pageTitle')
    Ingreso
@endsection
@section('content')
    <div class="container">
        <div class="login-box">
            <div class="login-logo">

            </div>
            <div class="login-box-body">
                {!! Alert::render() !!}
                {!! Form::open(['route' => 'login-post']) !!}
                {!! Field::email('email', ['label' => 'Usuario', 'placeholder' => 'admin@admin.com']) !!}
                {!! Field::password('password', ['label' => 'Contraseña', 'placeholder' => 'admin']) !!}
                {!! Form::submit('Ingresar', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
