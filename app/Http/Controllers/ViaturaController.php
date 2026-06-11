<?php

namespace App\Http\Controllers;

use App\Models\Viatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ViaturaController extends Controller
{
    /**
     * Exibir a listagem de viaturas com filtros, ordenação e paginação.
     */
    public function index(Request $request)
    {


        dd('ppppp');
        $query = Viatura::query();

        // Pesquisa por Marca, Modelo ou Matrícula
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('marca', 'like', "%$search%")
                  ->orWhere('modelo', 'like', "%$search%")
                  ->orWhere('matricula', 'like', "%$search%");
            });
        }

        // Ordenação Dinâmica
        $ordenar = $request->get('ordenar', 'id');
        $direcao = $request->get('direcao', 'asc');
        $colunasPermitidas = ['id', 'marca', 'modelo', 'ano', 'preco'];

        if (in_array($ordenar, $colunasPermitidas)) {
            $query->orderBy($ordenar, $direcao);
        }

        // Paginação mantendo os parâmetros da URL
        $viaturas = $query->paginate(10)->appends($request->query());

        return view('viaturas.index', compact('viaturas'));
    }

    /**
     * Mostrar o formulário de criação de uma nova viatura.
     */
    public function create()
    {
        return view('viaturas.create');
    }

    /**
     * Guardar uma nova viatura na base de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'matricula' => 'required|string|max:20|unique:viaturas',
            'ano' => 'required|integer|min:1900|max:' . date('Y'),
            'quilometros' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'estado' => 'required|string|max:255',
        ]);

        $dados = $request->except('foto');

        // Upload da Imagem para a pasta public/fotos
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nomeFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('fotos'), $nomeFoto);
            $dados['foto'] = 'fotos/' . $nomeFoto;
        }

        Viatura::create($dados);

        return redirect()->route('viaturas.index')
            ->with('success', 'Viatura criada com sucesso!');
    }

    /**
     * Exibir os detalhes de uma viatura específica.
     */
    public function show(Viatura $viatura)
    {
        return view('viaturas.show', compact('viatura'));
    }

    /**
     * Mostrar o formulário de edição de uma viatura.
     */
    public function edit(Viatura $viatura)
    {
        return view('viaturas.edit', compact('viatura'));
    }

    /**
     * Atualizar os dados da viatura na base de dados.
     */
    public function update(Request $request, Viatura $viatura)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'matricula' => 'required|string|max:20|unique:viaturas,matricula,' . $viatura->id,
            'ano' => 'required|integer|min:1900|max:' . date('Y'),
            'quilometros' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'estado' => 'required|string|max:255',
        ]);

        $dados = $request->except('foto');

        // Se uma nova foto for enviada, remove a antiga e guarda a nova
        if ($request->hasFile('foto')) {
            if ($viatura->foto && File::exists(public_path($viatura->foto))) {
                File::delete(public_path($viatura->foto));
            }

            $foto = $request->file('foto');
            $nomeFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('fotos'), $nomeFoto);
            $dados['foto'] = 'fotos/' . $nomeFoto;
        }

        $viatura->update($dados);

        return redirect()->route('viaturas.index')
            ->with('success', 'Viatura atualizada com sucesso!');
    }

    /**
     * Remover uma viatura e o seu respetivo ficheiro de imagem.
     */
    public function destroy(Viatura $viatura)
    {
        // Apagar o ficheiro físico da foto na pasta public/fotos se existir
        if ($viatura->foto && File::exists(public_path($viatura->foto))) {
            File::delete(public_path($viatura->foto));
        }

        $viatura->delete();

        return redirect()->route('viaturas.index')
            ->with('success', 'Viatura eliminada com sucesso!');
    }
}
