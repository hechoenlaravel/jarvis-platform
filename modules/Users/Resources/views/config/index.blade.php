@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Configuración de usuarios"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-cog"></i> Configuración del módulo usuarios</h2>
    <p>Utilice las opciones de esta sección para configurar el modulo de usuarios.</p>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-wrench"></i> General</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Campos del perfil</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                    </div>
                    <div class="tab-pane" id="tab_2" ng-controller="UsersSettingsController" ng-init="getFields()">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-10">
                                <a href="{{route('users.config.create')}}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Agregar campo</a>
                            </div>
                        </div>
                        <table class="table table-condensed table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="field in fields">
                                    <td>
                                        <i class="fa fa-order"></i>
                                    </td>
                                    <td>@{{ field.name }}</td>
                                    <td>@{{ field.description }}</td>
                                    <td>@{{ field.fieldType.name }}</td>
                                    <td>
                                        @if(Auth::user()->can('user-profile-fields-edit'))
                                            <a href="@{{ field.links.edit }}" data-toggle="tooltip" data-placement="top" title="Editar campo" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{asset('modules/users/js/users-config.js')}}"></script>
@endsection