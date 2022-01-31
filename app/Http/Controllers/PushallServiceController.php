<?php

namespace App\Http\Controllers;

use App\Services\Pushall;

class PushallServiceController extends Controller
{
    public function form()
    {
        return view('service');
    }

    public function send()
    {
        $data = \request()->validate([
            'title' => 'required|max:80',
            'text' => 'required|max:500',
        ]);

        push_all($data['title'], $data['text']);

        flash('Сообщение успешно отправлено!');

        return back();
    }
}
