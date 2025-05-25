<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Mostrar listado de ciudades.
     */
    public function index()
    {
        $cities = City::orderBy('name')->paginate(10);
        return view('cities.index', compact('cities'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Almacenar nueva ciudad.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:100',
        ]);

        City::create($data);

        return redirect()
            ->route('cities.index')
            ->with('success', 'Ciudad creada correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(City $city)
    {
        return view('cities.edit', compact('city'));
    }

    /**
     * Actualizar ciudad.
     */
    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            // otros campos si aplica...
        ]);

        $city->update($data);

        return redirect()
            ->route('cities.index')
            ->with('success', 'Ciudad actualizada correctamente.');
    }

    /**
     * Eliminar ciudad, solo si no tiene ciudadanos asociados.
     */
    public function destroy(City $city)
    {
        if ($city->citizens()->exists()) {
            return back()->with('error', 'No se puede eliminar: la ciudad tiene ciudadanos registrados.');
        }

        $city->delete();

        return back()->with('success', 'Ciudad eliminada correctamente.');
    }
}
