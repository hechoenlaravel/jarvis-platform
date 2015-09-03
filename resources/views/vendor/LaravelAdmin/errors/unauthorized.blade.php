@extends('LaravelAdmin::layouts.main')
@section('pageTitle')
{{trans('LaravelAdmin::laravel-admin.unauthorizedTitle')}}
@endsection
@section('content')
<div class="container">
	<div class="col-md-6 col-xs-12 col-md-offset-3 login-box">
		<div class="alert alert-danger">
			{{trans('LaravelAdmin::laravel-admin.unauthorizedText')}}
		</div>
	</div>
</div>
@endsection
