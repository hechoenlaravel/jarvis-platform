@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Permissions'}}
@endsection
@section('content')

<div class="container-fluid admin">
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{trans('LaravelAdmin::laravel-admin.permissionsListTitle')}}
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-9">
                    @include('flash::message')
                </div>
                <div class="col-lg-3">
                    <a href="{{route('LaravelAdminPermissionsCreate')}}" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> {{trans('LaravelAdmin::laravel-admin.createPermissionTitle')}}</a>
                </div>
            </div>
            <hr />
            {!! $table !!}
        </div>
    </div>
</div>

@endsection
