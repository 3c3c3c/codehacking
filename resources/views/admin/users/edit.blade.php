@extends('layouts.admin')

@section('content')
	<h1>Edit User</h1>

	<!-- includes a small partil view from the views includes folder (a reusable template code)-->
	<div class="row" >
		@include('includes.formInputValidation') 
	</div>

	<div class=" col-sm-3 " >
		<img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="No Image Available" 
		class="img-responsive img-rounded" >
		<!-- @include('includes.formInputValidation') -->
	</div>

	<div class=" col-sm-9 " >
		<!-- for edit need to do form model binding by passing in a user -->
		{!! Form::model( $user, array('method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true)  ) !!}

			<div class="form-group">
				{!! Form::label('name','Name: ') !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('email','Email: ') !!}
				{!! Form::email('email', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('role_id','Role:') !!}
				{!! Form::select('role_id', [''=>'choose options'] + $roles, 'subscriber', ['class'=>'form-control']) !!}
			</div>
			<!-- NB:- note setting default active status as null allows laravel to bring in the setting in the database -->
			<div class="form-group">
				{!! Form::label('is_active','Status: ') !!}
				{!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class'=>'form-control']) !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('password','Password: ') !!}
				{!! Form::password('password', ['class'=>'form-control']) !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('photo_id','User Image (optional): ') !!}
				{!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-3']) !!}
			</div>


		{!! Form::close() !!} 


		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}

			<div class="form-group" >
				{!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-3']) !!}
			</div>

		{!! Form::close() !!}

	</div>

@endsection