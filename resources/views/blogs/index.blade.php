@extends('layouts.app')

@section('content')	
	<!-- <a href="/blogs/create" class="btn btn-primary">Create Blog Post</a> -->
	
	<!-- Basic Card Example -->
	<div class="card shadow my-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6>
		</div>
		@if(count($blogs) > 0)
			@foreach($blogs as $blog)
				<div class="card-body">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<img style="width: 100%;" src="/storage/image_uploads/{{$blog->image_upload}}">
						</div>					
						<div class="col-md-8 col-sm-8 p-2">
							<h3><a href="/blogs/{{$blog->id}}">{{$blog->title}}</a></h3>
							<p>{{$blog->short_summary}}</p>
							<p>{{$blog->user->name}}</p>
							<p>{{$blog->created_at}}</p> <!-- Format: June 06, 1996-->
						</div>
					</div>
				</div>
			@endforeach
			{{$blogs->links()}}
		@else
			<p>No blogs found</p>
		@endif
	</div>	
@endsection