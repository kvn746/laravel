<?php

namespace App\Http\Requests;

use App\Services;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ArticleFormRequest extends FormRequest
{
    public function prepareData()
    {
        $slug = Services::getSlug($this->request->get('title'));

        if (empty(Route::input('article'))) {
            $this->request->set('owner_id', auth()->id());
        } else {
            $this->request->set('owner_id', Route::input('article')->owner_id);
        }

        $this->request->add(['slug' => $slug]);
        $this->request->set('is_public', (bool) $this->request->get('is_public'));

    }

    public function authorize()
    {
        $this->prepareData();

        return true;
    }

    public function rules()
    {
        return [
            'owner_id' => 'required',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'text' => 'required',
            'slug' => 'unique:articles,slug',
            'is_public' => '',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Введите название статьи',
            'title.min' => 'Название минимум 5 символов',
            'title.max' => 'Название максимум 100 символов',
            'description.required' => 'Введите описание статьи',
            'description.max' => 'Описание максимум 255 символов',
            'text.required' => 'Введите текст статьи',
            'slug.unique' => 'Название статьи не уникально',
            'owner_id.required' => 'Пользователь не найден',
        ];
    }
}
