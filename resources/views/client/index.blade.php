@extends('layouts.app')

@section('title', 'Dashboard | ' . config('app.name', 'Mindcare Club'))

@section('header')

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
<script>
    const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var events = [];
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: userTimeZone,
            events: '/client/appointments/events',
        });
        calendar.render();
    });
</script>

@endsection

@section('content')

@auth
<div id="calendar" class="bg-white rounded p-3"></div>
@endauth

@endsection