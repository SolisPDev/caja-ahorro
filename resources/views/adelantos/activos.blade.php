<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Socios con Adelantos Activos</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            
            {{-- Campo de búsqueda --}}
            <div class="mb-4">
                <input type="text" id="buscar" class="w-full p-2 border border-gray-300 rounded-lg"
                    placeholder="Buscar por nombre o apellido..." onkeyup="filtrarSocios()">
            </div>

            {{-- Tabla de socios --}}
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Adelanto</th>
                            <th class="px-4 py-2">Saldo</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socios as $socio)
                            @php
                                $adelantoActivo = $socio->adelantos->where('estado', 'pendiente')->first();
                            @endphp
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $socio->nombre }} {{ $socio->apellido_paterno }}</td>
                                <td class="px-4 py-2 text-red-500">$ {{ number_format($socio->adelantos->sum('monto'), 2) }}</td>
                                <td class="px-4 py-2 text-red-500">$ {{ number_format($socio->adelantos->sum('saldo_pendiente'), 2) }}</td>
                                
                                <td class="px-4 py-2">
                                    @if ($adelantoActivo)
                                        <a href="{{ route('abonos.create', $adelantoActivo->id) }}"
                                        class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Abonar
                                    </a>
                                    <a href="{{ route('socios.estadoCuenta', $socio->id) }}"
                                        class="px-3 py-1 bg-gray-600 text-white rounded-lg  hover:bg-gray-700">
                                        Estado de Cuenta
                                    </a>
                                    @else
                                        <span class="text-gray-500">Sin adelanto activo</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- Script para filtrar socios --}}
    <script>
        function filtrarSocios() {
            let input = document.getElementById("buscar").value.toLowerCase();
            let filas = document.querySelectorAll("tbody tr");
            
            filas.forEach(fila => {
                let nombre = fila.cells[0].textContent.toLowerCase();
                fila.style.display = nombre.includes(input) ? "" : "none";
            });
        }
    </script>

</x-app-layout>
