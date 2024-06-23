@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <h1 class="mb-4">Create Post</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control" required>{{ old('body') }}</textarea>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select id="categories" name="categories[]" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="is_published" name="is_published" class="form-check-input" {{ old('is_published') ? 'checked' : '' }}>
            <label for="is_published" class="form-check-label">Publish</label>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
