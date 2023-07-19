<?php

namespace App\Providers;

use App\Contracts\Repositories\ArticleRepositoryContract;
use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\ArticleServiceContract;
use App\Contracts\Services\AuthServiceContract;
use App\Contracts\Services\ProjectServiceContract;
use App\Contracts\Services\UserServiceContract;
use App\Repositories\ArticleRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use App\Services\ArticleService;
use App\Services\AuthService;
use App\Services\ProjectService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(ArticleRepositoryContract::class, ArticleRepository::class);
        $this->app->bind(ProjectRepositoryContract::class, ProjectRepository::class);

        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(ArticleServiceContract::class, ArticleService::class);
        $this->app->bind(ProjectServiceContract::class, ProjectService::class);
        $this->app->bind(AuthServiceContract::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
