@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Usuarios"}}
@endsection
@section('styles')

@endsection
@section('content')
    <div ng-controller="UsersController" ng-init="searchUsers()">
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
                <div class="info-box info-search">
                    <span class="info-box-icon bg-blue"><i class="fa fa-search"></i></span>
                    <div class="info-box-content">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Field::text('name', null , ['ng-model' => 'form.name', 'label' => 'Nombre']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Field::text('email', null , ['ng-model' => 'form.email', 'label' => 'Email']) !!}
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-default btn-block btn-margin-top" data-loading-text="Buscando..." ng-click="searchUsers()" id="usersSearchButton"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info" id="resultsBox">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Usuarios
                            <small>Hemos encontrado @{{total}} registros</small>
                        </h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-default btn-sm" ng-click="reset()"><i class="fa fa-times"></i> Limpiar Filtros</button>
                            @if(Auth::user()->can('user-create'))
                                <a href="{{route('users.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Crear usuario</a>
                            @endif
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning" ng-show="NoResults">
                                    <p>No hay resultados, por favor seleccione otro criterio de búsqueda</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" ng-hide="NoResults">
                            <table class="table no-margin" ts-wrapper>
                                <thead>
                                <tr>
                                    <th ts-criteria="id">ID de usuario</th>
                                    <th ts-criteria="name|lowercase" ts-default>Nombre</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Estado</th>
                                    <th width="120"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="user in results" ts-repeat>
                                    <td>@{{user.id}}</td>
                                    <td>@{{user.name}}</td>
                                    <td>@{{user.email}}</td>
                                    <td>
                                        <span class="label label-primary" ng-repeat="role in user.roles.data">@{{role.display_name}}</span>
                                    </td>
                                    <td>@{{user.active.formatted}}</td>
                                    <td>
                                        @if(Auth::user()->can('user-edit'))
                                            <a href="@{{user.links.edit}}" data-toggle="tooltip" data-placement="top" title="Editar usuario" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></a>
                                        @endif
                                        @if(Auth::user()->can('user-delete'))
                                            <button type="button" class="btn btn-sm btn-danger" ng-click="deleteUser(user.id)" data-toggle="tooltip" data-placement="top" title="Eliminar usuario"><i class="fa fa-times"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-md-3">
                                <span ng-hide="NoResults">
                                    Página @{{ current_page }} de @{{ total_pages }}
                                </span>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" ng-click="loadPrevious()" ng-disabled="nextPage <= 2" class="btn btn-default">Anterior</button>
                                    <button type="button" ng-click="loadNext()" ng-disabled="hasMoreResults === false" class="btn btn-default">Siguiente</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('modules/users/js/userslist.js')}}"></script>
@endsection