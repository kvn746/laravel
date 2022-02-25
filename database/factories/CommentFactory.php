<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
use App\Article;
use App\User;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->text(200),
        'user_id' => factory(User::class),
        'commentable_id' => factory(Article::class),
        'commentable_type' => 'App\Article',
    ];
});
