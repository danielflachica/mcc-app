@extends('layouts.app')

@section('title', 'Book Appointment | ' . config('app.name', 'Mindcare Club'))

@section('content')

@auth

<x-card>
    <x-slot name="header">
        <h3 class="my-1">Book Appointment</h3>
    </x-slot>

    <x-error-list class="list-unstyled"></x-error-list>

    <form action="{{ route('client.appointment.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="inputScheduleID" class="form-label">Select Schedule</label>
            <select class="form-select" id="inputScheduleID" name="id" required>
                <option selected>-- Select --</option>
                @foreach ($schedules as $schedule)
                <option value="{{ $schedule->id }}">
                    {{ $schedule->provider->name }} ({{ $schedule->starts_at->format('M d, Y h:i A') }} - {{
                    $schedule->ends_at->format('M d, Y h:i A') }})
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Book Appointment</button>
    </form>
</x-card>

@endauth

@endsection