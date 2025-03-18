<?php

namespace App\Repositories;

use App\Models\CategoriaProduto;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CategoriaProdutoRepositoryInterface;

class CategoriaProdutoRepository extends BaseRepository implements CategoriaProdutoRepositoryInterface
{
    public function __construct(CategoriaProduto $model)
    {
        parent::__construct($model);
    }

    public function findByName(string $name): ?CategoriaProduto
    {
        return $this->model->where("nome_categoria", $name)->first();
    }
}
