<?php

//use App\Services\TagsSynchronizer;
use Illuminate\Database\Seeder;
use App\News;
use App\User;
//use App\Tag;

class NewsSeeder extends Seeder
{

//    public $tagSync;
//
//    public function __construct(TagsSynchronizer $tagSync)
//    {
//        $this->tagSync = $tagSync;
//    }

    public function run()
    {
        for ($i = 0; $i < 15; $i++) {
            $userId = User::inRandomOrder()->first()->id;
            factory(News::class, 2)->create(['owner_id' => $userId]);
        }
    }
}
