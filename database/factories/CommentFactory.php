<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArticleComment;
use Faker\Generator as Faker;
use App\Article;
use App\User;

$factory->define(ArticleComment::class, function (Faker $faker) {
    return [
        'text' => $faker->text(200),
        'user_id' => factory(User::class),
        'article_id' => factory(Article::class),
    ];
});
