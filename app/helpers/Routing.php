<?php

namespace App\Helpers;

class Routing
{
    /**
     * Redirect to page based on uri provided
     *
     * @param string $uri
     * @return void
     */
    public static function redirect(string $uri)
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $uri);
    }
}