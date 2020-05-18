@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>    
                <div class="card-body">
                    <!-- <a href="/blogs/create" class="btn btn-primary">Create a Blog Post</a> -->
                    <h4>Your Blog Posts</h4>
                    @if(count($blogs) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        @foreach($blogs as $blog)
                        <tbody>
                            <tr>
                                <td colspan="">{{$blog->title}}
                                <td colspan="">{{$blog->created_at}}
                                <td colspan="">{{$blog->status}}
                                <td colspan="" style="display: flex;">
                                    <a href="/blogs/{{$blog->id}}/edit" class="btn btn-primary mr-2">Edit</a>
                                    <form method="post" action="{{ route('blogs.destroy', $blog->id)}}" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @else
                        <p>You have no blog posts.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
