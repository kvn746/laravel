<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatisticsReportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'statistic' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'statistic.required' => 'Массив отчетов пуст',
        ];
    }
}
