@extends('layouts.public')

@section('title', 'Register | ' . config('app.name', 'Mindcare Club'))

@section('hero')
<div class="row m-0 d-flex align-items-center justify-content-center pt-4" id="bg-landing-img">
    <div class="mt-5 py-4 px-5 w-auto glass">
        <h1 class="text-white">Create an Account</h1>
    </div>
</div>
@endsection

@section('content')

<div class="row pt-3">
    <div class="col col-12 col-md-8 col-lg-6 mx-auto">
        <x-card>
            <x-slot name="header">
                <h3>Register</h3>
            </x-slot>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name">
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password">
                </div>
                <button type="submit" class="btn btn-secondary">Create Account</button>
            </form>
        </x-card>
    </div>
</div>

@endsection