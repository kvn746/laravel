<?php

namespace App\Http\Requests;

use App\Services;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class NewsFormRequest extends FormRequest
{
    public function prepareData()
    {
        $slug = Services::getSlug($this->request->get('title'));

        if (empty(Route::input('news'))) {
            $this->request->set('owner_id', auth()->id());
            $this->request->add(['slug' => $slug]);
        } else {
            $this->request->set('owner_id', Route::input('news')->owner_id);
            if (Route::input('news')->slug !== $slug) {
                $this->request->add(['slug' => $slug]);
            }
        }

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
            'description' => 'required|max:250',
            'text' => 'required',
            'slug' => 'unique:news,slug',
            'is_public' => '',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Введите название новости',
            'title.min' => 'Название минимум 5 символов',
            'title.max' => 'Название максимум 100 символов',
            'description.required' => 'Введите описание новости',
            'description.max' => 'Описание максимум 250 символов',
            'text.required' => 'Введите текст новости',
            'slug.unique' => 'Название новости не уникально',
            'owner_id.required' => 'Пользователь не найден',
        ];
    }
}
