<?php

namespace App\Repositories;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    private Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getAll()
    {
        return $this->task->all();
    }

    public function create(array $data)
    {
        return $this->task->create($data);
    }

    public function findById(int $id)
    {
        return $this->task->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $task = $this->findById($id);
        $task->update($data);
        return $task;
    }

    public function delete(int $id)
    {
        $task = $this->findById($id);
        $task->delete();
    }
}
