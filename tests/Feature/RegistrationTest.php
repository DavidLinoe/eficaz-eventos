<?php

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Services\RegistrationService;
use Illuminate\Validation\ValidationException;

it('nao permite inscricao duplicada', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create();

    $service = app(RegistrationService::class);

    $service->register($event, $user->id);

    $service->register($event, $user->id);
})->throws(ValidationException::class);

it('bloqueia inscricao em evento lotado', function () {
    $event = Event::factory()->create(['capacity' => 1]);

    $userA = User::factory()->create();
    $userB = User::factory()->create();

    $service = app(RegistrationService::class);

    $service->register($event, $userA->id);

    $service->register($event, $userB->id);
})->throws(ValidationException::class);

it('permite cancelar somente a propria inscricao', function () {
    $dono = User::factory()->create();
    $outro = User::factory()->create();
    $event = Event::factory()->create();

    Registration::factory()->create([
        'user_id' => $dono->id,
        'event_id' => $event->id,
    ]);

    app(RegistrationService::class)->cancel($event, $outro->id);

    expect(Registration::where('user_id', $dono->id)->where('event_id', $event->id)->exists())
        ->toBeTrue();

    app(RegistrationService::class)->cancel($event, $dono->id);

    expect(Registration::where('user_id', $dono->id)->where('event_id', $event->id)->exists())
        ->toBeFalse();
});

it('somente o criador do evento pode ver os inscritos', function () {
    $criador = User::factory()->create();
    $outro = User::factory()->create();
    $event = Event::factory()->create(['user_id' => $criador->id]);

    $this->actingAs($outro)
        ->get(route('events.subscribers', $event))
        ->assertForbidden();

    $this->actingAs($criador)
        ->get(route('events.subscribers', $event))
        ->assertOk();
});
