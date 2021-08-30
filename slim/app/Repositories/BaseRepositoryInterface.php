<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function get($id): Model;

    public function all(): Collection;

    public function store(array $data): Model;

    public function update($id, array $data): Model;

    public function destroy($id): int;

    public function exist($id): bool;
}