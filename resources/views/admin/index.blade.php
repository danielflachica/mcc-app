@extends('layouts.app')

@section('title', 'Mindcare Club | Admin Dashboard')

@section('content')

@auth
<x-card>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>All Users</h3>
            <a href="{{ route('admin.create') }}">
                <button type="button" class="btn btn-sm btn-primary">Add User</button>
            </a>
        </div>
    </x-slot>

    <div class="container">
        {{--
        <x-table :data="$users" title="All Users" /> --}}
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('admin.edit', $user->id) }}">
                                    <button type="button" class="btn btn-sm btn-primary">Edit</button>
                                </a>
                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-card>
@endauth

@endsection