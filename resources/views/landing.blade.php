@extends('layouts.app')

{{-- @section('title', 'MindCare Club') --}}

@section('content')

@auth

<x-card>
    <x-slot name="header">
        <h3>Create a New Post</h3>
    </x-slot>

    <form action="/create-post" method="POST">
        @csrf
        <div class="mb-3">
            <label for="inputTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="inputTitle" name="title">
        </div>
        <div class="mb-3">
            <label for="inputBody" class="form-label">Content</label>
            <textarea name="body" class="form-control" id="inputBody" cols="30" rows="10"
                placeholder="Enter your content here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Post</button>
    </form>
</x-card>

<div class="mt-4">
    <h3>All Posts</h3>
    @foreach ($posts as $post)
    <x-card class="mt-4">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-baseline gap-2">
                    <h4 class="m-0 mb-1">{{ $post->title }}</h4>
                    <p class="m-0 text-secondary">
                        By {{ $post->author->name }} ({{ $post->author->role->name }})
                    </p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="/edit-post/{{ $post->id }}">
                        <button type="button" class="btn btn-sm btn-primary">Edit</button>
                    </a>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </x-slot>
        {{ $post->body }}
    </x-card>
    @endforeach
</div>

@else

<main>
    <div class="card">
        <div class="card-body">
            <div class="d-block border w-100 p-3 mb-3 rounded bg-primary text-white">bg-primary text-white</div>
            <div class="d-block border w-100 p-3 mb-3 rounded bg-secondary text-white">bg-secondary text-white</div>
            <div class="d-block border w-100 p-3 mb-3 rounded bg-success text-white">bg-success text-white</div>
            <div class="d-block border w-100 p-3 mb-3 rounded bg-info text-white">bg-info text-white</div>
            <div class="d-block border w-100 p-3 mb-3 rounded bg-warning text-dark">bg-warning text-dark</div>
            <div class="d-block border w-100 p-3 mb-3 rounded bg-danger text-white">bg-danger text-white</div>
            <div class="d-block border w-100 p-3 mb-3 rounded bg-light text-dark">bg-light text-dark</div>
            <div class="d-block border w-100 p-3 mb-3 rounded bg-dark text-white">bg-dark text-white</div>
        </div>
    </div>
</main>

@endauth

@endsection