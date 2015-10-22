@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Permisos de grupo o rol"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-lock"></i> Permisos del grupo o rol <small>{{$role->display_name}}</small></h2>
    <p>Utilice esta sección para configurar los permisos del rol o grupo.</p>
@endsection
@section('content')
    <div class="box">
        {!! Form::open(['route' => ['roles.permissions.update', $role->id], 'method' => 'PUT']) !!}
        <div class="box-body">
            @foreach($modules as $module)
                @if($permissions->where('module', $module->alias)->count() > 0)
                    <h4>Módulo: {{$module->display_name}}</h4>
                    <div class="row">
                        @foreach($permissions->where('module', $module->alias) as $permission)
                            <div class="col-md-4">
                                {!! Field::checkbox('permissions[]', $permission->id, $role->hasPermission($permission->name), ['label' => $permission->display_name]) !!}
                            </div>
                        @endforeach
                    </div>
                    <hr />
                @endif
            @endforeach
        </div>
        <div class="box-footer">
            {!! Form::submit('Actualizar permisos', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')

@endsection