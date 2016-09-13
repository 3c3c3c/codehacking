@extends('layouts.admin')

@section('content')
    @if(Session::has('deleted_photo'))
        <p class="bg-danger"> {{Session('deleted_photo')}} </p>
    @endif

	<h1>Media</h1>

	@if($photos)
		<table class=" table" >
			<thead>
				<th>Id</th>
				<th>Name</th>
				<th>Created</th>
			</thead>
			<tbody>
				@foreach($photos as $photo)
					<tr>
						<td>{{ $photo->id }}</td>
						<td><img height="50" src="{{ $photo->file }}" alt="No Image available"></td>
						<td>{{ $photo->created_at ? $photo->created_at->diffForHumans() : 'No date entered!' }}</td>
						<td>
							{!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}
								<div class="form-group" >
								{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
								</div>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

@endsection