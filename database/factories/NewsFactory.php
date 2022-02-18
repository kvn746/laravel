<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use App\Services;
use App\User;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {

    $title = $faker->unique()->sentence(rand(3, 5));

    return [
        'title' => $title,
        'slug' => Services::getSlug($title),
        'owner_id' => factory(User::class),
        'description' => $faker->text(250),
        'text' => $faker->text(1000),
        'is_public' => 1,
    ];
});
