<x-layout>

    <div class="flex flex-col gap-6 p-6 max-w-2xl mx-auto">

        <div class="text-blue-600">
            Minhas Inscrições
        </div>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="flex flex-col gap-2">
            <ul class="flex flex-col gap-2">
                @forelse ($registrations as $registration)
                    <li class="flex items-center gap-3">
                        <span>
                            {{ $registration->event->title }} —
                            {{ $registration->event->starts_at?->format('d/m/Y H:i') }}
                        </span>
                        <form action="{{ route('events.unregister', $registration->event) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">cancelar inscrição</button>
                        </form>
                    </li>
                @empty
                    <li>Você ainda não tem inscrições.</li>
                @endforelse
            </ul>
        </div>

        <a href="{{ route('events.index') }}">voltar para eventos</a>

    </div>

</x-layout>