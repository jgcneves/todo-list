<?php

namespace App\Contracts\Repositories;

interface TaskRepositoryInterface
{
    public function getAll();

    public function create(array $data);

    public function findById(int $id);

    public function update(int $id, array $data);

    public function delete(int $id);
}
