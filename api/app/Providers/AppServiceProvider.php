<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Application/Core
        $this->app->bind(
            \Core\User\Commands\CreateUser\ICreateUser::class,
            \Core\User\Commands\CreateUser\CreateUser::class
        );
        $this->app->bind(
            \Core\User\Commands\DeleteUser\IDeleteUser::class,
            \Core\User\Commands\DeleteUser\DeleteUser::class
        );
        $this->app->bind(
            \Core\User\Queries\GetUserPagination\IGetUserPagination::class,
            \Core\User\Queries\GetUserPagination\GetUserPagination::class
        );

        // Persistence
        $this->app->bind(
            \Core\User\Repositories\IUserRepository::class,
            \Infrastructure\User\UserRepository::class
        );

        // Infrastructure
        // $this->app->bind(
        //     \Core\Interfaces\IImageOptimizeService::class,
        //     \Infrastructure\ImageOptimize\ImageOptimizeService::class
        // );

        // Common
        // $this->app->bind(
        //     \Common\Date\IDateService::class,
        //     \Common\Date\DateService::class
        // );
    }

    public function boot()
    {
    }
}
