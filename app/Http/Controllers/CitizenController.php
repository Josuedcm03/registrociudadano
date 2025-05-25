<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Citizen;
use Illuminate\Support\Facades\DB;
use App\Mail\CitizensReportMail;
use Illuminate\Support\Facades\Mail;

class CitizenController extends Controller
{
    /**
     * Listado de ciudadanos con búsqueda opcional.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $citizens = Citizen::with('city')
            ->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('city', fn($q) => 
                        $q->where('name', 'like', "%{$search}%")
                    );
            })
            ->orderBy('name')
            ->paginate(10);

        return view('citizens.index', compact('citizens', 'search'));
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('citizens.create', compact('cities'));
    }

    /**
     * Almacenar nuevo ciudadano.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            // otros campos si aplica...
        ]);

        Citizen::create($data);

        return redirect()
            ->route('citizens.index')
            ->with('success', 'Ciudadano creado correctamente.');
    }

    /**
     * Formulario de edición.
     */
    public function edit(Citizen $citizen)
    {
        $cities = City::orderBy('name')->get();
        return view('citizens.edit', compact('citizen', 'cities'));
    }

    /**
     * Actualizar ciudadano.
     */
    public function update(Request $request, Citizen $citizen)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:50',
            'city_id' => 'required|exists:cities,id',
        ]);

        $citizen->update($data);

        return redirect()
            ->route('citizens.index')
            ->with('success', 'Ciudadano actualizado correctamente.');
    }

    /**
     * Eliminar ciudadano.
     */
    public function destroy(Citizen $citizen)
    {
        $citizen->delete();

        return back()->with('success', 'Ciudadano eliminado correctamente.');
    }

    public function sendReport()
{
    $grouped = \App\Models\City::with('citizens')->get()->mapWithKeys(function($city) {
        return [$city->name => $city->citizens];
    });

    // Cambia el correo destinatario por el que desees
    Mail::to(auth()->user()->email)->send(new CitizensReportMail($grouped));

    return redirect()->route('citizens.index')->with('success', 'Reporte enviado por correo.');
}


}
