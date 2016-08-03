@extends('layouts.admin')

@section('content')
    @if(Session::has('deleted_post'))
        <p class="bg-danger"> {{Session('deleted_post')}} </p>
    @endif

	<h1>Posts</h1>

	<table class="table">
		<thead>
			<th>Id</th>
			<th>Photo</th>
			<th>Owner</th>
			<th>Category</th>
			<th>Title</th>
			<th>Body</th>
			<th>Created</th>
			<th>Updated</th>
		</thead>
		<tbody>
			@if($posts)
				@foreach($posts as $post)
					<tr>
						<td>{{$post->id}}</td>
						<td><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/200x200' }}" 	alt=""></td>
						<td><a href="{{route('admin.posts.edit', $post->id)}}" >{{$post->user->name}}</a></td>
						<td>{{$post->category ? $post->category->name : 'No Category Assigned'}}</td>
						<td>{{$post->title}}</td>
						<td>{{str_limit($post->body, 20)}}</td>
						<td>{{$post->created_at->diffForHumans()}}</td>
						<td>{{$post->updated_at->diffForHumans()}}</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>

@endsection