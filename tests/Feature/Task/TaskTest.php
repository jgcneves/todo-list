<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can retrieve all tasks', function () {
    Task::factory()->count(3)->create();

    $response = $this->get('/tasks');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can create a task', function () {
    $data = [
        'title' => 'New Task',
        'description' => 'Task description',
        'due_date' => now()->addDays(5)->toDateString(),
        'status' => 'pending',
    ];

    $response = $this->post('/tasks', $data);

    $response->assertStatus(201)
        ->assertJsonFragment(['title' => 'New Task']);

    $this->assertDatabaseHas('tasks', ['title' => 'New Task']);
});

it('can show a task', function () {
    $task = Task::factory()->create();

    $response = $this->get("/tasks/{$task->id}");

    $response->assertStatus(200)
        ->assertJsonFragment(['title' => $task->title]);
});

it('can update a task', function () {
    $task = Task::factory()->create();

    $data = ['title' => 'Updated Task', 'status' => 'in_progress'];

    $response = $this->put("/tasks/{$task->id}", $data);

    $response->assertStatus(200)
        ->assertJsonFragment(['title' => 'Updated Task']);

    $this->assertDatabaseHas('tasks', ['title' => 'Updated Task']);
});

it('can delete a task', function () {
    $task = Task::factory()->create();

    $response = $this->delete("/tasks/{$task->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});
