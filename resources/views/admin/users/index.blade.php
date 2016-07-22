@extends('layouts.admin')

@section('content')

	<h1>Users</h1>
	  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Crated</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
    	@if($users)
    		@foreach($users as $user)
				      <tr>
				        <td>{{$user->id}}</td>
                        <!-- not use of terniary expression if photo available then give it if not state so
                             without this statement gives error of property for non object as some useres in the database
                             will not have photos (without accessor looks like this but is live with accessor see photo class)
                        <td>
                                <img height="50" src="/images/{{$user->photo ? $user->photo->file : 'no photo available!'}}" alt="No photo available">
                        </td>
                        -->
                        <td>
                            <img height="50" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="No photo available!">
                        </td>
				        <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
				        <td>{{$user->email}}</td>
				        <td>{{$user->role->name}}</td>
				        <!-- note use of terniary expression to evaluate the active /non active -->
				        <td>{{$user->is_active == 1 ? 'Active' : 'Non Active'}}</td> 
				        <td>{{$user->created_at->diffForHumans()}}</td>
				        <td>{{$user->updated_at->diffForHumans()}}</td>
				      </tr>
			@endforeach
		@endif
    </tbody>
  </table>

@endsection