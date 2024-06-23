@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1 class="mb-4">Edit Post</h1>
    <form action="{{ route( Auth::user()->roles->pluck('name')->contains('administrator') ? 'admin.posts.update' : 'moderator.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control" required>{{ old('body', $post->body) }}</textarea>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select id="categories" name="categories[]" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($post->categories->contains($category->id)) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control-file">
            @if($post->images->count())
                <img src="{{ asset('storage/' . $post->images->first()->path) }}" alt="Post Image" style="width:100px;">
            @endif
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="is_published" name="is_published" class="form-check-input" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
            <label for="is_published" class="form-check-label">Publish</label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
