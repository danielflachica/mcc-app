@extends('layouts.app')

@section('title', 'Mindcare Club | My Appointments')

@section('content')

@auth
<x-card>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>My Appointments</h3>
            <a href="{{ route('client.appointment.edit') }}">
                <button type="button" class="btn btn-sm btn-primary">Book Appointment</button>
            </a>
        </div>
    </x-slot>

    <div class="container">
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Provider</th>
                        <th scope="col">Status</th>
                        <th scope="col">Start</th>
                        <th scope="col">End</th>
                        <th scope="col">Provider Notes</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->provider->name }}</td>
                        <td>{{ $schedule->status->name }}</td>
                        <td>{{ $schedule->starts_at->format('M d, Y h:i A') }}</td>
                        <td>{{ $schedule->ends_at->format('M d, Y h:i A') }}</td>
                        <td>{{ $schedule->notes }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <form action="{{ route('client.appointment.cancel', $schedule->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-danger">Cancel</button>
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