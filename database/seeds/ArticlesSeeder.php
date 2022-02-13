<?php

use App\Services\TagsSynchronizer;
use Illuminate\Database\Seeder;
use App\Article;
use App\User;
use App\Tag;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $tagSync;

    public function __construct(TagsSynchronizer $tagSync)
    {
        $this->tagSync = $tagSync;
    }

    public function run()
    {
        $userId = User::inRandomOrder()->first()->id;
        factory(Article::class, 30)->create(['owner_id' => $userId])->each(function (Article $article) {
            $tags = factory(Tag::class, rand(1, 4))->make()->pluck('name');
            $tags = $tags->merge(Tag::inRandomOrder()->limit(rand(2, 4))->get()->pluck('name'));
            $this->tagSync->sync($tags, $article);
        });
    }
}
