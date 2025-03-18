<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoriaProdutoRepositoryInterface;

class CategoriaProdutoService
{
    private $categoriaProdutoRepository;

    public function __construct(CategoriaProdutoRepositoryInterface $categoriaProdutoRepository)
    {
        $this->categoriaProdutoRepository = $categoriaProdutoRepository;
    }

    public function getAll()
    {
        $response = $this->categoriaProdutoRepository->getAll();

        if ($response) {
            return [
                'status' => true,
                'data' => $response,
            ];
        }
        return ['status' => false, 'message' => "Nenhuma categoria encontrada."];
    }

    public function find($id)
    {
        $response = $this->categoriaProdutoRepository->find($id);

        if ($response) {
            return [
                'status' => true,
                'data' => $response,
            ];
        }
        return ['status' => false, 'message' => "Categoria não encontrada."];
    }

    public function create($data)
    {
        try {
            $existeCategoria = $this->categoriaProdutoRepository->findByName($data["nome_categoria"]);

            if ($existeCategoria) {
                return ['status' => false, 'message' => 'Categoria já cadastrada.'];
            }

            $response = $this->categoriaProdutoRepository->create($data);
            return ['status' => true, 'message' => 'Categoria cadastrada com sucesso.', 'data' => $response];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function update($id, $data)
    {
        try {
            $existeCategoria = $this->categoriaProdutoRepository->findByName($data["nome_categoria"]);

            if ($existeCategoria) {
                return ['status' => false, 'message' => 'Nome já cadastrado.'];
            }

            $response = $this->categoriaProdutoRepository->update($id, $data);

            return ['status' => true, 'message' => 'Categoria atualizada com sucesso.', 'data' => $response];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            $categoria = $this->categoriaProdutoRepository->find($id);
            if ($categoria->produtos()->count() > 0) {
                return [
                    'status' => false,
                    'message' => 'A categoria não pode ser deletada, pois possui produtos vinculados.',
                ];
            }

            $deleted = $this->categoriaProdutoRepository->delete($id);
            if ($deleted) {
                return [
                    'status' => true,
                    'message' => 'Categoria deletada com sucesso.',
                ];
            }

            return [
                'status' => false,
                'message' => 'Erro ao deletar categoria.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
