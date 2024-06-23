@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <h1 class="mb-4">Posts</h1>
    @if(Auth::user()->roles->pluck('name')->contains('administrator'))
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Visibility</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->is_published ? 'Published' : 'Draft' }}</td>
                    <td>
                        <a href="{{ route(Auth::user()->roles->pluck('name')->contains('administrator') ? 'admin.posts.edit' : 'moderator.posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                        @if(Auth::user()->roles->pluck('name')->contains('administrator'))
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection
