<?php

namespace App\Providers;

use App\Repositories\PostsRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\PostsRepositoryContract;
use App\Repositories\PostsCacheRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(PostsRepositoryContract::class, function () {
            return new PostsCacheRepository(new PostsRepository());
        });
    }
}
