<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TankUnit;

class DashboardController extends Controller
{
     public function index()
    {
        $counts = [
            'disponible' => TankUnit::where('status', 1)->count(),
            'despachado' => TankUnit::where('status', 2)->count(),
            'baja' => TankUnit::where('status', 3)->count(),
        ];

        return view('dashboard', compact('counts'));
    }
}
