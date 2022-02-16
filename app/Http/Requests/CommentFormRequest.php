<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentFormRequest extends FormRequest
{
    public function prepareData()
    {
        if (auth() && auth()->id()) {
            $this->request->set('user_id', auth()->id());
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->prepareData();

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => 'required|min:5|max:200',
            'user_id' => 'required',
            'article_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'Введите текст комментария',
            'text.min' => 'Текст минимум 5 символов',
            'text.max' => 'Текст максимум 200 символов',
            'article_id.required' => 'Статья не найдена',
            'user_id.required' => 'Вы не авторизованы',
        ];
    }
}
