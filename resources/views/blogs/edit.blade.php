
@extends('layouts.app')

@section('content')
	<!-- Basic Card Example -->
	<div class="card shadow my-4">
		<div class="card-header py-3">
			<h5 class="m-0 font-weight-bold text-primary">Edit Blog Post</h5>
		</div>
		<form method="post" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data" class="p-4">
		    @csrf            
			@method('PUT')    
		    <div class="form-group">
		        <label for="title">Title</label>
		        <input type="text" class="form-control" name="title" value="{{ $blog->title }}" placeholder="Title"/>
		    </div>		    		    
		    <div class="form-group">
		    	<label for="short_summary">Short Summary</label>
				<textarea class="form-control mb-4" name="short_summary" placeholder=""></textarea>
			</div>
		    <div class="form-group">
		        <label for="content">Content</label>
				<textarea class="form-control editor1" name="content"  cols="30" rows="10" placeholder="Content Text" style="display:'none'">
					{!! $blog->content !!}
				</textarea>
		    </div>
		    <div class="form-group">
		    	<label for="image_upload">Image Upload</label>
				<input type="file" name="image_upload" class="form-control">
		    </div>
		    <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
@endsection




