<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model;
     */
    protected $model;

    public function __construct()
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function get($id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): Model
    {
        return $this->find($id)->update($data);
    }

    public function destroy($id): int
    {
        return $this->model->destroy($id);
    }

    public function exist($id): bool
    {
        return !empty($this->model->find($id));
    }
}