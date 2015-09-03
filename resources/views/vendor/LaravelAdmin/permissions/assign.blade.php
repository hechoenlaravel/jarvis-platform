@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Permissions'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<div class="panel panel-primary">
		<div class="panel-heading">
			{{trans('LaravelAdmin::laravel-admin.managePermissions'). ' - '}}
			@if($type === 'roles')
				{{$model->display_name}}
			@else 
				{{$model->name}}
			@endif
		</div>
		<div class="panel-body">
			<div class="row">
	            <div class="col-lg-12 col-md-12 col-xs-12">
                	<div class="row">
                		<div class="col-lg-10">
		        			@include('flash::message')
		        		</div>
		        		<div class="col-lg-2">
		        			<button class="btn btn-block btn-primary" data-url="{{route('LaravelAdminAssignPermission')}}" data-model="{{$model->id}}" data-type="{{$type}}" data-action="AssignPermission" data-loading-text="{{trans('LaravelAdmin::laravel-admin.loadingText')}}"><i class="fa fa-plus"></i> {{trans('LaravelAdmin::laravel-admin.AssignPermission')}}</button>
		        		</div>
                	</div>
                	<hr >
                	<table class="table table-condensed table-hover dataTable">
                		<thead>
                			<tr>
                				<td>{{trans('LaravelAdmin::laravel-admin.permissionName')}}</td>
                				<td>{{trans('LaravelAdmin::laravel-admin.permissionslug')}}</td>
                				<td>{{trans('LaravelAdmin::laravel-admin.permissiondescription')}}</td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
                			@foreach($permissions as $permission)
							<tr>
								<td>{{ $permission->display_name }}</td>
								<td>{{ $permission->name }}</td>
								<td>{{ $permission->description }}</td>
								<td>
									<a href="{{url('backend/roles/'.$model->id.'/permissions/'.$permission->id.'/delete')}}" class="btn btn-danger btn-sm confirm"><i class="fa fa-times"></i> {{trans('LaravelAdmin::laravel-admin.removePermission')}}</a>
								</td>
							</tr>
							@endforeach
                		</tbody>
                	</table>
	            </div>
	        </div>
		</div>
	</div>
</div>
<div class="modal fade" id="permissionsAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">{{trans('LaravelAdmin::laravel-admin.AssignPermission')}}</h4>
			</div>
			{!! Form::open(['id' => 'AssignPermissionsForm']) !!}
			<div class="modal-body">
				{{trans('LaravelAdmin::laravel-admin.AssignPermissionModalText')}}
				<hr />
				<div class="form-group">
					{!! Form::select('perms[]', [], null, ['id' => 'permissionsSelect', 'class' => 'form-control', 'multiple' => 'multiple']) !!}
					<input type="hidden" name="type" id="Modeltype" value="" />
					<input type="hidden" name="model" id="Modelid" value="" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('LaravelAdmin::laravel-admin.cancel')}}</button>
				<button type="submit" class="btn btn-primary">{{trans('LaravelAdmin::laravel-admin.assign')}}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
