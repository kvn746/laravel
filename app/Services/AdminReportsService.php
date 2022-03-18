<?php

namespace App\Services;

use App\ArticleHistory;
use App\Comment;
use App\Http\Requests\StatisticsReportRequest;
use App\Jobs\StatisticsReport;
use App\News;
use App\Article;
use Illuminate\Support\Facades\Auth;

class AdminReportsService
{
    public function getStatisticsReport(StatisticsReportRequest $request)
    {
        $reports = [];
        foreach ($request->validated()['statistic'] as $class) {
            if (class_exists('App\\' . $class)) {
                $reports[] = [
                    'title' => 'Count of ' . $class . ': ',
                    'value' => ('App\\' . $class)::count(),
                ];
            }
        }

        StatisticsReport::dispatch(Auth::user(), $reports);

        return $reports;
    }

    public function getReports()
    {
        $articles = Article::all();
        $news = News::all();
        $biggestArticle = Article::orderBy('text')->limit(1)->first();
        $smallestArticle = Article::orderByDesc('text')->limit(1)->first();
        $maxUserArticles = Article::selectRaw('count(?) as count, owner_id', ['owner_id'])
            ->groupBy('owner_id')
            ->OrderByDesc('count')
            ->first();
        $averageArticlesCount = Article::selectRaw('count(?) as count, owner_id', ['owner_id'])
            ->groupBy('owner_id')
            ->havingRaw('count > ?', [1])
            ->pluck('count')
            ->avg();
        $maxChangedArticle = ArticleHistory::selectRaw('count(?) as count, article_id', ['article_id'])
            ->groupBy('article_id')
            ->orderByDesc('count')
            ->first();
        $maxCommentedArticle = Comment::selectRaw('count(?) as count, commentable_id', ['commentable_id'])
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
                'comment' => isset($maxUserArticles->owner->name) ? $maxUserArticles->owner->name : 'Нет данных',
            ],
            'averageArticlesCount' => [
                'name' => 'Среднее количество статей',
                'value' => number_format($averageArticlesCount, 2),
                'comment' => 'Больше одной статьи у пользователя',
            ],
            'maxChangedArticle' => [
                'name' => 'Самая изменяемая статья',
                'value' => $maxChangedArticle->count ?? 0,
                'comment' => isset($maxChangedArticle->article) ? $maxChangedArticle->article : 'Нет данных',
            ],
            'maxCommentedArticle' => [
                'name' => 'Самая обсуждаемая статья',
                'value' => $maxCommentedArticle->count ?? '0',
                'comment' => isset($maxCommentedArticle->article) ? $maxCommentedArticle->article : 'Нет данных',
            ],
        ];
    }
}
