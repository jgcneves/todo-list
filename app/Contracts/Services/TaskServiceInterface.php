<?php

namespace App\Contracts\Services;

interface TaskServiceInterface
{
    public function getAllTasks();

    public function createTask(array $data);

    public function getTaskById(int $id);

    public function updateTask(int $id, array $data);

    public function deleteTask(int $id);
}
