<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    public function index()
    {
        $pratos = Prato::with('ingredientes')->get();
        return view('pratos.index', compact('pratos'));
    }

    public function create()
    {
        $ingredientes = Ingrediente::all();
        return view('pratos.create', compact('ingredientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco_unitario' => 'required|numeric|min:0',
            'ingredientes' => 'nullable|array',
            'ingredientes.*' => 'exists:ingredientes,id',
            'quantidades' => 'nullable|array',
            'quantidades.*' => 'integer|min:1',
        ]);

        $prato = Prato::create([
            'nome' => $validated['nome'],
            'preco_unitario' => $validated['preco_unitario'],
        ]);

        // Vincular ingredientes com pivot
        if (!empty($validated['ingredientes'])) {
            $syncData = [];
            foreach ($validated['ingredientes'] as $i => $ingrediente_id) {
                $syncData[$ingrediente_id] = ['quantidade' => $validated['quantidades'][$i] ?? 1];
            }
            $prato->ingredientes()->sync($syncData);
        }

        return redirect()->route('pratos.index')->with('success', 'Prato criado com sucesso!');
    }

    public function show(Prato $prato)
    {
        $prato->load('ingredientes');
        return view('pratos.show', compact('prato'));
    }

    public function edit(Prato $prato)
    {
        $ingredientes = Ingrediente::all();
        $prato->load('ingredientes');
        return view('pratos.edit', compact('prato', 'ingredientes'));
    }

    public function update(Request $request, Prato $prato)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco_unitario' => 'required|numeric|min:0',
            'ingredientes' => 'nullable|array',
            'ingredientes.*' => 'exists:ingredientes,id',
            'quantidades' => 'nullable|array',
            'quantidades.*' => 'integer|min:1',
        ]);

        $prato->update([
            'nome' => $validated['nome'],
            'preco_unitario' => $validated['preco_unitario'],
        ]);

        if (!empty($validated['ingredientes'])) {
            $syncData = [];
            foreach ($validated['ingredientes'] as $i => $ingrediente_id) {
                $syncData[$ingrediente_id] = ['quantidade' => $validated['quantidades'][$i] ?? 1];
            }
            $prato->ingredientes()->sync($syncData);
        } else {
            $prato->ingredientes()->detach();
        }

        return redirect()->route('pratos.index')->with('success', 'Prato atualizado com sucesso!');
    }

    public function destroy(Prato $prato)
    {
        $prato->ingredientes()->detach(); // remove relação
        $prato->delete();

        return redirect()->route('pratos.index')->with('success', 'Prato deletado com sucesso!');
    }
}
