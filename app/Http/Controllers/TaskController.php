<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TaskServiceInterface;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class TaskController extends Controller
{
    private TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        return Inertia::render('Task/Index', [
            'tasks' => $this->taskService->getAllTasks(),
        ]);
    }

    public function store(CreateTaskRequest $request)
    {
        try {
            $this->taskService->createTask($request->validated());
            return redirect()->back();
        } catch (Throwable $throwable) {
            // Register the errors in the log
            Log::error('Error: ' . $throwable->getMessage(), [
                'exception' => $throwable,
                'context' => 'An error occurred while creating a new task.',
            ]);

            // Capture and display errors and exceptions in the development environment
            if (app()->environment() === 'local') {
                dd('An error occurred while creating a new task.', $throwable);
            }

            // Return an exception with a standard response.
            throw new Exception('An error occurred while creating a new task.');
        }
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        try {
            $this->taskService->updateTask($id, $request->validated());
            return redirect()->back();
        } catch (Throwable $throwable) {
            // Register the errors in the log
            Log::error('Error: ' . $throwable->getMessage(), [
                'exception' => $throwable,
                'context' => 'An error occurred while creating a new task.',
            ]);

            // Capture and display errors and exceptions in the development environment
            if (app()->environment() === 'local') {
                dd('An error occurred while creating a new task.', $throwable);
            }

            // Return an exception with a standard response.
            throw new Exception('An error occurred while creating a new task.');
        }
    }

    public function destroy(int $id)
    {
        $this->taskService->deleteTask($id);
        return redirect()->back();
    }
}
