@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-sm-2">
		<a href="{{ url('/blogs') }}" class="btn btn-primary"> Go Back </a>
	</div>
	<div class="col-sm-8"></div>
	@if(!Auth::guest())
		@if(Auth::user()->id == $blog->user_id)
		<div class="col-sm-2" style="display: flex;text-align: right;">
			<a href="/blogs/{{$blog->id}}/edit" class="btn btn-primary">Edit</a>

			<form method="post" action="{{ route('blogs.destroy', $blog->id)}}" class="ml-2">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		</div>
		@endif
	@endif
</div>

<!-- Basic Card Example -->
<div class="card shadow my-4">
	<div class="card-header py-3">
		<h3 class="font-weight-bold text-primary">{{$blog->title}}</h3>
		<small>Created on {{$blog->created_at}} by {{$blog->user->name}}</small>
	</div>	

	<div class="p-4">
		{!!$blog->content!!}
	</div>


</div>
@endsection