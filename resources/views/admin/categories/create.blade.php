@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <h1 class="mb-4">Create Category</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
