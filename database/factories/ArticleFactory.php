<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Services;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {

    $title = $faker->unique()->sentence(rand(3, 5));

    return [
        'title' => $title,
        'slug' => Services::getSlug($title),
        'owner_id' => User::pluck('id')[rand(0, User::count() - 1)],
        'description' => $faker->text(150),
        'text' => $faker->text(2000),
        'is_public' => 1,
    ];
});
