<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Socio</h2>
    </x-slot>
    <div class="py-6 max-w-lg mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('socios.store') }}">
                @csrf
                <div class="mt-4">
                    <x-label for="nombre" value="Nombre(s)" />
                    <x-input id="nombre" class="block w-full" type="text" name="nombre" required />
                </div>
                <div class="mt-4">
                    <x-label for="apellido_paterno" value="Apellido Paterno" />
                    <x-input id="apellido_paterno" class="block w-full" type="text" name="apellido_paterno" required />
                </div>
                <div class="mt-4">
                    <x-label for="apellido_materno" value="Apellido Materno" />
                    <x-input id="apellido_materno" class="block w-full" type="text" name="apellido_materno" required />
                </div>
                <div class="mt-4">
                    <x-label for="email" value="Correo Electrónico" />
                    <x-input id="email" class="block w-full" type="email" name="email" required />
                </div>
                <div class="mt-4">
                    <x-label for="telefono" value="Teléfono" />
                    <x-input id="telefono" class="block w-full" type="text" name="telefono" required />
                </div>
                <div class="flex justify-between mt-4">
                    <a href="{{ route('socios.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-gray-700">
                        Regresar
                    </a>
                    <x-button class="w-30">Guardar</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
