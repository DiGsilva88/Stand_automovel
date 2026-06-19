<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
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

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registado com sucesso no ecossistema.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::with('vendas.viatura')->findOrFail($id);
        
        // Procura se o cliente já criou uma conta de utilizador com este e-mail
        $usuarioVinculado = User::where('email', $cliente->email)->first();

        return view('clientes.show', compact('cliente', 'usuarioVinculado'));
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

    /**
     * Alternar permissões de administrador com base no e-mail do cliente.
     */
    /**
     * Alternar permissões de administrador com base no e-mail do cliente.
     */
       /**
     * Alternar permissões de administrador com base no e-mail do cliente.
     */
    public function toggleAdmin(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        
        // Localiza a conta de login na tabela users usando o e-mail do cliente
        $user = User::where('email', $cliente->email)->first();

        if (!$user) {
            return back()->with('error', 'Este cliente ainda não criou uma conta de utilizador no portal.');
        }
        // CORREÇÃO UNIVERSAL: Utiliza getKey() para extrair o ID numérico/string de forma segura
        if ((string)$user->getKey() === (string)auth()->id()) {
            return back()->with('error', 'Não pode revogar as suas próprias permissões.');
        }

        

        // Alterna entre admin e cliente
        $novoRole = ($user->role === 'admin') ? 'client' : 'admin';
        $user->update(['role' => $novoRole]);

        return back()->with('success', 'Estatuto de acesso atualizado com sucesso no ecossistema.');
    }


}
