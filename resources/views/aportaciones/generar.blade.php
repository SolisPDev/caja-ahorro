<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Generar Aportaciones</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('aportaciones.procesar') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <x-label for="fecha" value="Fecha de Aportación:"/>
                    <x-input type="date" id="fecha" name="fecha" class="block w-full" required />
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('dashboard') }}" class="px-4 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Regresar</a>
                    <x-button class="w-30">Generar Aportaciones</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
