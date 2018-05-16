<?php

use App\Post;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title'   => $faker->sentence,
        'content' => $faker->paragraphs(3, $as_text = true),
    ];
});

$factory->afterMaking(Post::class, function (Post $post) {
    $post->user_id = factory(App\User::class)->create()->id;
});
