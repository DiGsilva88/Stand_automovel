<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Viatura::query();

        if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('marca', 'like', "%$search%")
              ->orWhere('modelo', 'like', "%$search%")
              ->orWhere('matricula', 'like', "%$search%");
        });
    }
    // Ordenação
    $ordenar = $request->get('ordenar', 'id');
    $direcao = $request->get('direcao', 'asc');
    $colunasPermitidas = ['id', 'marca', 'modelo', 'ano', 'preco'];
    if (in_array($ordenar, $colunasPermitidas)) {
        $query->orderBy($ordenar, $direcao);
    }

    $viaturas = $query->paginate(10)->appends($request->query());
    return view('viaturas.index', compact('viaturas'));
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
