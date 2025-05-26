
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Listado de Ciudadanos') }}
            </h2>
            <a
                href="{{ route('citizens.create') }}"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600"
            >
                + Nuevo Ciudadano
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto p-6">
<!-- Botones de acciones -->
<div class="flex flex-wrap gap-3 mb-4">
    <!-- Enviar reporte -->
    <button
        id="btnSendReport"
        data-email="{{ auth()->user()->email }}"
        data-url="{{ route('citizens.sendReport') }}"
        class="px-4 py-2 bg-indigo-500 text-white rounded-lg shadow hover:bg-indigo-600 transition"
    >
        Enviar reporte por correo
    </button>

    <!-- Ir a vista agrupada -->
    <a
        href="{{ route('citizens.grouped') }}"
        class="px-4 py-2 bg-indigo-500 text-white rounded-lg shadow hover:bg-indigo-600 transition"
    >
        Ver ciudadanos agrupados
    </a>
</div>



        <!-- Buscador -->
        <form method="GET" action="{{ route('citizens.index') }}" class="mb-4">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Buscar por nombre o ciudad"
                class="w-full sm:w-1/3 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200"
            >
        </form>

        <!-- Mensajes flash -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de ciudadanos -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ciudad</th>
                        <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citizens as $citizen)
                        <tr class="border-t">
                            <td class="px-6 py-4 text-sm">
                                {{ $loop->iteration + ($citizens->currentPage() - 1) * $citizens->perPage() }}
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $citizen->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $citizen->city->name }}</td>
                            <td class="px-6 py-4 text-sm text-right space-x-2" x-data="{ confirmDelete: false }">
                                <a
                                    href="{{ route('citizens.edit', $citizen) }}"
                                    class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                                >
                                    Editar
                                </a>
                                <template x-if="!confirmDelete">
                                    <button
                                        type="button"
                                        @click="confirmDelete = true"
                                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                    >
                                        Eliminar
                                    </button>
                                </template>
                                <template x-if="confirmDelete">
                                    <div class="inline-block bg-red-100 text-red-800 px-3 py-2 rounded shadow">
                                        <span>¿Seguro que deseas eliminar este ciudadano?</span>
                                        <form
                                            action="{{ route('citizens.destroy', $citizen) }}"
                                            method="POST"
                                            class="inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="ml-2 px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                            >
                                                Sí
                                            </button>
                                            <button
                                                type="button"
                                                @click="confirmDelete = false"
                                                class="ml-1 px-2 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400"
                                            >
                                                No
                                            </button>
                                        </form>
                                    </div>
                                </template>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $citizens->appends(['search' => $search])->links() }}
        </div>
    </div>
</x-app-layout>