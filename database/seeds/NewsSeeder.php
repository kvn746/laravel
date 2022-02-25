<?php

use App\Services\TagsSynchronizer;
use Illuminate\Database\Seeder;
use App\News;
use App\User;
use App\Tag;

class NewsSeeder extends Seeder
{

    public $tagSync;

    public function __construct(TagsSynchronizer $tagSync)
    {
        $this->tagSync = $tagSync;
    }

    public function run()
    {
        for ($i = 0; $i < 15; $i++) {
            $userId = User::inRandomOrder()->first()->id;
            factory(News::class, 2)->create(['owner_id' => $userId])->each(function (News $news) {
                $tags = factory(Tag::class, rand(1, 4))->make()->pluck('name');
                $tags = $tags->merge(Tag::inRandomOrder()->limit(rand(2, 4))->get()->pluck('name'));
                $this->tagSync->sync($tags, $news);
            });
        }
    }
}
