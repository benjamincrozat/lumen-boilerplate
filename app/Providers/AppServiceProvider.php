<?php

namespace App\Providers;

use App\Repositories\PostsRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PostsCacheRepository;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Make polymorphic relations not depend on app's structure.
        // https://laravel.com/docs/eloquent-relationships#polymorphic-relations
        Relation::morphMap([
            \App\Post::class,
        ]);

        $this->app->bind('posts', function () {
            return new PostsCacheRepository(new PostsRepository());
        });
    }
}
