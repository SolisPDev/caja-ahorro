<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Estado de Préstamos de los Socios</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table class="w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nombre</th>
                        <th class="border px-4 py-2">Num.Cuenta</th>
                        <th class="border px-4 py-2">Estado del Préstamo</th>
                        <th class="border px-4 py-2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($socios as $socio)
                        <tr>
                            <td class="border px-4 py-2">{{ $socio->id }}</td>
                            <td class="border px-4 py-2">{{ $socio->nombre }} {{ $socio->apellido_paterno }}</td>
                            <td class="border px-4 py-2">{{ $socio->apellido_materno }}</td>
                            <td class="border px-4 py-2">{{ $socio->estado_prestamo }}</td>
                            <td class="border px-4 py-2">
                                @if ($socio->estado_prestamo != 'Sin préstamos')
                                    <button onclick="cargarHistorial({{ $socio->id }})" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Historial</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL -->
    <div id="modalHistorial" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl w-full">
            <h2 class="text-xl font-semibold mb-4">Historial de Préstamo</h2>
            <div id="contenidoHistorial">
                <p class="text-center text-gray-600">Cargando...</p>
            </div>
            <div class="flex justify-end mt-4">
                <button onclick="cerrarModal()" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        function cargarHistorial(socioId) {
            fetch(`/socios/${socioId}/historial`)
                .then(response => response.json())
                .then(data => {
                    let contenido = `
                        <p><strong>Préstamo:</strong> ${data.prestamo ? 'Activo' : 'Pagado'}</p>
                        <p><strong>Monto:</strong> $${data.prestamo ? data.prestamo.monto : 0}</p>
                        <p><strong>Pagos:</strong></p>
                        <ul class="list-disc pl-4">
                            ${data.pagos.length > 0 ? data.pagos.map(pago => `<li>$${pago.monto} - ${pago.fecha}</li>`).join('') : '<li>No hay pagos registrados.</li>'}
                        </ul>
                    `;
                    document.getElementById("contenidoHistorial").innerHTML = contenido;
                    document.getElementById("modalHistorial").classList.remove("hidden");
                })
                .catch(error => {
                    document.getElementById("contenidoHistorial").innerHTML = "<p class='text-red-600'>Error al cargar datos.</p>";
                });
        }

        function cerrarModal() {
            document.getElementById("modalHistorial").classList.add("hidden");
        }
    </script>

</x-app-layout>
