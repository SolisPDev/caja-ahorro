<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Editar Préstamo</h2>
    </x-slot>

    <div class="max-w-lg mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('prestamos.update', $prestamo->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-label value="Monto del Préstamo" />
                    <x-input class="block w-full" type="number" name="monto" step="0.01" value="{{ $prestamo->monto }}" required />
                </div>

                <div class="mb-4">
                    <x-label value="Tasa de Interés (%)" />
                    <x-input class="block w-full" type="number" name="tasa_interes" step="0.01" value="{{ $prestamo->tasa_interes }}" required />
                </div>

                <div class="mb-4">
                    <x-label value="Número de Quincenas" />
                    <x-input class="block w-full" type="number" name="quincenas" value="{{ $prestamo->quincenas }}" required />
                </div>

                <div class="mb-4">
                    <x-label value="Fecha de Inicio" />
                    <x-input class="block w-full" type="date" name="fecha_inicio" value="{{ $prestamo->fecha_inicio }}" required />
                </div>

                <div class="mb-4">
                    <x-label value="Estado" />
                    <select class="block w-full border-gray-300 rounded-md" name="estado" required>
                        <option value="Activo" {{ $prestamo->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Pagado" {{ $prestamo->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                        <option value="Vencido" {{ $prestamo->estado == 'Vencido' ? 'selected' : '' }}>Vencido</option>
                    </select>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('prestamos.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
                        Regresar
                    </a>
                    <x-button>Actualizar</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
