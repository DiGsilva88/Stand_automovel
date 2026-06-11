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
        $clientes=Cliente::latest()->paginate(10);
        return view('clientes.index',compact('clientes'))
            ->with('i',(request()->input('page',1)-1)*10);
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
            'nome'=>'required|string|max:255',
            'email'=>'required|email|unique:clientes',
            'telefone'=>'required|string|max:20',
            'endereco'=>'required|string|max:255',
            'nif'=>'required|string|size:9|unique:clientes',
        ]);

        Cliente::create($request->all());// O método create é usado para criar um novo cliente com os dados validados do formulário. Ele utiliza o recurso de preenchimento em massa (mass assignment) do Laravel, que permite criar um novo registro no banco de dados usando um array associativo dos campos e seus valores correspondentes. O método all() do objeto Request retorna todos os dados do formulário, que são então passados para o método create para serem inseridos na tabela de clientes.

        return redirect()->route('clientes.index')
                        ->with('success','Cliente criado com sucesso.');
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
        $request->validate([
            'nome'=>'required|string|max:255',
            'email'=>'required|email|unique:clientes,email,'.$id,
            'telefone'=>'required|string|max:20',
            'endereco'=>'required|string|max:255',
            'nif'=>'required|string|size:9|unique:clientes,nif,'.$id,
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('cliente.index')
                        ->with('success','Cliente atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);// O método findOrFail é usado para encontrar o cliente pelo ID. Se o cliente não for encontrado, ele lançará uma exceção e retornará uma resposta de erro 404.

        $cliente->delete();

        return redirect()->route('clientes.index')
                        ->with('success','Cliente eliminado com sucesso.');
    }
}


