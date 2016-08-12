@extends('layouts.admin')

@section('content')

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
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

@endsection