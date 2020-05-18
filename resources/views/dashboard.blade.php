@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>    
                <div class="card-body">
                    <a href="/blogs/create" class="btn btn-primary">Create a Blog Post</a>
                    <h3>Your Blog Posts</h3>
                    @if(count($blogs) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($blogs as $blog)
                            <tr>
                                <th>{{$blog->title}}</th>
                                <td>
                                    <a href="/blogs/{{$blog->id}}/edit" class="btn btn-primary">Edit</a>
                                    <form method="post" action="{{ route('blogs.destroy', $blog->id)}}" class="float-right">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
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
