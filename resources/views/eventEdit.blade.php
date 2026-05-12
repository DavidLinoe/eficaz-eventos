<x-layout>

    <div class="flex flex-col gap-6 p-6 max-w-2xl mx-auto">

        <div class="text-blue-600">
            Editar Evento
        </div>

        @if ($errors->any())
            <ul class="rounded border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('events.update', $event) }}" method="POST" class="flex flex-col gap-3">

            @csrf
            @method('PUT')

            <label class="flex flex-col gap-1 text-sm">
                Título
                <input type="text" name="title" value="{{ old('title', $event->title) }}"
                    class="rounded border border-gray-300 px-3 py-2">
            </label>

            <label class="flex flex-col gap-1 text-sm">
                Descrição
                <textarea name="description" rows="3"
                    class="rounded border border-gray-300 px-3 py-2">{{ old('description', $event->description) }}</textarea>
            </label>

            <label class="flex flex-col gap-1 text-sm">
                Local
                <input type="text" name="location" value="{{ old('location', $event->location) }}"
                    class="rounded border border-gray-300 px-3 py-2">
            </label>

            <label class="flex flex-col gap-1 text-sm">
                Data
                <input type="datetime-local" name="starts_at"
                    value="{{ old('starts_at', $event->starts_at?->format('Y-m-d\TH:i')) }}"
                    class="rounded border border-gray-300 px-3 py-2">
            </label>

            <label class="flex flex-col gap-1 text-sm">
                Capacidade
                <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}"
                    class="rounded border border-gray-300 px-3 py-2">
            </label>

            <label class="flex flex-col gap-1 text-sm">
                Status
                <select name="status" class="rounded border border-gray-300 px-3 py-2">
                    <option value="active" @selected(old('status', $event->status) === 'active')>active</option>
                    <option value="cancelled" @selected(old('status', $event->status) === 'cancelled')>cancelled</option>
                </select>
            </label>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    Salvar
                </button>
                <a href="{{ route('events.index') }}" class="text-sm text-gray-600 hover:underline">cancelar</a>
            </div>

        </form>

    </div>

</x-layout>
