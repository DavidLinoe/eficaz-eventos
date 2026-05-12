<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Event;
use App\Services\RegistrationService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends Controller
{
    public function __construct(private RegistrationService $registrations) {}

    public function index()
    {
        $userId = Auth::id();
        $registrations = $this->registrations->listForUser($userId);

        return view('registrations', compact('registrations'));
    }

    public function store(StoreRegistrationRequest $request, Event $event)
    {
        $userId = Auth::id();
        $this->registrations->register($event, $userId);

        return redirect()->route('registrations.index');
    }

    public function destroy(Event $event)
    {
        $userId = Auth::id();
        $this->registrations->cancel($event, $userId);

        return redirect()->route('registrations.index');
    }

    public function subscribers(Event $event)
    {
        $userId = Auth::id();

        // somente o criador do evento pode ver a lista
        if ($event->user_id !== $userId) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $subscribers = $this->registrations->listSubscribers($event);

        return view('subscribers', compact('event', 'subscribers'));
    }
}
