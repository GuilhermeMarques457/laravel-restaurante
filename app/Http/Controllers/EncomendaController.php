<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\Cliente;
use App\Models\Prato;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $encomendas = Encomenda::with('cliente')->get();
        return view('encomendas.index', compact('encomendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $pratos = Prato::all();
        return view('encomendas.create', compact('clientes', 'pratos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
            'pratos' => 'required|array',
            'pratos.*' => 'exists:pratos,id',
            'quantidades' => 'required|array',
            'quantidades.*' => 'integer|min:1',
        ]);

        $encomenda = Encomenda::create([
            'numero' => $validated['numero'],
            'cliente_id' => $validated['cliente_id'],
        ]);

        // Vincula pratos à encomenda com quantidade
        $syncData = [];
        foreach ($validated['pratos'] as $index => $pratoId) {
            $syncData[$pratoId] = ['quantidade' => $validated['quantidades'][$index]];
        }
        $encomenda->pratos()->sync($syncData);

        return redirect()->route('encomendas.index')->with('success', 'Encomenda criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Encomenda $encomenda)
    {
        $encomenda->load('cliente', 'pratos');
        return view('encomendas.show', compact('encomenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Encomenda $encomenda)
    {
        $clientes = Cliente::all();
        $pratos = Prato::all();
        $encomenda->load('pratos');
        return view('encomendas.edit', compact('encomenda', 'clientes', 'pratos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Encomenda $encomenda)
    {
        $validated = $request->validate([
            'numero' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
            'pratos' => 'required|array',
            'pratos.*' => 'exists:pratos,id',
            'quantidades' => 'required|array',
            'quantidades.*' => 'integer|min:1',
        ]);

        $encomenda->update([
            'numero' => $validated['numero'],
            'cliente_id' => $validated['cliente_id'],
        ]);

        // Atualiza os pratos com quantidade
        $syncData = [];
        foreach ($validated['pratos'] as $index => $pratoId) {
            $syncData[$pratoId] = ['quantidade' => $validated['quantidades'][$index]];
        }
        $encomenda->pratos()->sync($syncData);

        return redirect()->route('encomendas.index')->with('success', 'Encomenda atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Encomenda $encomenda)
    {
        $encomenda->pratos()->detach(); // remove relação pivot
        $encomenda->delete();

        return redirect()->route('encomendas.index')->with('success', 'Encomenda deletada com sucesso!');
    }
}
