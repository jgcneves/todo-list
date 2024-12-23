<?php

namespace App\Providers;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Contracts\Services\TaskServiceInterface;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
