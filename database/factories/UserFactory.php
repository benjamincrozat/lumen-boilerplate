<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'      => $faker->name,
        'email'     => $faker->unique()->safeEmail,
        'password'  => $password ?: $password = app('hash')->make('secret'),
        'api_token' => str_random(60),
    ];
});
