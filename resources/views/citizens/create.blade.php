{{-- resources/views/citizens/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Ciudadano') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 max-w-lg">
        <form action="{{ route('citizens.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="city_id" class="block text-sm font-medium text-gray-700">Ciudad</label>
                <select
                    name="city_id"
                    id="city_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200"
                >
                    <option value="">— Seleccionar —</option>
                    @foreach($cities as $city)
                        <option
                            value="{{ $city->id }}"
                            {{ old('city_id') == $city->id ? 'selected' : '' }}
                        >
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
                @error('city_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a
                    href="{{ route('citizens.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400"
                >
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
                >
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
