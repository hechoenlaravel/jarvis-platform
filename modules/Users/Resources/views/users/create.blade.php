@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Crear Usuario"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-user"></i> Crear usuario</h2>
    <p>Agregue toda la información solicitada para crear el usuario</p>
@endsection
@section('content')
    {!! Form::open(['route' => 'users.store']) !!}
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Información básica</h3>
                    {!! Field::text('name', ['label' => 'Nombre completo']) !!}
                    {!! Field::text('email', ['label' => 'Email']) !!}
                    {!! Field::select('roles[]', $roles, null, ['label' => 'Roles', 'class' => 'select2', 'multiple' => 'multiple']) !!}
                    {!! Field::password('password', ['label' => 'Contraseña']) !!}
                    {!! Field::password('password_confirmation', ['label' => 'Confirmar Contraseña']) !!}
                    <h3>Campos del perfil</h3>
                    {!! $profileFields !!}
                </div>
                <div class="col-lg-6">

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