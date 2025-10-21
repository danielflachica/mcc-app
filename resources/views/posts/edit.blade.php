@extends('layouts.app')

@section('title', ' Club | Edit Post')
@section('title', 'Edit Post | ' . config('app.name', 'Mindcare Club'))

@section('content')

@auth

<x-card>
    <x-slot name="header">
        <h3 class="my-1">Edit Post</h3>
    </x-slot>

    <x-error-list class="list-unstyled"></x-error-list>

    <form action="/edit-post/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Content</label>
            <textarea class="form-control" name="body"
                placeholder="Enter your content here...">{{ $post->body }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Post</button>
    </form>
</x-card>
@endauth

@endsection