
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard de Ciudades y Ciudadanos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Card 1: Total Ciudades -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-lg font-semibold">Total de Ciudades</h3>
                <p class="text-4xl">{{ $totalCities }}</p>
            </div>

            <!-- Card 2: Total Ciudadanos -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-lg font-semibold">Total de Ciudadanos</h3>
                <p class="text-4xl">{{ $totalCitizens }}</p>
            </div>

            <!-- Card 3: Ciudadanos por Ciudad -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-4">Ciudadanos por Ciudad</h3>
                <ul class="list-disc list-inside">
                    @foreach($byCity as $city)
                        <li>{{ $city->name }}: {{ $city->citizens_count }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:underline">
            Recargar datos
        </a>
    </div>
</x-app-layout>
