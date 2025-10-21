@extends('layouts.app')

@section('title', 'Add User | ' . config('app.name', 'Mindcare Club'))

@section('content')

@auth

<x-card>
    <x-slot name="header">
        <h3 class="my-1">Add a New User</h3>
    </x-slot>

    <x-error-list class="list-unstyled"></x-error-list>

    <form action="{{ route('admin.create') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" required>
        </div>
        <div class="mb-3">
            <label for="inputRoleID" class="form-label">Role</label>
            <select class="form-select" id="inputRoleID" name="user_role_id" required>
                <option selected disabled>-- Select --</option>
                @foreach ($userRoles as $role)
                <option value="{{ $role->id }}" {{ old('user_role_id')==$role->id ? 'selected' : '' }}>{{ $role->name }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</x-card>

@endauth

@endsection