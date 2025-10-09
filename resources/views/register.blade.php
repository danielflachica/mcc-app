@extends('layouts.app')

@section('title', 'Mindcare Club | Register')

@section('content')

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
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</x-card>

@endsection