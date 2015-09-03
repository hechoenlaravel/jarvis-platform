@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Roles'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<div class="panel panel-primary">
		<div class="panel-heading">
			{{trans('LaravelAdmin::laravel-admin.editRoleTitle').' '.$role->name}} 
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
                		{!! Form::model($role, []) !!}
	                        <div class="col-md-6 slugable">
	                            <div class="form-group">
	                                {!! Form::label('display_name', trans('LaravelAdmin::laravel-admin.roleName')) !!}
	                                {!! Form::text('display_name', null, ['class' => 'form-control slug-source']) !!}
	                                @if($errors->has('display_name'))
	                                    <span class="text-danger">{{$errors->first('display_name')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('name', trans('LaravelAdmin::laravel-admin.roleSlug')) !!}
	                                {!! Form::text('name', null, ['class' => 'form-control slug-target', 'readonly' => 'readonly']) !!}
	                                @if($errors->has('display_name'))
	                                    <span class="text-danger">{{$errors->first('display_name')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('description', trans('LaravelAdmin::laravel-admin.roleDescription')) !!}
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