<?php

namespace App\Http\Controllers;

use App\Enums\TankStatus;
use App\Models\Batch;
use App\Models\Client;
use App\Models\Dispatch;
use App\Models\DispatchLine;
use App\Models\InventoryMovement;
use App\Models\TankUnit;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            /*
             * Disponible real:
             *
             * No basta con status = DISPONIBLE.
             * Para que un tanque cuente como disponible en el Dashboard,
             * también debe estar aprobado técnicamente y ubicado en el área
             * de Productos aprobados.
             */
            'disponible' => TankUnit::query()
                ->dispatchable()
                ->count(),

            'despachado' => TankUnit::query()
                ->where('status', TankStatus::DESPACHADO->value)
                ->count(),

            'baja' => TankUnit::query()
                ->where('status', TankStatus::BAJA->value)
                ->count(),

            'despachos_realizados' => Dispatch::query()
                ->count(),

            'tanques_despachados_total' => DispatchLine::query()
                ->count(),

            'despachos_hoy' => Dispatch::query()
                ->whereDate('dispatched_at', today())
                ->count(),

            'tanques_despachados_hoy' => DispatchLine::query()
                ->whereHas('dispatch', function ($query) {
                    $query->whereDate('dispatched_at', today());
                })
                ->count(),

            'clientes_atendidos' => Client::query()
                ->has('dispatches')
                ->count(),

            'movimientos_total' => InventoryMovement::query()
                ->count(),

            'tanques_cuarentena' => TankUnit::query()
                ->whereHas('warehouseArea', function ($query) {
                    $query->where('name', 'Cuarentena');
                })
                ->count(),

            'tanques_rechazados' => TankUnit::query()
                ->whereHas('warehouseArea', function ($query) {
                    $query->where('name', 'Rechazos, devoluciones y retiro del mercado');
                })
                ->count(),

            'tanques_pendientes_tecnicos' => TankUnit::query()
                ->whereHas('technicalStatus', function ($query) {
                    $query->where('name', 'Pendiente');
                })
                ->count(),

            'lotes_registrados' => Batch::query()
                ->count(),
        ];

        return view('dashboard', compact('counts'));
    }
}
