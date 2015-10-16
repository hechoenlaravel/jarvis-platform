@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Usuarios"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-user"></i> Crear usuario</h2>
    <p>Agregue toda la información solicitada para crear el usuario</p>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <h3>Información básica</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    {!! Field::text('name', ['label' => 'Nombre completo']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Field::text('email', ['label' => 'Email']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    {!! Field::password('password', ['label' => 'Contraseña']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Field::password('password_confirmation', ['label' => 'Confirmar Contraseña']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Campos del perfil</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {!! $profileFields !!}
                </div>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit('Crear usuario', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endsection
@section('scripts')

@endsection