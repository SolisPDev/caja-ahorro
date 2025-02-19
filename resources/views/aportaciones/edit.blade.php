<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Editar Aportación</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('aportaciones.update', $aportacion) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-jet-label for="monto" value="Monto de Aportación" />
                    <x-jet-input id="monto" class="block w-full" type="number" name="monto" step="0.01" value="{{ $aportacion->monto }}" required />
                </div>

                <div class="mb-4">
                    <x-jet-label for="fecha" value="Fecha de Aportación" />
                    <x-jet-input id="fecha" class="block w-full" type="date" name="fecha" value="{{ $aportacion->fecha }}" required />
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('aportaciones.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
                        Regresar
                    </a>
                    <x-jet-button>
                        Actualizar
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
