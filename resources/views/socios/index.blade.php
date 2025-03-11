<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Lista de Socios</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6">

        <div class="mb-4 flex justify-between">  

            <a href="{{ route('socios.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Agregar Socio
            </a>

            <div>
                <input type="text" id="search" placeholder="Buscar por Nombre o Apellido" 
                       class="px-4 py-2 border rounded-lg w-80" onkeyup="filterTable()">
            </div>

        </div>

        <table class="w-full bg-white shadow-lg rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Apellidos</th>
                    <th class="px-4 py-2">Numero Cuenta</th>
                    <th class="px-4 py-2">Ahorro Total</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody id="sociosTable">
                @foreach ($socios as $socio)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $socio->nombre }}</td>
                        <td class="px-4 py-2">{{ $socio->apellido_paterno }}</td>
                        <td class="px-4 py-2">{{ $socio->apellido_materno }}</td>
                        <td class="px-4 py-2">$ {{ number_format($socio->saldo_ahorro, 2) }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('socios.show', $socio) }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-green-700">Ver</a>
                            <a href="{{ route('socios.edit', $socio) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Editar</a>
                            <a href="{{ route('aportaciones.socio', $socio->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Aportaciones</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($socios->isEmpty())
            <p class="text-center text-gray-500 mt-4">No hay socios registrados.</p>
        @endif
    </div>

    <script>
        function filterTable() {
            let input = document.getElementById("search").value.toLowerCase();
            let rows = document.querySelectorAll("#sociosTable tr");

            rows.forEach(row => {
                let nombre = row.cells[1].textContent.toLowerCase();
                let apellido = row.cells[2].textContent.toLowerCase();
                if (nombre.includes(input) || apellido.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</x-app-layout>
