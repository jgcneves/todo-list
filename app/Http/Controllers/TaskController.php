<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TaskServiceInterface;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return response()->json($tasks);
    }

    public function store(TaskRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());
        return response()->json($task, Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $task = $this->taskService->getTaskById($id);
        return response()->json($task);
    }

    public function update(TaskRequest $request, int $id)
    {
        $task = $this->taskService->updateTask($id, $request->validated());
        return response()->json($task);
    }

    public function destroy(int $id)
    {
        $this->taskService->deleteTask($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
