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
                <div class="d-flex align-items-center justify-content-end gap-2">
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
    <div class="text-center py-5 mb-4">
        <h1 class="display-4 fw-bold text-primary">It all starts with the first step</h1>
        <p class="lead text-muted"><strong class="font-weight-bold">Mindcare Club (MCC)</strong> is a network of mental
            health psychiatrists,
            psychologists, and
            counselors in the Philippines. We are a Telemental Health service. We use online videoconferencing
            technology for delivering treatment and therapy to our patients and members over distances – conveniently
            and securely.</p>
        <a href="{{ route('login') }}" class="btn btn-secondary btn-lg mt-3">Schedule Appointment</a>
    </div>

    {{-- Features Section --}}
    <div class="row text-center g-4 mt-0">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-5">
                    <img src="{{ asset('/img/landing-icon-1.png') }}" class="img-fluid mcc-landing-icon" alt="licensed">
                    <h5 class="card-title mt-4 mb-3">Licensed Professionals Following a Proven Stepped Care Model</h5>
                    <p class="card-text text-muted">All our mental health and medical professionals are fully licensed
                        and adhere to a proven tier model. This ensures that our clients receive the highest standard of
                        care from qualified experts at every step of their mental health journey.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-5">
                    <img src="{{ asset('/img/landing-icon-2.png') }}" class="img-fluid mcc-landing-icon"
                        alt="therapies">
                    <h5 class="card-title mt-4 mb-3">Customized Therapies</h5>
                    <p class="card-text text-muted">We offer tailored therapies that utilize the collaboration of our
                        multidisciplinary team, ensuring that each client's unique needs are met with comprehensive and
                        specialized care. This approach allows us to address every aspect of our clients' mental health
                        effectively.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-5">
                    <img src="{{ asset('/img/landing-icon-3.png') }}" class="img-fluid mcc-landing-icon" alt="platform">
                    <h5 class="card-title mt-4 mb-3">Convenient, Secure, and Accessible Platform</h5>
                    <p class="card-text text-muted">Our HIPAA-compliant online videoconferencing platform is designed to
                        be convenient, secure, and easily accessible. It provides a private and safe space for clients
                        to receive mental health services without the need to travel to a physical clinic.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Call to Action --}}
    <div class="text-center mt-5 mb-4">
        <h4 class="fw-bold text-dark">Ready to start your journey?</h4>
        <a href="{{ route('register') }}" class="btn btn-outline-primary text-primary mt-3">Create an Account</a>
    </div>

</main>

@endauth

@endsection