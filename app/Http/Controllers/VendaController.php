<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Viatura;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    /**
     * Listar todas as vendas.
     */
    public function index()
    {
        $vendas = Venda::with(['cliente', 'viatura'])->latest()->paginate(10);

        return view('vendas.index', compact('vendas'));
    }

    /**
     * Mostrar os detalhes de uma venda.
     */
    public function show(Venda $venda)
    {
        $venda->load(['cliente', 'viatura']);

        return view('vendas.show', compact('venda'));
    }

    /**
     * Mostrar o formulário para editar uma venda.
     */
    public function edit(Venda $venda)
    {
        $clientes = Cliente::orderBy('nome')->get();

        // Inclui a viatura atual da venda + viaturas disponíveis
        $viaturas = Viatura::where('estado', 'Disponível')
            ->orWhere('id', $venda->viatura_id)
            ->orderBy('marca')
            ->get();

        return view('vendas.edit', compact('venda', 'clientes', 'viaturas'));
    }

    /**
     * Atualizar uma venda existente.
     */
    public function update(Request $request, Venda $venda)
    {
        $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'viatura_id'   => 'required|exists:viaturas,id',
            'data_venda'   => 'required|date',
            'valor_venda'  => 'required|numeric|min:0',
            'observacoes'  => 'nullable|string|max:500',
        ]);

        $novaViaturaId = $request->viatura_id;

        // Se a viatura foi alterada, atualizar os estados
        if ($novaViaturaId != $venda->viatura_id) {
            $novaViatura = Viatura::findOrFail($novaViaturaId);

            if ($novaViatura->estado === 'Vendido') {
                return back()->withErrors([
                    'viatura_id' => 'Esta viatura já foi vendida e não pode ser vendida novamente.'
                ])->withInput();
            }

            // Liberta a viatura antiga
            if ($venda->viatura) {
                $venda->viatura->update(['estado' => 'Disponível']);
            }

            // Marca a nova viatura como vendida
            $novaViatura->update(['estado' => 'Vendido']);
        }

        $venda->update($request->all());

        return redirect()->route('vendas.index')
            ->with('success', 'Venda atualizada com sucesso!');
    }

    /**
     * Mostrar o formulário para registar uma nova venda.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();

        // CORREÇÃO: Filtra pelo termo exato guardado nas suas vistas ("Disponível")
        $viaturas = Viatura::where('estado', 'Disponível')->orderBy('marca')->get();

        return view('vendas.create', compact('clientes', 'viaturas'));
    }

    /**
     * Guardar uma nova venda e alterar o estado do veículo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'viatura_id'   => 'required|exists:viaturas,id',
            'data_venda'   => 'required|date',
            'valor_venda'  => 'required|numeric|min:0',
            'observacoes'  => 'nullable|string|max:500',
        ]);

        $viatura = Viatura::findOrFail($request->viatura_id);

        // CORREÇÃO: Verificação usando a string padrão do sistema ("Vendido")
        if ($viatura->estado === 'Vendido') {
            return back()->withErrors([
                'viatura_id' => 'Esta viatura já foi vendida e não pode ser vendida novamente.'
            ])->withInput();
        }

        // Criar o registo da venda
        Venda::create($request->all());

        // CORREÇÃO: Atualiza para o estado correto ("Vendido")
        $viatura->update(['estado' => 'Vendido']);

        return redirect()->route('vendas.index')
            ->with('success', 'Venda registada com sucesso!');
    }

    /**
     * Eliminar a venda e devolver a viatura ao estado "Disponível".
     */
    public function destroy(Venda $venda)
    {
        // CORREÇÃO: Garante que o carro volta a ficar "Disponível" com a grafia correta
        if ($venda->viatura) {
            $venda->viatura->update(['estado' => 'Disponível']);
        }

        $venda->delete();

        return redirect()->route('vendas.index')
            ->with('success', 'Venda eliminada. Viatura voltou a estar disponível no stand.');
    }
}
