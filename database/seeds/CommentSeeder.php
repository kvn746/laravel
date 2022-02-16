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
        for ($i = 0; $i < 50; $i++) {
            $articleId = Article::select('id')->inRandomOrder()->first()->id;
            $userId = User::select('id')->inRandomOrder()->first()->id;
            factory(ArticleComment::class, 2)->create(['article_id' => $articleId, 'user_id' => $userId]);
        }
    }
}
