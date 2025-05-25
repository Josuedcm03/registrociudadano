<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Listado de Ciudades') }}
            </h2>
            <a
                href="{{ route('cities.create') }}"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600"
            >
                + Nueva Ciudad
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto p-6">
        <!-- Mensajes flash -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabla de ciudades -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nombre</th>
                        <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cities as $city)
                        <tr class="border-t">
                            <td class="px-6 py-4 text-sm">
                                {{ $loop->iteration + ($cities->currentPage() - 1) * $cities->perPage() }}
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $city->name }}</td>
                            <td class="px-6 py-4 text-sm text-right space-x-2">
                                <a
                                    href="{{ route('cities.edit', $city) }}"
                                    class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                                >
                                    Editar
                                </a>
                                <form
                                    action="{{ route('cities.destroy', $city) }}"
                                    method="POST"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        onclick="return confirm('¿Seguro que deseas eliminar esta ciudad?');"
                                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                    >
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $cities->links() }}
        </div>
    </div>
</x-app-layout>
