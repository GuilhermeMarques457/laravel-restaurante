<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    public function index()
    {
        $ingredientes = Ingrediente::all();
        return view('ingredientes.index', compact('ingredientes'));
    }

    public function create()
    {
        return view('ingredientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Ingrediente::create($validated);

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente criado com sucesso!');
    }

    public function show(Ingrediente $ingrediente)
    {
        return view('ingredientes.show', compact('ingrediente'));
    }

    public function edit(Ingrediente $ingrediente)
    {
        return view('ingredientes.edit', compact('ingrediente'));
    }

    public function update(Request $request, Ingrediente $ingrediente)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $ingrediente->update($validated);

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente atualizado com sucesso!');
    }

    public function destroy(Ingrediente $ingrediente)
    {
        $ingrediente->delete();
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente deletado com sucesso!');
    }
}
