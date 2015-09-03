@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Permissions'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<div class="panel panel-primary">
		<div class="panel-heading">
			{{trans('LaravelAdmin::laravel-admin.createPermissionTitle')}} 
		</div>
		<div class="panel-body">
			<div class="row">
	            <div class="col-lg-10 col-md-10 col-xs-12 col-lg-offset-1 col-md-offset-1">
                	<div class="row">
                		<div class="col-lg-12">
                			@include('flash::message')
                		</div>
                	</div>
                	<div class="row">
                		{!! Form::open(['route' => 'LaravelAdminPermissionsCreatePost']) !!}
	                        <div class="col-md-6 slugable">
	                            <div class="form-group">
	                                {!! Form::label('display_name', trans('LaravelAdmin::laravel-admin.permissionName')) !!}
	                                {!! Form::text('display_name', null, ['class' => 'form-control slug-source']) !!}
	                                @if($errors->has('display_name'))
	                                    <span class="text-danger">{{$errors->first('display_name')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('name', trans('LaravelAdmin::laravel-admin.permissionslug')) !!}
	                                {!! Form::text('name', null, ['class' => 'form-control slug-target', 'readonly' => 'readonly']) !!}
	                                @if($errors->has('name'))
	                                    <span class="text-danger">{{$errors->first('name')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('description', trans('LaravelAdmin::laravel-admin.permissiondescription')) !!}
	                                {!! Form::textarea('description', null,['class' => 'form-control']) !!}
	                                @if($errors->has('description'))
	                                    <span class="text-danger">{{$errors->first('description')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::submit(trans('LaravelAdmin::laravel-admin.save'), ['class' => 'btn btn-primary']) !!}
	                            </div>
	                        </div>
                        {!! Form::close() !!}
                    </div>
	            </div>
	        </div>	
		</div>
	</div>
</div>
@endsection