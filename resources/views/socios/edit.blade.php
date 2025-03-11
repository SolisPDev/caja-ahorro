<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Editar Socio</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold mb-4 text-gray-800">Modificar Información</h3>
            
            <form method="POST" action="{{ route('socios.update', $socio) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-label for="nombre" value="Nombre(s)" />
                    <x-input id="nombre" class="block w-full" type="text" name="nombre" value="{{ old('nombre', $socio->nombre) }}" required />
                </div>
                <div class="mb-4">
                    <x-label for="apellido_paterno" value="Apellidos" />
                    <x-input id="apellido_paterno" class="block w-full" type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $socio->apellido_paterno) }}" required />
                </div>
                <div class="mb-4">
                    <x-label for="apellido_materno" value="Numero Cuenta" />
                    <x-input id="apellido_materno" class="block w-full" type="text" name="apellido_materno" value="{{ old('apellido_materno', $socio->apellido_materno) }}" required />
                </div>

                <div class="mb-4">
                    <x-label for="email" value="Correo Electrónico" />
                    <x-input id="email" class="block w-full" type="email" name="email" value="{{ old('email', $socio->email) }}" required />
                </div>

                <div class="mb-4">
                    <x-label for="telefono" value="Teléfono" />
                    <x-input id="telefono" class="block w-full" type="text" name="telefono" value="{{ old('telefono', $socio->telefono) }}" required />
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('socios.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-gray-700">
                        Regresar
                    </a>
                    <x-button>
                        Actualizar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
