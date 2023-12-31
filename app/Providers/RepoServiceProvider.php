<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Repository\TeacherRepositoryInterface','App\Repository\TeacherRepository');
        $this->app->bind('App\Repository\StudentRepositoryInterface','App\Repository\StudentRepository');
        $this->app->bind('App\Repository\StudentPromotionRepositoryInterface','App\Repository\StudentPromotionRepository');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
