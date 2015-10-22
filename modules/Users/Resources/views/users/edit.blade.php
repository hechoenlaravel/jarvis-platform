@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Editar Usuario"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-user"></i> Editar usuario</h2>
    <p>Agregue toda la información solicitada para crear el usuario</p>
@endsection
@section('content')
    {!! Form::open(['route' => ['users.update', $user->uuid]]) !!}
    {!! method_field('PUT') !!}
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Información básica</h3>
                    {!! Field::text('name', $user->name,['label' => 'Nombre completo']) !!}
                    {!! Field::text('email', $user->email, ['label' => 'Email']) !!}
                    {!! Field::select('roles[]', $roles, $user->roles->pluck('id')->toArray(), ['label' => 'Roles', 'class' => 'select2', 'multiple' => 'multiple']) !!}
                    @if(Auth::user()->can('user-activate'))
                        {!! Field::select('active', ['0' => 'No', '1' => 'Si'], $user->active , ['label' => 'Activo', 'class' => 'select2']) !!}
                    @endif
                    <h3>Campos del perfil</h3>
                    {!! $profileFields !!}
                </div>
                <div class="col-lg-6">
                    <h3>Foto de perfil</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <img src="{{$user->getAvatarImageUrl()}}" id="profileAvatar" class="img-circle profile-image" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="container-upload">
                                <button type="button" class="btn btn-primary" id="pickfiles" data-url="{{url('users/'.$user->id.'/avatar')}}" data-token="{{csrf_token()}}" data-loading-text="Subiendo imagen">Cambiar imagen de perfil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit('Actualizar usuario', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('scripts')
    <script src="{{asset('modules/users/js/update-profile.js')}}"></script>
@endsection