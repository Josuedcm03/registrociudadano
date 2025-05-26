<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Ciudadanos agrupados por ciudad
            </h2>
            <a href="{{ route('citizens.index') }}" class="text-sm text-blue-600 hover:underline">
                ← Volver al listado
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 md:px-8 py-8">
        @forelse($cities as $city)
            <div x-data="{ open: false }" class="mb-6 rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700 transition duration-300">
                
                <!-- Encabezado -->
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-4 bg-gradient-to-r from-[color:var(--oscuro)] to-[color:var(--principal)] text-white text-lg font-semibold tracking-wide hover:brightness-110 transition duration-300"
                >
                    <span>
                        {{ $city->name }}
                        <span class="text-sm font-normal opacity-80">({{ $city->citizens->count() }} ciudadanos)</span>
                    </span>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Contenido -->
                <div x-show="open" x-collapse class="bg-white dark:bg-gray-800 transition duration-300">
                    @if($city->citizens->isNotEmpty())
                        <table class="w-full text-sm text-left text-gray-800 dark:text-gray-100">
                            <thead class="bg-gray-100 dark:bg-gray-700 uppercase text-xs text-gray-600 dark:text-gray-300">
                                <tr>
                                    <th class="px-6 py-3">#</th>
                                    <th class="px-6 py-3">Nombre del ciudadano</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($city->citizens as $citizen)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-3">{{ $citizen->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-6 text-gray-500 dark:text-gray-400 italic">
                            No hay ciudadanos registrados en esta ciudad.
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-600 mt-8 dark:text-gray-400">
                No se encontraron ciudades registradas.
            </div>
        @endforelse
    </div>
</x-app-layout>
