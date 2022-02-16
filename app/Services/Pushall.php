<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Pushall
{
    private $apiKey;
    private $id;

    protected $url = "https://pushall.ru/api.php";

    public function __construct($apiKey, $id)
    {
        $this->apiKey = $apiKey;
        $this->id = $id;
    }

    public function send($title, $text)
    {
        $data = [
            "type" => "self",
            "id" => $this->id,
            "key" => $this->apiKey,
            "text" => $text,
            "title" => $title,
        ];

        return Http::withoutVerifying()->post($this->url, $data);
    }
}
