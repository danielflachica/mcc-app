@extends('layouts.app')

@section('title', 'Mindcare Club | Login')

@section('content')

<x-card>
    <x-slot name="header">
        <h3>Login</h3>
    </x-slot>

    <form action="/login" method="POST">
        @csrf
        <div class="mb-3">
            <label for="loginEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="loginEmail" name="loginEmail">
        </div>

        <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="loginPassword">
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</x-card>

@endsection