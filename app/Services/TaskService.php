<?php

namespace App\Services;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Contracts\Services\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface)
    {
        $this->taskRepository = $taskRepositoryInterface;
    }

    public function getAllTasks()
    {
        return $this->taskRepository->getAll();
    }

    public function createTask(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function getTaskById(int $id)
    {
        return $this->taskRepository->findById($id);
    }

    public function updateTask(int $id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    public function deleteTask(int $id)
    {
        $this->taskRepository->delete($id);
    }
}
