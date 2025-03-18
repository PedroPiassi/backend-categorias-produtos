<?php

namespace App\Repositories\Interfaces;

interface BasicRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function findByName(string $name);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
