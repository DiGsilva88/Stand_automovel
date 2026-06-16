<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::latest()->paginate(10);
        return view('clientes.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nome'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:clientes',
        'telefone' => 'nullable|string|max:20',
        'nif'      => 'nullable|string|size:9|unique:clientes',
    ]);

    // Criação do registo com os dados validados
    \App\Models\Cliente::create($request->all());

    // Redireciona com a mensagem que o layout transforma em estilo corporativo uppercase
    return redirect()->route('clientes.index')
        ->with('success', 'Cliente registado com sucesso no ecossistema.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::with('vendas.viatura')->findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        // CORREÇÃO: Validação alinhada com as colunas reais da BD (telefone, morada),
        // evitando duplicados exceto o próprio id
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clientes,email,' . $id,
            'telefone' => 'required|string|max:20',
            'morada' => 'required|string|max:255',
            'nif' => 'required|string|size:9|unique:clientes,nif,' . $id,
        ]);

        $cliente->update($request->only(['nome', 'email', 'telefone', 'morada', 'nif']));

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')
                        ->with('success', 'Cliente eliminado com sucesso.');
    }
}
