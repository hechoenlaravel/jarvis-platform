@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Editar Perfil"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-user"></i> Editar Perfil</h2>
    <p>Agregue toda la información solicitada para editar su perfil</p>
@endsection
@section('content')
    {!! Form::open(['route' => ['me.update'], 'method' => 'PUT']) !!}
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Información básica</h3>
                    {!! Field::text('name', $user->name,['label' => 'Nombre completo']) !!}
                    {!! Field::text('email', $user->email, ['label' => 'Email']) !!}
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