<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
     public function index()
    {
        $clients = Client::orderBy('id','desc')->paginate(15);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:200'],
            'document' => ['nullable','string','max:50'],
            'phone' => ['nullable','string','max:50'],
            'email' => ['nullable','email','max:120'],
            'address' => ['nullable','string','max:255'],
        ]);

        Client::create($data);
        return redirect()->route('clients.index')->with('success','Cliente creado.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => ['required','string','max:200'],
            'document' => ['nullable','string','max:50'],
            'phone' => ['nullable','string','max:50'],
            'email' => ['nullable','email','max:120'],
            'address' => ['nullable','string','max:255'],
        ]);

        $client->update($data);
        return redirect()->route('clients.index')->with('success','Cliente actualizado.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success','Cliente eliminado.');
    }
}
