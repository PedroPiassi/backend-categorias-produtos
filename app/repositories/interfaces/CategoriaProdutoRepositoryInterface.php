<?php

namespace App\Repositories\Interfaces;

use App\Models\CategoriaProduto;

interface CategoriaProdutoRepositoryInterface extends BasicRepositoryInterface
{
    public function __construct(CategoriaProduto $model);
}
