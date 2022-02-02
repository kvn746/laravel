<?php

if (! function_exists('flash')) {
    function flash($message, $type = "success")
    {
        session()->flash('message', $message);
        session()->flash('message_type', $type);
    }
}

if (! function_exists('push_all')) {

    /**
     * @param null $title
     * @param null $text
     * @return \App\Services\Pushall|mixed|string
     */
    function push_all($title = null, $text = null)
    {
        if (is_null($title) || is_null($text)) {

            return app(\App\Services\Pushall::class);
        }

        return app(\App\Services\Pushall::class)->send($title, $text);
    }
}
