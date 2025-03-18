<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ProdutoRepositoryInterface;

class ProdutoRepository extends BaseRepository implements ProdutoRepositoryInterface
{
    public function __construct(Produto $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        $produtos = $this->model->all();

        $produtos->transform(function (Produto $produto) {
            return [
                'id_produto' => $produto->id_produto,
                'id_categoria_produto' => $produto->id_categoria_produto,
                'nome_produto' => $produto->nome_produto,
                'data_cadastro' => $produto->data_cadastro,
                'valor_produto' => $produto->valor_produto,
                'categoria' => $produto->categoria,
            ];
        });

        return $produtos;
    }

    public function findByName(string $name): ?Produto
    {
        return $this->model->where("nome_produto", $name)->first();
    }
}
