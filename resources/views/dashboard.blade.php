<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ __('Panel de Control') }}</h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Saldo total de ahorro de todos los socios -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <h3 class="text-lg font-bold text-gray-700">Saldo Total en Ahorro</h3>
                <p class="text-3xl font-semibold text-green-600 mt-2">$ {{ number_format($saldoTotalAhorro, 2) }}</p>
            </div>

            <!-- Adelantos de quincena activos (agrega la lógica cuando la tengas) -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <h3 class="text-lg font-bold text-gray-700">Adelantos de Quincenas Activos</h3>
                <p class="text-3xl font-semibold text-blue-600 mt-2">{{ number_format($adelantosQuincenasActivos, 0) }}</p> <!-- Sustituye con la cantidad real -->
            </div>

            <!-- Préstamos activos (agrega la lógica cuando la tengas) -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <h3 class="text-lg font-bold text-gray-700">Préstamos Activos</h3>
                <p class="text-3xl font-semibold text-blue-600 mt-2">0</p> <!-- Sustituye con la cantidad real -->
            </div>

            <!-- Total de Socios Activos (agrega la lógica cuando la tengas) -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <h3 class="text-lg font-bold text-gray-700">Socios Activos</h3>
                <p class="text-3xl font-semibold text-blue-600 mt-2">{{ number_format($sociosActivos, 0) }}</p> <!-- Sustituye con la cantidad real -->
            </div>
        </div>
    </div>
</x-app-layout>
