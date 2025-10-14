<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Schedule;
use App\Models\ScheduleStatus;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::where('client_id', Auth::id())->orderBy('starts_at', 'DESC')->get();

        return view('client.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $availableID = ScheduleStatus::where('name', 'Available')->value('id');
        $schedules = Schedule::where('schedule_status_id', $availableID)->get();

        return view('client.schedules.edit', compact('schedules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validatedFields = $request->validate([
            'id' => 'required|exists:schedules,id',
        ]);

        $validatedFields['schedule_status_id'] = ScheduleStatus::where('name', 'Booked')->value('id');
        $validatedFields['client_id'] = Auth::id();

        $schedule = Schedule::findOrFail($validatedFields['id']);

        $schedule->update($validatedFields);

        return redirect()->route('client.appointment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    public function cancel(Schedule $schedule)
    {
        $schedule->client_id = null;
        $schedule->schedule_status_id = ScheduleStatus::where('name', 'Available')->value('id');

        $schedule->save();

        return redirect()->route('client.appointment.index');
    }

    /**
     * Return all appointments as a JSON object
     */
    public function events()
    {
        $schedules = Schedule::where('client_id', Auth::id())
            ->with(['provider', 'client', 'status'])
            ->orderBy('starts_at', 'DESC')
            ->get();

        // Transform to only include the properties FullCalendar needs
        $events = $schedules->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->provider->name ?? '',
                'start' => $schedule->starts_at,
                'end' => $schedule->ends_at,
                'display' => 'block',
                'status' => $schedule->status->name ?? null,
                'notes' => $schedule->notes ?? null,
                'provider' => $schedule->provider->name ?? null,
                'client' => $schedule->client->name ?? null,
                'backgroundColor' => $schedule->status->background_color ?? null,
                'borderColor' => $schedule->status->background_color ?? null,
            ];
        });

        return response()->json($events);
    }
}
