<?php


namespace App\Http;

use App\Services;
use Illuminate\Http\Request;


class FormRequest
{
    public static function articleValidate(Request $request, $slug = true)
    {
        if ($slug) {
            $request->request->add(['slug' => Services::getSlug($request->title)]);
        }

        $request->request->add(['is_public' => (bool) $request->is_public]);

        return $request->validate([
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'text' => 'required',
            'slug' => 'unique:articles,slug',
            'is_public' => '',
        ]);
    }
}
