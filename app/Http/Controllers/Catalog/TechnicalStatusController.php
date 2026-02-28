<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\TechnicalStatus;
use Illuminate\Http\Request;

class TechnicalStatusController extends Controller
{
    public function index()
    {
        $items = TechnicalStatus::orderBy('id','desc')->paginate(15);
        return view('catalog.technical_statuses.index', compact('items'));
    }

    public function create()
    {
        return view('catalog.technical_statuses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120','unique:technical_statuses,name'],
        ]);

        TechnicalStatus::create($data);
        return redirect()->route('technical-statuses.index')->with('success','Creado correctamente.');
    }

    public function edit(TechnicalStatus $technical_status)
    {
        return view('catalog.technical_statuses.edit', ['item'=>$technical_status]);
    }

    public function update(Request $request, TechnicalStatus $technical_status)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120','unique:technical_statuses,name,'.$technical_status->id],
        ]);

        $technical_status->update($data);
        return redirect()->route('technical-statuses.index')->with('success','Actualizado correctamente.');
    }

    public function destroy(TechnicalStatus $technical_status)
    {
        $technical_status->delete();
        return redirect()->route('technical-statuses.index')->with('success','Eliminado correctamente.');
    }
}
