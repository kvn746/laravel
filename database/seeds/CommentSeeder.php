<?php

use Illuminate\Database\Seeder;
use App\ArticleComment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ArticleComment::class, 100)->create();
    }
}
