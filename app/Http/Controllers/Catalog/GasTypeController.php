<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\GasType;
use Illuminate\Http\Request;

class GasTypeController extends Controller
{
     public function index()
    {
        $items = GasType::orderBy('id','desc')->paginate(15);
        return view('catalog.gas_types.index', compact('items'));
    }

    public function create()
    {
        return view('catalog.gas_types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120','unique:gas_types,name'],
        ]);

        GasType::create($data);
        return redirect()->route('gas-types.index')->with('success','Creado correctamente.');
    }

    public function edit(GasType $gas_type)
    {
        return view('catalog.gas_types.edit', ['item'=>$gas_type]);
    }

    public function update(Request $request, GasType $gas_type)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120','unique:gas_types,name,'.$gas_type->id],
        ]);

        $gas_type->update($data);
        return redirect()->route('gas-types.index')->with('success','Actualizado correctamente.');
    }

    public function destroy(GasType $gas_type)
    {
        $gas_type->delete();
        return redirect()->route('gas-types.index')->with('success','Eliminado correctamente.');
    }
}
