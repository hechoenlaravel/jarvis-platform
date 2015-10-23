@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "404"}}
@endsection
@section('styles')

@endsection
@section('content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! No encontramos lo que buscas.</h3>
            <p>
                Posiblemente la seccion a la que estás accediendo no existe o esta desactivada.
            </p>
        </div>
    </div>

@endsection