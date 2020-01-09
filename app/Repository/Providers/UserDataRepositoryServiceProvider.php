<?php


namespace App\Repository\Providers;


use Illuminate\Support\ServiceProvider;

class UserDataRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Repositories\UserDataRepositoryInterface',
            'App\Repository\Entities\UserDataRepository'
        );
    }
}
