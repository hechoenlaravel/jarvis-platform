@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Users'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<div class="panel panel-primary">
		<div class="panel-heading">
			{{trans('LaravelAdmin::laravel-admin.createUserTitle')}} 
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
                		{!! Form::open(['route' => 'LaravelAdminUsersCreatePost']) !!}
	                        <div class="col-md-6">
	                            <div class="form-group">
	                                {!! Form::label('name', trans('LaravelAdmin::laravel-admin.userName')) !!}
	                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
	                                @if($errors->has('name'))
	                                    <span class="text-danger">{{$errors->first('name')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('email', trans('LaravelAdmin::laravel-admin.userEmail')) !!}
	                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
	                                @if($errors->has('email'))
	                                    <span class="text-danger">{{$errors->first('email')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('password', trans('LaravelAdmin::laravel-admin.password')) !!}
	                                {!! Form::password('password', ['class' => 'form-control']) !!}
	                                @if($errors->has('password'))
	                                    <span class="text-danger">{{$errors->first('password')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('password_confirmation', trans('LaravelAdmin::laravel-admin.passwordConfirmation')) !!}
	                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
	                                @if($errors->has('password_confirmation'))
	                                    <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
	                                @endif
	                            </div>
	                            <div class="form-group">
	                                {!! Form::submit(trans('LaravelAdmin::laravel-admin.save'), ['class' => 'btn btn-primary']) !!}
	                            </div>
	                        </div>
	                        <div class="col-md-6">
	                            <div class="form-group">
	                                {!! Form::label('name', trans('LaravelAdmin::laravel-admin.userRoles')) !!}
	                                {!! Form::select('roles[]', $roles, null, ['class' => 'form-control selectBootstrap', 'multiple' => 'multiple']) !!}
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