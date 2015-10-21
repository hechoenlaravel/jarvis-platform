@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Create Usuario"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-user"></i> Editar usuario</h2>
    <p>Agregue toda la información solicitada para crear el usuario</p>
@endsection
@section('content')
    {!! Form::open(['route' => ['users.update', $user->uuid], 'method' => 'PUT']) !!}
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Información básica</h3>
                    {!! Field::text('name', $user->name,['label' => 'Nombre completo']) !!}
                    {!! Field::text('email', $user->email, ['label' => 'Email']) !!}
                    {!! Field::select('roles[]', $roles, $user->roles->pluck('id')->toArray(), ['label' => 'Roles', 'class' => 'select2', 'multiple' => 'multiple']) !!}
                    <h3>Campos del perfil</h3>
                    {!! $profileFields !!}
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit('Actualizar usuario', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endsection
@section('scripts')

@endsection