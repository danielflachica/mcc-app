@extends('layouts.app')

@section('title', 'Add Schedule | ' . config('app.name', 'Mindcare Club'))

@section('content')

@auth

<x-card>
    <x-slot name="header">
        <h3 class="my-1">Add a New Schedule</h3>
    </x-slot>

    <x-error-list class="list-unstyled"></x-error-list>

    <form action="{{ route('provider.schedule.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <div class="row">
                <div class="col-12 col-md-6">
                    <label for="inputStartsAt" class="form-label">Starts At</label>
                    <input type="datetime-local" class="form-control" id="inputStartsAt" name="starts_at"
                        value="{{ old('starts_at') }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="inputEndsAt" class="form-label">Ends At</label>
                    <input type="datetime-local" class="form-control" id="inputEndsAt" name="ends_at"
                        value="{{ old('ends_at') }}" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" name="notes" placeholder="Enter schedule notes here..."
                rows="5">{{ old('notes') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Schedule</button>
    </form>
</x-card>

@endauth

@endsection