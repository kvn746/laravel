<?php

namespace App\Services;

use App\Article;
use App\Http\Requests\ArticleFormRequest;

class ArticleService implements ArticleSavable
{

    public function createArticle(ArticleFormRequest $request, TagsSynchronizer $tagsSync)
    {
        $article = Article::create($request->validated());

        $this->updateTags($article, $tagsSync);
    }

    public function updateArticle(Article $article, ArticleFormRequest $request, TagsSynchronizer $tagsSync)
    {
        $article->update($request->validated());

        $this->updateTags($article, $tagsSync);
    }

    private function updateTags (Article $article, TagsSynchronizer $tagsSync)
    {
        if (request('tags')) {
            $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        } else {
            $tags = collect();
        }

        $tagsSync->sync($tags, $article);
    }
}
