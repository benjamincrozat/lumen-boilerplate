<?php

use App\Post;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title'   => $faker->sentence,
        'content' => $faker->paragraphs(3, $as_text = true),
    ];
});

$factory->afterMaking(Post::class, function (Post $post) {
    $post->user_id = factory(App\User::class)->create()->id;
});
