@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Editar campo de perfil"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-user"></i> Editar campo de perfil</h2>
    <p>Edite la información del campo</p>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            {!! $form !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('modules/users/js/users-config.js')}}"></script>
    <script>
        window.isEdit = true;
    </script>
@endsection