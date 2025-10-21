@extends('layouts.public')

@section('title', 'Login | ' . config('app.name', 'Mindcare Club'))

@section('hero')
<div class="row m-0 d-flex align-items-center justify-content-center pt-4" id="bg-landing-img">
    <div class="mt-5 py-4 px-5 w-auto glass">
        <h1 class="text-white">Start your journey</h1>
    </div>
</div>
@endsection

@section('content')

<div class="row pt-3">
    <div class="col col-12 col-md-8 col-lg-6 mx-auto">
        <x-card>
            <x-slot name="header">
                <h3 class="my-1">Login</h3>
            </x-slot>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="loginEmail" name="loginEmail">
                </div>

                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="loginPassword">
                </div>

                <button type="submit" class="btn btn-secondary">Login</button>
            </form>
        </x-card>
    </div>
</div>

@endsection