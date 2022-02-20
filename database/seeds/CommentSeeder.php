<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\User;
use App\Article;
use App\News;


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
            $article = Article::select('id')->inRandomOrder()->first();
            $news = News::select('id')->inRandomOrder()->first();
            $userId = User::select('id')->inRandomOrder()->first()->id;
            factory(Comment::class, 2)->create(['commentable_id' => $article, 'commentable_type' => 'App\Article', 'user_id' => $userId]);
            factory(Comment::class, 2)->create(['commentable_id' => $news, 'commentable_type' => 'App\News', 'user_id' => $userId]);
        }
    }
}
