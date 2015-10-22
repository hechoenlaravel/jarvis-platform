@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Roles"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-users"></i> Roles</h2>
    <p>Admintración de roles del sistema, piense en roles como grupos de usuarios con capacidades esfecificas para realizar acciones en el sistema.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Roles
                    </h3>
                    <div class="box-tools pull-right">
                        @if(Auth::user()->can('create-role'))
                            <a href="{{route('roles.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Crear rol</a>
                        @endif
                    </div>
                </div>
                <div class="box-body">
                    {!! $html->table() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! $html->scripts() !!}
@endsection