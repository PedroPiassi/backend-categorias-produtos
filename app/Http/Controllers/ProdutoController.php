<?php

namespace App\Http\Controllers;

use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController
{
    private $ProdutoService;

    public function __construct(ProdutoService $ProdutoService)
    {
        $this->ProdutoService = $ProdutoService;
    }

    public function index()
    {
        $response = $this->ProdutoService->getAll();

        return response()->json($response, $response['status'] ? 200 : 404);
    }

    public function show($id)
    {
        $response = $this->ProdutoService->find($id);

        return response()->json($response, $response['status'] ? 200 : 404);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_produto' => 'required|string|max:150',
            'valor_produto' => 'required|numeric',
            'id_categoria_produto' => 'required',
            'data_cadastro' => 'required|date',
        ]);

        $response = $this->ProdutoService->create($validatedData);

        return response()->json($response, $response['status'] ? 200 : 404);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|string|max:150',
            'valor_produto' => 'required|numeric',
            'id_categoria_produto' => 'required',
            'data_cadastro' => 'required|date',
        ]);

        $response = $this->ProdutoService->update($id, $request->all());

        return response()->json($response, $response['status'] ? 200 : 404);
    }

    public function destroy($id)
    {
        $response = $this->ProdutoService->delete($id);

        return response()->json($response, $response['status'] ? 200 : 404);
    }
}
