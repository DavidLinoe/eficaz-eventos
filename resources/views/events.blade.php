<x-layout>

    <div class="flex flex-col gap-6 p-6 max-w-2xl mx-auto">

        <div class="text-blue-600">
            Tela de Eventos
        </div>

        <div class="flex flex-col gap-2">
            <h1>Novo Evento</h1>

            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('events.store') }}" method="POST" class="flex flex-col gap-2">

                @csrf
                <label class="flex gap-2">Título:
                    <input type="text" name="title" value="{{ old('title') }}">
                </label>

                <label class="flex gap-2">Descrição: <textarea name="description">{{ old('description') }}
                    </textarea>
                </label>

                <label class="flex gap-2">Local:
                    <input type="text" name="location" value="{{ old('location') }}">
                </label>

                <label class="flex gap-2">Data:
                    <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}">
                </label>

                <label class="flex gap-2">Capacidade:
                    <input type="number" name="capacity" value="{{ old('capacity') }}">
                </label>

                <label class="flex gap-2">Status:
                    <select name="status">
                        <option value="active" @selected(old('status') === 'active')>active</option>
                        <option value="cancelled" @selected(old('status') === 'cancelled')>cancelled</option>
                    </select>

                </label>

                <button type="submit" class="self-start">Criar</button>
            </form>
        </div>

        <div class="flex flex-col gap-2">
            <h1>Listagem dos Eventos</h1>
            <ul class="flex flex-col gap-2">
                @foreach ($events as $event)
                    <li class="flex items-center gap-3">
                        <span>Evento: {{ $event->title }} — {{ $event->starts_at?->format('d/m/Y H:i') }}</span>

                        <form action="{{ route('events.register', $event) }}" method="POST"
                            onsubmit="return confirm('Confirmar inscrição neste evento?');">
                            @csrf
                            <button type="submit">inscrever-se</button>
                        </form>

                        @can('viewSubscribers', $event)
                            <a href="{{ route('events.subscribers', $event) }}">ver inscritos</a>
                        @endcan

                        @can('update', $event)
                            <a href="{{ route('events.edit', $event) }}">editar</a>
                        @endcan

                        @can('delete', $event)
                            <form action="{{ route('events.destroy', $event) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">excluir</button>
                            </form>
                        @endcan
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

</x-layout>