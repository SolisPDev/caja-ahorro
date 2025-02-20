<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Solicitar Préstamo</h2>
    </x-slot>

    <div class="max-w-lg mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('prestamos.store') }}">
                @csrf

                <input type="hidden" name="socio_id" value="{{ $socio->id }}">

                <div class="mb-4">
                    <x-label value="Monto del Préstamo" />
                    <x-input class="block w-full" type="number" name="monto" step="0.01" required />
                </div>

                <div class="mb-4">
                    <x-label value="Tasa de Interés (%)" />
                    <x-input class="block w-full" type="number" name="tasa_interes" step="0.01" value="5" required />
                </div>

                <div class="mb-4">
                    <x-label value="Número de Quincenas" />
                    <x-input class="block w-full" type="number" name="quincenas" required />
                </div>

                <div class="mb-4">
                    <x-label value="Fecha de Inicio" />
                    <x-input class="block w-full" type="date" name="fecha_inicio" required />
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('prestamos.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
                        Regresar
                    </a>
                    <x-button>Solicitar</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
