<?php

namespace App\Providers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (Request $request) {
            if (! $request->input('api_token')) {
                return;
            }

            $user = User::where('api_token', $request->input('api_token'));

            if ($request->is('api/v1/user')) {
                $user = $user->with('posts');
            }

            return $user->first();
        });
    }
}
