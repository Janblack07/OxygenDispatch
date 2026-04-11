<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $document = trim((string) $request->query('document', ''));
        $name = trim((string) $request->query('name', ''));
        $entityType = trim((string) $request->query('entity_type', ''));

        $clients = Client::query()
            ->when($document !== '', function ($query) use ($document) {
                $query->where('document', 'like', "%{$document}%");
            })
            ->when($name !== '', function ($query) use ($name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->when($entityType !== '', function ($query) use ($entityType) {
                $query->where('entity_type', $entityType);
            })
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        $searchMessage = null;
        $searchStatus = null;

        if ($document !== '' || $name !== '' || $entityType !== '') {
            if ($clients->total() > 0) {
                $searchStatus = 'success';
                $searchMessage = 'Clientes encontrados.';
            } else {
                $searchStatus = 'error';
                $searchMessage = 'No se encontraron clientes con esos filtros.';
            }
        }

        return view('clients.index', compact(
            'clients',
            'document',
            'name',
            'entityType',
            'searchMessage',
            'searchStatus'
        ));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:200'],
            'entity_type' => ['required','integer','in:1,2,3'],
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

    public function findByDocument(Request $request)
    {
        $request->validate([
            'document' => ['required', 'string', 'max:50'],
        ]);

        $document = trim($request->input('document'));

        $client = \App\Models\Client::query()
            ->select(['id', 'name', 'document'])
            ->where('document', $document)
            ->first();

        if (!$client) {
            return response()->json([
                'found' => false,
                'message' => 'Ese cliente no existe, primero regístralo.',
            ], 404);
        }

        return response()->json([
            'found' => true,
            'client' => [
                'id' => $client->id,
                'name' => $client->name,
                'document' => $client->document,
            ],
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => ['required','string','max:200'],
            'entity_type' => ['required','integer','in:1,2,3'],
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
