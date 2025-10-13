<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Schedule;
use App\Models\ScheduleStatus;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::where('provider_id', Auth::id())->orderBy('starts_at', 'DESC')->get();

        return view('provider.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = ScheduleStatus::all();

        return view('provider.schedules.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedFields = $request->validate([
            'starts_at' => 'required|date|after_or_equal:now',
            'ends_at' => 'required|date|after:starts_at',
            'notes' => 'nullable|string|max:500',
        ]);

        $validatedFields['schedule_status_id'] = ScheduleStatus::where('name', 'Available')->value('id');
        $validatedFields['notes'] = strip_tags($validatedFields['notes']);
        $validatedFields['provider_id'] = Auth::id();

        Schedule::create($validatedFields);

        return redirect()->route('provider.schedule.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $statuses = ScheduleStatus::all();

        return view('provider.schedules.edit', compact('schedule', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validatedFields = $request->validate([
            'schedule_status_id' => 'required|exists:schedule_statuses,id',
            'starts_at' => 'required|date|after_or_equal:now',
            'ends_at' => 'required|date|after:starts_at',
            'notes' => 'nullable|string|max:500',
        ]);

        $validatedFields['notes'] = strip_tags($validatedFields['notes']);

        $schedule->update($validatedFields);

        return redirect()->route('provider.schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('provider.schedule.index');
    }

    /**
     * Return all schedules as a JSON object
     */
    public function events()
    {
        $schedules = Schedule::with(['provider', 'client', 'status'])->get();

        // Transform to only include the properties FullCalendar needs
        $events = $schedules->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->notes ?? 'Appointment', // fallback if notes is null
                'start' => $schedule->starts_at,
                'end' => $schedule->ends_at,
                'display' => 'block',
                'status' => $schedule->status->name ?? null,
                'provider' => $schedule->provider->name ?? null,
                'client' => $schedule->client->name ?? null,
                'backgroundColor' => $schedule->status->background_color ?? null,
                'borderColor' => $schedule->status->background_color ?? null,
            ];
        });

        return response()->json($events);
    }
}
