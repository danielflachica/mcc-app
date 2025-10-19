@extends('layouts.public')

{{-- @section('title', 'MindCare Club') --}}

@section('hero')
{{-- Landing Image --}}
<div class="row m-0" id="bg-landing-img"></div>
@endsection

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
    {{-- Hero Section --}}
    <div class="text-center py-5 mb-5">
        <h1 class="display-4 fw-bold text-dark">Welcome to <span class="text-primary">Mindcare Club</span></h1>
        <p class="lead text-muted">Your trusted space for wellness, therapy, and personal growth.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-3">Get Started</a>
    </div>

    {{-- Features Section --}}
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-calendar-heart fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Book Sessions Easily</h5>
                    <p class="card-text text-muted">Schedule therapy appointments with certified providers in just a
                        few clicks.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-people fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Connect with Experts</h5>
                    <p class="card-text text-muted">Our professional network of therapists and counselors are here
                        for you.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-chat-dots fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Grow with Guidance</h5>
                    <p class="card-text text-muted">Track your progress and stay consistent with your mental
                        wellness goals.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Call to Action --}}
    <div class="text-center mt-5">
        <h4 class="fw-bold text-dark">Ready to start your journey?</h4>
        <a href="{{ route('login') }}" class="btn btn-outline-primary text-primary mt-3">Login</a>
    </div>

</main>

@endauth

@endsection