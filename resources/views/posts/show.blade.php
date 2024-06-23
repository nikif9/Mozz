@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1 class="mb-4">{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    @if($post->images->count())
        <img src="{{ asset('storage/' . $post->images->first()->path) }}" alt="Post Image" class="img-fluid mb-3">
    @endif
    <p><strong>Categories:</strong>
        @foreach($post->categories as $category)
            <span class="badge badge-secondary">{{ $category->name }}</span>
        @endforeach
    </p>
    <p><strong>Visibility:</strong> {{ $post->is_published ? 'Published' : 'Draft' }}</p>
@endsection
