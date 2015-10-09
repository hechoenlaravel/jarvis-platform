@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Usuarios"}}
@endsection
@section('styles')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-center">Usuarios<br/> registrados</span>
                    <span class="info-box-number text-center">{{number_format($users)}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-search"></i></span>
                <div class="info-box-content">
                    Filtros de búsqueda
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Usuarios</h3>
                    <div class="box-tools pull-right">
                        @if(Auth::user()->can('user-create'))
                            <a href="{{route('users.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Crear usuario</a>
                        @endif
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th width="100"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>@{{user.id}}</td>
                                    <td>@{{user.name}}</td>
                                    <td>@{{user.email}}</td>
                                    <td>@{{user.roles.formatted}}</td>
                                    <td>
                                        @if(Auth::user()->can('user-edit'))
                                            <a href="@{{user.links.edit}}" data-toggle="tooltip" data-placement="top" title="Editar usuario" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></a>
                                        @endif
                                        @if(Auth::user()->can('user-delete'))
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar usuario"><i class="fa fa-times"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">

                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            @if(Auth::user()->can('user-create'))
                                <a href="{{route('users.create')}}"
                                   class="btn btn-primary btn-flat btn-block margin-20-top"><i class="fa fa-plus"></i>
                                    Crear Usuario</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection