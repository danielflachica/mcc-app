@extends('layouts.app')

@section('title', 'My Schedules | ' . config('app.name', 'Mindcare Club'))

@section('content')

@auth
<x-card>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>My Schedules</h3>
            <a href="{{ route('provider.schedule.create') }}">
                <button type="button" class="btn btn-sm btn-primary">Add Schedule</button>
            </a>
        </div>
    </x-slot>

    <div class="container">
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Status</th>
                        <th scope="col">Start</th>
                        <th scope="col">End</th>
                        <th scope="col">Notes</th>
                        <th scope="col">Date Created</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->client->name ?? 'N/A' }}</td>
                        <td>{{ $schedule->status->name }}</td>
                        <td>{{ $schedule->starts_at->format('M d, Y h:i A') }}</td>
                        <td>{{ $schedule->ends_at->format('M d, Y h:i A') }}</td>
                        <td>{{ $schedule->notes }}</td>
                        <td>{{ $schedule->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('provider.schedule.edit', $schedule->id) }}">
                                    <button type="button" class="btn btn-sm btn-primary">Edit</button>
                                </a>
                                <form action="{{ route('provider.schedule.destroy', $schedule->id) }}" method="POST">
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