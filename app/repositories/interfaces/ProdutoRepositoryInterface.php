<?php

namespace App\Repositories\Interfaces;

use App\Models\Produto;

interface ProdutoRepositoryInterface extends BasicRepositoryInterface
{
    public function __construct(Produto $model);
}
