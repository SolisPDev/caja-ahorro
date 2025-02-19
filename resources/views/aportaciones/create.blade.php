<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Aportación</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('aportaciones.store') }}">
                @csrf

                <!-- Campo oculto para el socio_id -->
                <input type="hidden" name="socio_id" value="{{ $socio->id }}">

                <div class="mb-4">
                    <x-label value="Socio" />
                    <p class="text-gray-800 font-semibold">{{ $socio->nombre }} {{ $socio->apellido_paterno }}</p>
                </div>

                <div class="mb-4">
                    <x-label for="monto" value="Monto de Aportación" />
                    <x-input id="monto" class="block w-full" type="number" name="monto" step="0.01" required />
                </div>

                <div class="mb-4">
                    <x-label for="fecha_pago" value="Fecha de Aportación" />
                    <x-input id="fecha_pago" class="block w-full" type="date" name="fecha_pago" required />
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
                        Regresar
                    </a>
                    <x-button>
                        Guardar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
