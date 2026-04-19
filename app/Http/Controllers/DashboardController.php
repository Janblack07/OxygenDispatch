<?php

namespace App\Http\Controllers;

use App\Models\TankUnit;
use App\Models\Dispatch;
use App\Models\DispatchLine;
use App\Models\InventoryMovement;
use App\Models\Client;
use App\Models\Batch;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'disponible' => TankUnit::where('status', 1)->count(),
            'despachado' => TankUnit::where('status', 2)->count(),
            'baja' => TankUnit::where('status', 3)->count(),

            'despachos_realizados' => Dispatch::count(),
            'tanques_despachados_total' => DispatchLine::count(),
            'despachos_hoy' => Dispatch::whereDate('dispatched_at', today())->count(),
            'tanques_despachados_hoy' => DispatchLine::whereHas('dispatch', function ($q) {
                $q->whereDate('dispatched_at', today());
            })->count(),

            'clientes_atendidos' => Client::has('dispatches')->count(),
            'movimientos_total' => InventoryMovement::count(),

            'tanques_cuarentena' => TankUnit::whereHas('warehouseArea', function ($q) {
                $q->where('name', 'Cuarentena');
            })->count(),

            'tanques_rechazados' => TankUnit::whereHas('warehouseArea', function ($q) {
                $q->where('name', 'Rechazos, devoluciones y retiro del mercado');
            })->count(),

            'tanques_pendientes_tecnicos' => TankUnit::whereHas('technicalStatus', function ($q) {
                $q->where('name', 'Pendiente');
            })->count(),

            'lotes_registrados' => Batch::count(),
        ];

        return view('dashboard', compact('counts'));
    }
}
