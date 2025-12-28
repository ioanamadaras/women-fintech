<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // LISTARE + FILTRARE + SORTARE + PAGINARE
    public function index(Request $request)
    {
        $query = Event::query();

        // filtrare: upcoming / past
        if ($request->filter === 'upcoming') {
            $query->where('event_date', '>=', now()->toDateString());
        }

        if ($request->filter === 'past') {
            $query->where('event_date', '<', now()->toDateString());
        }

        // sortare cronologică
        $events = $query->orderBy('event_date', 'asc')->paginate(5);

        return view('events.index', compact('events'));
    }

    // FORM CREATE
    public function create()
    {
        return view('events.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'event_date' => 'required|date|',
            'description' => 'required|min:10',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    // FORM EDIT
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // UPDATE
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'event_date' => 'required|date',
            'description' => 'required|min:10',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    // DELETE
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted.');
    }
}
