<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Abono</h2>
    </x-slot>
    <div class="py-6 max-w-lg mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
        
            <h3 class="text-lg font-bold mb-4">Socio: {{ $socio->nombre }}</h3>

            {{-- Mensajes de éxito o error --}}
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Formulario de Abono --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Préstamo # </strong> {{ $prestamo->id }}</h5>
                    <p><strong>Socio:</strong> {{ $prestamo->socio->nombre }} {{ $prestamo->socio->apellido_paterno }} </p>
                    <p><strong>Monto Original:</strong> ${{ number_format($prestamo->monto, 2) }}</p>
                    <p><strong>Saldo Pendiente:</strong> ${{ number_format($prestamo->saldo_pendiente, 2) }}</p>
                    <p><strong>Estado:</strong> {{ $prestamo->estado }}</p>
                    <br>
                    @if($prestamo->saldo_pendiente <= 0)
                        <div class="alert alert-warning">Este préstamo ya está liquidado.</div>
                    @else
                        <form action="{{ route('abonos.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="prestamo_id" value="{{ $prestamo->id }}">
                            <input type="hidden" name="socio_id" value="{{ $prestamo->socio_id }}">
        
                            <div class="mb-3">
                                <x-label for="fecha" value="Fecha del Abono" />
                                <x-input id="fecha" class="block w-full" type="date" name="fecha" required />
                            </div>
                            
                            <div class="mb-3">
                                <x-label for="monto" value="Monto del Abono"/>
                                <x-input id="monto" class="block w-full" type="number" name="monto" step="0.01" min="1" max="{{ $prestamo->saldo_pendiente }}" required />   
                            </div>
        
                            
                            <div class="mt-6">
                                <a href="{{ route('prestamos.socios') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Regresar</a>
                                <x-button>Registrar Abono</x-button>
                            </div>
                            
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
