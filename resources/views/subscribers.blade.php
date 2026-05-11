<x-layout>

    <div class="flex flex-col gap-6 p-6 max-w-2xl mx-auto">

        <div class="text-blue-600">
            Inscritos no evento: {{ $event->title }}
        </div>

        <div class="flex flex-col gap-2">
            <ul class="flex flex-col gap-2">
                @forelse ($subscribers as $subscriber)
                    <li>
                        {{ $subscriber->user->name }} —
                        inscrito em {{ $subscriber->created_at?->format('d/m/Y H:i') }}
                    </li>
                @empty
                    <li>Ninguém inscrito ainda.</li>
                @endforelse
            </ul>
        </div>

        <a href="{{ route('events.index') }}">voltar para eventos</a>

    </div>

</x-layout>