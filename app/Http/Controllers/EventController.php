<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct(private EventService $events) {}

    public function index()
    {
        $events = $this->events->list();

        return view('events', compact('events'));
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $this->events->create($data);

        return redirect()->route('events.index');
    }

    public function edit(Event $event)
    {
        return view('eventEdit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->events->update($event, $request->validated());

        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $this->events->delete($event);

        return redirect()->route('events.index');
    }
}
