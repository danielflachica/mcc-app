@extends('layouts.app')

@section('title', 'Edit Schedule | ' . config('app.name', 'Mindcare Club'))

@section('content')

@auth

<x-card>
    <x-slot name="header">
        <h3>Edit Schedule</h3>
    </x-slot>

    <form action="{{ route('provider.schedule.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="inputStatusID" class="form-label">Status</label>
            <select class="form-select" id="inputStatusID" name="schedule_status_id" required>
                <option>-- Select --</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ old('schedule_status_id', $schedule->schedule_status_id) ==
                    $status->id ?
                    'selected' :
                    '' }}>
                    {{ $status->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-12 col-md-6">
                    <label for="inputStartsAt" class="form-label">Starts At</label>
                    <input type="datetime-local" class="form-control" id="inputStartsAt" name="starts_at"
                        value="{{ old('starts_at', $schedule->starts_at) }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="inputEndsAt" class="form-label">Ends At</label>
                    <input type="datetime-local" class="form-control" id="inputEndsAt" name="ends_at"
                        value="{{ old('ends_at', $schedule->ends_at) }}" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" name="notes" placeholder="Enter schedule notes here..."
                rows="5">{{ old('notes', $schedule->notes) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Schedule</button>
    </form>
</x-card>

@endauth

@endsection