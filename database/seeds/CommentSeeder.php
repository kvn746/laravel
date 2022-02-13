<?php

use Illuminate\Database\Seeder;
use App\ArticleComment;
use App\User;
use App\Article;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articleId = Article::inRandomOrder()->first()->id;
        $userId = User::inRandomOrder()->first()->id;
        factory(ArticleComment::class, 100)->create(['article_id' => $articleId, 'user_id' => $userId]);
    }
}
