@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "404"}}
@endsection
@section('styles')

@endsection
@section('content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! No tienes permisos para ver esta sección.</h3>
            <p>
                El recurso que estás tratando de acceder requiere un permiso que no ha sido asignado a tu perfil.
            </p>
        </div>
    </div>

@endsection