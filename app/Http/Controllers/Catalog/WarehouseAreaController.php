<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\WarehouseArea;
use Illuminate\Http\Request;

class WarehouseAreaController extends Controller
{
   public function index()
    {
        $items = WarehouseArea::orderBy('id','desc')->paginate(15);
        return view('catalog.warehouse_areas.index', compact('items'));
    }

    public function create()
    {
        return view('catalog.warehouse_areas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120','unique:warehouse_areas,name'],
        ]);

        WarehouseArea::create($data);
        return redirect()->route('warehouse-areas.index')->with('success','Creado correctamente.');
    }

    public function edit(WarehouseArea $warehouse_area)
    {
        return view('catalog.warehouse_areas.edit', ['item'=>$warehouse_area]);
    }

    public function update(Request $request, WarehouseArea $warehouse_area)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120','unique:warehouse_areas,name,'.$warehouse_area->id],
        ]);

        $warehouse_area->update($data);
        return redirect()->route('warehouse-areas.index')->with('success','Actualizado correctamente.');
    }

    public function destroy(WarehouseArea $warehouse_area)
    {
        $warehouse_area->delete();
        return redirect()->route('warehouse-areas.index')->with('success','Eliminado correctamente.');
    }
}
