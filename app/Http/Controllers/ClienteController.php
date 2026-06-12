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
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'nif' => 'required|string|size:9|unique:clientes,nif',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
                        ->with('success', 'Cliente criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
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

        // CORREÇÃO: Validação alinhada com as colunas reais da BD (evitando duplicados exceto o próprio id)
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clientes,email,' . $id,
            'telemovel' => 'required|string|max:20',
            'nif' => 'required|string|size:9|unique:clientes,nif,' . $id,
        ]);

        // 1. Recolher os dados base que combinam com as colunas do banco
        $dados = $request->only(['nome', 'email', 'nif']);

        // 2. CORREÇÃO DE MAPEAMENTO: Mapeia o input 'telemovel' do HTML para a coluna 'telefone' do MySQL
        $dados['telefone'] = $request->telemovel;

        // 3. Forçar a preservação do endereço atual (ou pode adicionar o campo no form de edição mais tarde)
        $dados['endereco'] = $cliente->endereco ?? 'N/D';

        // 4. Gravação segura sem quebras de MassAssignment
        $cliente->update($dados);

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
