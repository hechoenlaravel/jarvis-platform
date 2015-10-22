@extends('layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Editar Rol"}}
@endsection
@section('styles')

@endsection
@section('content-header')
    <h2><i class="fa fa-users"></i> Editar Rol</h2>
    <p>Piense en un rol como un grupo de usuarios con capacidades esfecificas para realizar acciones en el sistema.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                {!! Form::open(['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('display_name', $role->display_name, ['label' => 'Nombre del rol']) !!}
                            {!! Field::text('description', $role->description, ['label' => 'Descripción del rol']) !!}
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    {!! Form::submit('Actualizar rol', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection