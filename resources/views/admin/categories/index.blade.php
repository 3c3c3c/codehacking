@extends('layouts.admin');

@section('content')

	<h1>Categories</h1>
	<div class=" col-sm-4 ">
		{!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
			<div class="form-group">
				{!! Form::label('name','Name:-') !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">

			</div>
			<div class="form-group">
					{!! Form::submit('Add Category', ['class'=>'btn btn-primary']) !!}
			</div>
		{!! Form::close() !!}
	</div>
	<div class=" col-sm-8 " >
		@if($categories)
			<table class="table">
				<thead>
					<th>Id</th>
					<th>Name</th>
					<th>Created at</th>
				</thead>
				<tbody>
					@foreach($categories as $category)
						<tr>
							<td>{{ $category->id }}</td>
							<td>{{ $category->name }}</td>
							<td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'No create date added' }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif

	</div>


@endsection