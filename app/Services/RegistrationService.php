<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    public function listForUser(int $userId): Collection
    {
        return Registration::with('event')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function listSubscribers(Event $event): Collection
    {
        return Registration::with('user')
            ->where('event_id', $event->id)
            ->latest()
            ->get();
    }

    public function register(Event $event, int $userId): Registration
    {
        if ($event->starts_at !== null && $event->starts_at->isPast()) {
            throw ValidationException::withMessages([
                'event' => 'Este evento ja aconteceu.',
            ]);
        }

        $existe = Registration::where('user_id', $userId)
            ->where('event_id', $event->id)
            ->exists();

        if ($existe) {
            throw ValidationException::withMessages([
                'event' => 'Voce ja esta inscrito neste evento.',
            ]);
        }

        if ($event->capacity !== null) {
            $inscritos = Registration::where('event_id', $event->id)->count();
            if ($inscritos >= $event->capacity) {
                throw ValidationException::withMessages([
                    'event' => 'Este evento esta lotado.',
                ]);
            }
        }

        return Registration::create([
            'user_id' => $userId,
            'event_id' => $event->id,
        ]);
    }

    public function cancel(Event $event, int $userId): void
    {
        Registration::where('user_id', $userId)
            ->where('event_id', $event->id)
            ->delete();
    }
}
