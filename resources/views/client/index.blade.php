@extends('layouts.app')

@section('title', 'Mindcare Club | Client Dashboard')

@section('content')

@auth
<x-card>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Dashboard</h3>
            <a href="{{ route('client.appointment.index') }}">
                <button type="button" class="btn btn-sm btn-primary">Manage Appointments</button>
            </a>
        </div>
    </x-slot>

    <div class="container">
        <div class="alert alert-info w-100 mt-3" role="alert">
            HELLO CLIENT
        </div>
    </div>
</x-card>
@endauth

@endsection