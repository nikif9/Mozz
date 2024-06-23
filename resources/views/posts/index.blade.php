@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <h1 class="mb-4">Blog Posts</h1>
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
                        <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                        @if($post->images->count())
                            <img src="{{ asset('storage/' . $post->images->first()->path) }}" alt="Post Image" class="img-fluid">
                        @endif
                        <p><strong>Categories:</strong>
                            @foreach($post->categories as $category)
                                <span class="badge badge-secondary">{{ $category->name }}</span>
                            @endforeach
                        </p>
                        <p><strong>Visibility:</strong> {{ $post->is_published ? 'Published' : 'Draft' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
@endsection
