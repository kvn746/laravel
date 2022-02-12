<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArticleComment;
use Faker\Generator as Faker;
use App\Article;
use App\User;

$factory->define(ArticleComment::class, function (Faker $faker) {
    return [
        'text' => $faker->text(200),
        'user_id' => User::pluck('id')[rand(0, User::count() - 1)],
        'article_id' => Article::pluck('id')[rand(0, Article::count() - 1)],
    ];
});
