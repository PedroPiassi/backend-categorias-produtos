<?php

namespace App\Services;

use App\Repositories\Interfaces\ProdutoRepositoryInterface;

class ProdutoService
{
    private $ProdutoRepository;

    public function __construct(ProdutoRepositoryInterface $ProdutoRepository)
    {
        $this->ProdutoRepository = $ProdutoRepository;
    }

    public function getAll()
    {
        $response = $this->ProdutoRepository->getAll();

        if ($response) {
            return [
                'status' => true,
                'data' => $response,
            ];
        }
        return ['status' => false, 'message' => "Nenhum produto encontrado."];
    }

    public function find($id)
    {
        $response = $this->ProdutoRepository->find($id);

        if ($response) {
            return [
                'status' => true,
                'data' => $response,
            ];
        }
        return ['status' => false, 'message' => "Prodduto não encontrado."];
    }

    public function create($data)
    {
        try {
            $existeProduto = $this->ProdutoRepository->findByName($data["nome_produto"]);

            if ($existeProduto) {
                return ['status' => false, 'message' => 'Produto já cadastrado.'];
            }

            $response = $this->ProdutoRepository->create($data);
            return ['status' => true, 'message' => 'Produto cadastrado com sucesso.', 'data' => $response];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function update($id, $data)
    {
        try {
            $existeProduto = $this->ProdutoRepository->findByName($data["nome_produto"]);

            if ($existeProduto && $existeProduto->id_produto != $id) {
                return ['status' => false, 'message' => 'Nome já cadastrado.'];
            }

            $response = $this->ProdutoRepository->update($id, $data);

            return ['status' => true, 'message' => 'Produto atualizado com sucesso.', 'data' => $response];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            $deleted = $this->ProdutoRepository->delete($id);
            if ($deleted) {
                return [
                    'status' => true,
                    'message' => 'Produto deletado com sucesso.',
                ];
            }

            return [
                'status' => false,
                'message' => 'Erro ao deletar Produto.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
