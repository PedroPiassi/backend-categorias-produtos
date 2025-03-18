<?php

namespace App\Http\Controllers;

use App\Services\CategoriaProdutoService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoriaProdutoController extends Controller
{
    private $categoriaProdutoService;

    public function __construct(CategoriaProdutoService $categoriaProdutoService)
    {
        $this->categoriaProdutoService = $categoriaProdutoService;
    }

    public function index()
    {
        $response = $this->categoriaProdutoService->getAll();

        return response()->json($response, $response['status'] ? 200 : 404);
    }

    public function show($id)
    {
        $response = $this->categoriaProdutoService->find($id);

        return response()->json($response, $response['status'] ? 200 : 404);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_categoria' => 'required|string|max:100',
        ]);

        $response = $this->categoriaProdutoService->create($validatedData);

        return response()->json($response, $response['status'] ? 200 : 404);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nome_categoria' => 'required|string|max:150',
        ]);

        $response = $this->categoriaProdutoService->update($id, $request->all());

        return response()->json($response, $response['status'] ? 200 : 404);
    }

    public function destroy($id)
    {
        $response = $this->categoriaProdutoService->delete($id);

        return response()->json($response, $response['status'] ? 200 : 404);
    }
}
