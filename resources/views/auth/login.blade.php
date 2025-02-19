<x-guest-layout>
    <x-slot name="title">Acceso a Caja de Ahorro</x-slot>

    <h1 class="text-2xl font-bold text-center text-gray-700">¡Bienvenido!</h1>

    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('img/logo.png') }}" class="w-48 mx-auto">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="Correo electrónico" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Contraseña" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="mt-4 flex justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember">
                    <span class="ml-2">Recordarme</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <div class="mt-4">
                <x-button class="w-full">Iniciar Sesión</x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
