<x-layout>

    <div class="flex flex-col gap-4 p-6 max-w-2xl mx-auto">

        <div class="text-blue-600">
            Editar Evento
        </div>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('events.update', $event) }}" method="POST" class="flex flex-col gap-2">

            @csrf
            @method('PUT')

            <label class="flex gap-2">Título:
                <input type="text" name="title" value="{{ old('title', $event->title) }}">
            </label>

            <label class="flex gap-2">Descrição:
                <textarea name="description">{{ old('description', $event->description) }}
                </textarea>
            </label>

            <label class="flex gap-2">Local:
                <input type="text" name="location" value="{{ old('location', $event->location) }}">
            </label>

            <label class="flex gap-2">Data:
                <input type="datetime-local" name="starts_at"
                    value="{{ old('starts_at', $event->starts_at?->format('Y-m-d\TH:i')) }}">
            </label>

            <label class="flex gap-2">Capacidade: <input type="number" name="capacity"
                    value="{{ old('capacity', $event->capacity) }}">
            </label>

            <label class="flex gap-2">Status:
                <select name="status">
                    <option value="active" @selected(old('status', $event->status) === 'active')>active</option>
                    <option value="cancelled" @selected(old('status', $event->status) === 'cancelled')>cancelled</option>
                </select>

            </label>

            <div class="flex gap-3">
                <button type="submit">Salvar</button>
                <a href="{{ route('events.index') }}">cancelar</a>
            </div>

        </form>

    </div>

</x-layout>