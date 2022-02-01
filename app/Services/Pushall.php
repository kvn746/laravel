<?php

namespace App\Services;

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
            "title" => $title
        ];

        $client = new \GuzzleHttp\Client(['base_uri' => $this->url]);

        return $client->post('', ['form_params' => $data]);
    }
}
