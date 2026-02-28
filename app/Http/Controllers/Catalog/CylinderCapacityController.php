<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\CylinderCapacity;
use Illuminate\Http\Request;

class CylinderCapacityController extends Controller
{
     public function index()
    {
        $items = CylinderCapacity::orderBy('id','desc')->paginate(15);
        return view('catalog.capacities.index', compact('items'));
    }

    public function create()
    {
        return view('catalog.capacities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120','unique:cylinder_capacities,name'],
            'm3' => ['nullable','numeric'],
        ]);

        CylinderCapacity::create($data);
        return redirect()->route('capacities.index')->with('success','Creado correctamente.');
    }

    public function edit(CylinderCapacity $capacity)
    {
        return view('catalog.capacities.edit', ['item'=>$capacity]);
    }

    public function update(Request $request, CylinderCapacity $capacity)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120','unique:cylinder_capacities,name,'.$capacity->id],
            'm3' => ['nullable','numeric'],
        ]);

        $capacity->update($data);
        return redirect()->route('capacities.index')->with('success','Actualizado correctamente.');
    }

    public function destroy(CylinderCapacity $capacity)
    {
        $capacity->delete();
        return redirect()->route('capacities.index')->with('success','Eliminado correctamente.');
    }
}
