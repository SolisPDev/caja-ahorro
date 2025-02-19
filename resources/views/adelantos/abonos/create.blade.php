<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Abono</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold mb-4">Socio: {{ $socio->nombre }}</h3>

            {{-- Mensajes de éxito o error --}}
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Formulario de Abono --}}
            <form action="{{ route('abonos.store', $adelanto->id) }}" method="POST">
                @csrf

                {{-- Monto del Abono --}}
                <div class="mb-4">
                    <x-label for="monto" value="Monto del Abono" />
                    <x-input id="monto" type="number" name="monto" min="1" required class="block w-full" />
                </div>

                {{-- Fecha del Abono --}}
                <div class="mb-4">
                    <x-label for="fecha" value="Fecha de Abono" />
                    <x-input id="fecha" type="date" name="fecha" required class="block w-full" />
                </div>

                <!-- Campo Oculto con el ID del Adelanto -->
                <input type="hidden" name="adelanto_id" value="{{ $adelanto->id }}">

                {{-- Botón de Guardar --}}
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('adelantos.activos') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                        Regresar
                    </a>
                    <x-button class="bg-blue-600 hover:bg-blue-700">
                        Registrar Abono
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
