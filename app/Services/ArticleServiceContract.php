<?php

namespace App\Services;

use App\Article;
use App\Http\Requests\ArticleFormRequest;

interface ArticleServiceContract
{
    public function createArticle(ArticleFormRequest $request, TagsSynchronizer $tagsSync);

    public function updateArticle(Article $article, ArticleFormRequest $request, TagsSynchronizer $tagsSync);
}
