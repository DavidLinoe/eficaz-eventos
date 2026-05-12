<x-layout>

    <div class="flex flex-col gap-6 p-6 max-w-2xl mx-auto">

        <div class="text-blue-600">
            Tela de Eventos
        </div>

        <div class="flex flex-col gap-3">
            <h1 class="text-lg font-semibold">Novo Evento</h1>

            @if ($errors->any())
                <ul class="rounded border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('events.store') }}" method="POST" class="flex flex-col gap-3">
                @csrf

                <label class="flex flex-col gap-1 text-sm">
                    Título
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="rounded border border-gray-300 px-3 py-2">
                </label>

                <label class="flex flex-col gap-1 text-sm">
                    Descrição
                    <textarea name="description" rows="3"
                        class="rounded border border-gray-300 px-3 py-2">{{ old('description') }}</textarea>
                </label>

                <label class="flex flex-col gap-1 text-sm">
                    Local
                    <input type="text" name="location" value="{{ old('location') }}"
                        class="rounded border border-gray-300 px-3 py-2">
                </label>

                <label class="flex flex-col gap-1 text-sm">
                    Data
                    <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}"
                        class="rounded border border-gray-300 px-3 py-2">
                </label>

                <label class="flex flex-col gap-1 text-sm">
                    Capacidade
                    <input type="number" name="capacity" value="{{ old('capacity') }}"
                        class="rounded border border-gray-300 px-3 py-2">
                </label>

                <label class="flex flex-col gap-1 text-sm">
                    Status
                    <select name="status" class="rounded border border-gray-300 px-3 py-2">
                        <option value="active" @selected(old('status') === 'active')>active</option>
                        <option value="cancelled" @selected(old('status') === 'cancelled')>cancelled</option>
                    </select>
                </label>

                <button type="submit"
                    class="self-start rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    Criar
                </button>
            </form>
        </div>

        <div class="flex flex-col gap-2">
            <h1 class="text-lg font-semibold">Listagem dos Eventos</h1>

            <ul class="flex flex-col gap-2">
                @foreach ($events as $event)
                    <li class="flex flex-wrap items-center gap-3 rounded border border-gray-200 bg-white p-3">
                        <span class="flex-1">
                            Evento: {{ $event->title }} —
                            <span class="text-gray-500">{{ $event->starts_at?->format('d/m/Y H:i') }}</span>
                        </span>

                        <form action="{{ route('events.register', $event) }}" method="POST"
                            onsubmit="return confirm('Confirmar inscrição neste evento?');">
                            @csrf
                            <button type="submit"
                                class="rounded bg-green-600 px-3 py-1 text-sm text-white hover:bg-green-700">
                                inscrever-se
                            </button>
                        </form>

                        @can('viewSubscribers', $event)
                            <a href="{{ route('events.subscribers', $event) }}"
                                class="rounded border border-gray-300 px-3 py-1 text-sm hover:bg-gray-100">
                                ver inscritos
                            </a>
                        @endcan

                        @can('update', $event)
                            <a href="{{ route('events.edit', $event) }}"
                                class="rounded border border-gray-300 px-3 py-1 text-sm hover:bg-gray-100">
                                editar
                            </a>
                        @endcan

                        @can('delete', $event)
                            <form action="{{ route('events.destroy', $event) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700">
                                    excluir
                                </button>
                            </form>
                        @endcan
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

</x-layout>
