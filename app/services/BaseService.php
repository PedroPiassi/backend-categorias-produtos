<?php

namespace App\Services;

use App\Repositories\Interfaces\BasicRepositoryInterface;

abstract class BaseService
{
    protected $repository;

    public function __construct(BasicRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        $response = $this->repository->getAll();

        return $response
            ? ['status' => true, 'data' => $response]
            : ['status' => false, 'message' => "Nenhum registro encontrado."];
    }

    public function find($id)
    {
        $response = $this->repository->find($id);

        return $response
            ? ['status' => true, 'data' => $response]
            : ['status' => false, 'message' => "Registro não encontrado."];
    }

    public function create($data, $uniqueField)
    {
        try {
            $exists = $this->repository->findByName($data[$uniqueField]);

            if ($exists) {
                return ['status' => false, 'message' => ucfirst($uniqueField) . ' já cadastrado.'];
            }

            $response = $this->repository->create($data);
            return ['status' => true, 'message' => 'Cadastrado com sucesso.', 'data' => $response];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function update($id, $data, $uniqueField)
    {
        try {
            $exists = $this->repository->findByName($data[$uniqueField]);

            if ($exists && $exists->id != $id) {
                return ['status' => false, 'message' => 'Nome já cadastrado.'];
            }

            $response = $this->repository->update($id, $data);
            return ['status' => true, 'message' => 'Atualizado com sucesso.', 'data' => $response];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            $deleted = $this->repository->delete($id);
            return $deleted
                ? ['status' => true, 'message' => 'Deletado com sucesso.']
                : ['status' => false, 'message' => 'Erro ao deletar.'];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
