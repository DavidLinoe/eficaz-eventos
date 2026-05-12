<x-layout>

    <div class="flex flex-col gap-6 p-6 max-w-md mx-auto">

        <div class="text-blue-600">
            Login
        </div>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-2">
            @csrf

            <label class="flex gap-2">Email:
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>

            <label class="flex gap-2">Senha:
                <input type="password" name="password" required>
            </label>

            <button type="submit" class="self-start">Entrar</button>
        </form>

    </div>

</x-layout>
