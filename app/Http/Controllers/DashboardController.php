<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Citizen;


class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total de ciudades
        $totalCities = City::count();

        // 2. Total de ciudadanos
        $totalCitizens = Citizen::count();

        // 3. Ciudadanos por ciudad
        $byCity = City::withCount('citizens')->get(); 
        // cada modelo City tendrá el atributo citizens_count

        return view('dashboard', compact('totalCities', 'totalCitizens', 'byCity'));
    }
}
