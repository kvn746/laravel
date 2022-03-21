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
        foreach ($this->request->validated()['statistic'] as $class) {
            if (class_exists('App\\' . $class)) {
                $reportsArray[] = [
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
        $articles = \Cache::tags('articles')->remember('admin_articles' . auth()->id(), 3600, function () {
            return Article::all();
        });
        $news = \Cache::tags('news')->remember('admin_news' . auth()->id(), 3600, function () {
            return News::all();
        });
        $biggestArticle = \Cache::tags('articles')->remember('admin_biggest_article' . auth()->id(), 3600, function () {
            return Article::orderBy('text')->limit(1)->first();
        });
        $smallestArticle = \Cache::tags('articles')->remember('admin_smallest_article' . auth()->id(), 3600, function () {
            return Article::orderByDesc('text')->limit(1)->first();
        });
        $maxUserArticles = \Cache::tags('articles')->remember('admin_max_user_article' . auth()->id(), 3600, function () {
            return Article::selectRaw('count(?) as count, owner_id', ['owner_id'])
                ->groupBy('owner_id')
                ->OrderByDesc('count')
                ->first();
        });
        $averageArticlesCount = \Cache::tags('articles')->remember('admin_average_article_count' . auth()->id(), 3600, function () {
            return Article::selectRaw('count(?) as count, owner_id', ['owner_id'])
                ->groupBy('owner_id')
                ->havingRaw('count > ?', [1])
                ->pluck('count')
                ->avg();
        });
        $maxChangedArticle = \Cache::tags('articles')->remember('admin_max_change_article' . auth()->id(), 3600, function () {
            return ArticleHistory::selectRaw('count(?) as count, article_id', ['article_id'])
                ->groupBy('article_id')
                ->orderByDesc('count')
                ->first();
        });
        $maxCommentedArticle = \Cache::tags('comments')->remember('admin_max_commented_article' . auth()->id(), 3600, function () {
            return Comment::selectRaw('count(?) as count, commentable_id', ['commentable_id'])
                ->groupBy('commentable_id')
                ->orderByDesc('count')
                ->first();
        });
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
