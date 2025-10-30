<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Fornecedor;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with(['fornecedor', 'ingrediente'])->get();
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::all();
        $ingredientes = Ingrediente::all();
        return view('compras.create', compact('fornecedores', 'ingredientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nota_fiscal' => 'nullable|string|max:255',
            'data_compra' => 'required|date',
            'quantidade' => 'required|integer|min:1',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'ingrediente_id' => 'required|exists:ingredientes,id',
        ]);

        Compra::create($validated);

        return redirect()->route('compras.index')->with('success', 'Compra criada com sucesso!');
    }

    public function show(Compra $compra)
    {
        $compra->load(['fornecedor', 'ingrediente']);
        return view('compras.show', compact('compra'));
    }

    public function edit(Compra $compra)
    {
        $fornecedores = Fornecedor::all();
        $ingredientes = Ingrediente::all();
        return view('compras.edit', compact('compra', 'fornecedores', 'ingredientes'));
    }

    public function update(Request $request, Compra $compra)
    {
        $validated = $request->validate([
            'nota_fiscal' => 'nullable|string|max:255',
            'data_compra' => 'required|date',
            'quantidade' => 'required|integer|min:1',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'ingrediente_id' => 'required|exists:ingredientes,id',
        ]);

        $compra->update($validated);

        return redirect()->route('compras.index')->with('success', 'Compra atualizada com sucesso!');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra deletada com sucesso!');
    }
}
