<x-layout>

    <div class="text-blue-600">
        Tela de Eventos
    </div>



    <x-eventsModal>

    </x-eventsModal>


    <div>
        <h1>Listagem dos Eventos</h1>
        <ul>

            @foreach ($events as $event)
                <li>Evento: {{ $event->title }}</li>
            @endforeach
        </ul>

    </div>


</x-layout>