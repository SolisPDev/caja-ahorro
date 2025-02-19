<x-app-layout> 
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Solicitar Adelanto</h2>
    </x-slot>

    <div class="max-w-lg mx-auto mt-6 bg-white p-6 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('adelantos.store') }}">
            @csrf
            <input type="hidden" name="socio_id" value="{{ $socio->id }}">

            {{-- Monto del Adelanto --}}
            <div>
                <x-label for="monto" value="Monto del Adelanto" />
                <x-input id="monto" class="block w-full" type="number" name="monto" required />
            </div>

            {{-- Número de Quincenas --}}
            <div class="mt-4">
                <x-label for="quincenas" value="Número de Quincenas" />
                <x-input id="quincenas" class="block w-full" type="number" name="quincenas" required />
            </div>

            {{-- Fecha de Solicitud --}}
            <div class="mt-4">
                <x-label for="fecha_solicitud" value="Fecha de Solicitud" />
                <x-input id="fecha_solicitud" class="block w-full" type="date" name="fecha_solicitud" required />
            </div>

            {{-- Botón de Enviar --}}
            <div class="mt-4">
                <x-button class="w-full">Solicitar Adelanto</x-button>
            </div>
        </form>
    </div>
</x-app-layout>
