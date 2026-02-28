<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryMovement;
use App\Models\WarehouseArea;

class InventoryMovementController extends Controller
{
    public function index(Request $request)
    {
        $q = InventoryMovement::with(['tankUnit','fromArea','toArea','batch'])->orderBy('occurred_at','desc');

        if ($request->filled('type')) $q->where('type', (int)$request->input('type'));

        if ($request->filled('area_id')) {
            $areaId = (int)$request->input('area_id');
            $q->where(function($qq) use ($areaId){
                $qq->where('from_area_id',$areaId)->orWhere('to_area_id',$areaId);
            });
        }

        if ($request->filled('serial')) {
            $serial = $request->input('serial');
            $q->whereHas('tankUnit', fn($t)=>$t->where('serial','like',"%$serial%"));
        }

        $movements = $q->paginate(25)->withQueryString();

        return view('inventory.movements', [
            'movements' => $movements,
            'areas' => WarehouseArea::orderBy('name')->get(),
        ]);
    }
}
