<?php

namespace App\Services;

use App\News;
use App\User;
use App\Article;

class AdminReportsService
{
    public function getReports()
    {
        $articles = Article::all();
        $news = News::all();
        $biggestArticle = Article::orderBy('text')->limit(1)->first();
        $smallestArticle = Article::orderByDesc('text')->limit(1)->first();
        $maxUserArticles = User::join('articles', 'users.id', '=', 'articles.owner_id')
            ->selectRaw('count(?) as count, owner_id, name', ['owner_id'])
            ->groupBy('owner_id')
            ->orderByDesc('count')
            ->first();
        $averageArticlesCount = User::join('articles', 'users.id', '=', 'articles.owner_id')
            ->selectRaw('count(?) as count, owner_id', ['owner_id'])
            ->groupBy('owner_id')
            ->havingRaw('count > ?', [1])
            ->pluck('count')
            ->avg();
        $maxChangedArticle = Article::join('article_histories', 'articles.id', '=', 'article_histories.article_id')
            ->selectRaw('count(?) as count, article_id, title, slug', ['article_id'])
            ->groupBy('article_id')
            ->orderByDesc('count')
            ->first();
        $maxCommentedArticle = Article::join('comments', 'articles.id', '=', 'comments.commentable_id')
            ->selectRaw('count(?) as count, commentable_id, title, slug', ['commentable_id'])
            ->groupBy('commentable_id')
            ->orderByDesc('count')
            ->first();

        return [
            'articlesCount' => [
                'name' => 'Общее количество статей',
                'value' => $articles->count(),
                'comment' => 'Все статьи',
            ],
            'articlesIsPublicCount' => [
                'name' => 'Опубликованных статей',
                'value' => $articles->where('is_public', 1)->count(),
                'comment' => 'Опубликованные статьи',
            ],
            'articlesIsNotPublicCount' => [
                'name' => 'Неопубликованных статей',
                'value' => $articles->where('is_public', 0)->count(),
                'comment' => 'Неопубликованные статьи',
            ],
            'newsCount' => [
                'name' => 'Общее количество новостей',
                'value' => $news->count(),
                'comment' => 'Все новости',
            ],
            'maxArticleLength' => [
                'name' => 'Самая длинная статья',
                'value' => isset($biggestArticle->text) ? strlen($biggestArticle->text) : '0',
                'comment' => isset($biggestArticle->text) ? $biggestArticle : 'Нет данных',
            ],
            'minArticleLength' => [
                'name' => 'Самая короткая статья',
                'value' => isset($smallestArticle->text) ? strlen($smallestArticle->text) : '0',
                'comment' => isset($smallestArticle->text) ? $smallestArticle : 'Нет данных',
            ],
            'maxUserArticles' => [
                'name' => 'Автор большинства статей',
                'value' => $maxUserArticles->count ?? 0,
                'comment' => $maxUserArticles->name,
            ],
            'averageArticlesCount' => [
                'name' => 'Среднее количество статей',
                'value' => number_format($averageArticlesCount, 2),
                'comment' => 'Больше одной статьи у пользователя',
            ],
            'maxChangedArticle' => [
                'name' => 'Самая изменяемая статья',
                'value' => $maxChangedArticle->count ?? 0,
                'comment' => isset($maxChangedArticle->count) ? $maxChangedArticle : 'Нет данных',
            ],
            'maxCommentedArticle' => [
                'name' => 'Самая обсуждаемая статья',
                'value' => $maxCommentedArticle->count ?? '0',
                'comment' => isset($maxCommentedArticle->count) ? $maxCommentedArticle : 'Нет данных',
            ],
        ];
    }
}
