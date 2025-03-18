<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BasicRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BasicRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByName(string $name): ?Model
    {
        return $this->model->where('name', $name)->first();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);

        return $record;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
