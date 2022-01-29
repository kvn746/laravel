<?php

use App\Services\TagsSynchronizer;
use Illuminate\Database\Seeder;
use App\Article;
use App\Tag;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $tagSync;

    public function __construct()
    {
        $this->tagSync = New TagsSynchronizer;
    }

    public function run()
    {
        factory(Article::class, 30)->create()->each(function (Article $article) {
            $tags = factory(Tag::class, rand(1, 4))->make()->pluck('name');
            $tags = $tags->merge(Tag::inRandomOrder()->limit(rand(2, 4))->get()->pluck('name'));
            $this->tagSync->sync($tags, $article);
        });
    }
}
