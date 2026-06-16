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
        $query = Viatura::query();

        // 1. Pesquisa por Marca, Modelo ou Matrícula
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('marca', 'like', "%$search%")
                  ->orWhere('modelo', 'like', "%$search%")
                  ->orWhere('matricula', 'like', "%$search%");
            });
        }

        // 2. Ordenação Dinâmica
        $ordenar = $request->get('ordenar', 'id');
        $direcao = $request->get('direcao', 'desc'); // Alterado para 'desc' para mostrar os mais recentes primeiro por padrão
        $colunasPermitidas = ['id', 'marca', 'modelo', 'ano', 'preco'];

        if (in_array($ordenar, $colunasPermitidas)) {
            $query->orderBy($ordenar, $direcao);
        }

        // 3. Paginação mantendo os parâmetros da URL (Como o termo de pesquisa)
        $viaturas = $query->paginate(12)->appends($request->query()); // Aumentado para 12 para grelhas de 3 colunas em Tailwind

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'estado' => 'required|string|max:255',
        ]);

        $dados = $request->except('foto');

        // Tratar preço (garante ponto decimal caso venha com vírgula)
        $dados['preco'] = str_replace(',', '.', $request->preco);

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
        // 1. Validar os dados recebidos
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer',
            'quilometros' => 'required|integer',
            'preco' => 'required',
            'estado' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // 2. Tratar o Preço (substituir vírgula por ponto para o MySQL)
        $precoFormatado = str_replace(',', '.', $request->preco);

        // 3. Recolher os dados do formulário
        $dados = $request->only(['marca', 'modelo', 'ano', 'quilometros', 'estado']);
        $dados['preco'] = $precoFormatado;

        // 4. Tratar o Upload da Nova Foto
        if ($request->hasFile('foto')) {
            // Remover a foto antiga se ela existir para não acumular lixo
            if ($viatura->foto && File::exists(public_path($viatura->foto))) {
                File::delete(public_path($viatura->foto));
            }

            // Gravar a nova foto com um nome único
            $ficheiro = $request->file('foto');
            $nomeFoto = time() . '_' . $ficheiro->getClientOriginalName();
            $ficheiro->move(public_path('fotos'), $nomeFoto);

            $dados['foto'] = 'fotos/' . $nomeFoto;
        }

        // 5. Atualizar na Base de Dados
        $viatura->update($dados);

        return redirect()->route('viaturas.index')->with('success', 'Viatura updated com sucesso!');
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
