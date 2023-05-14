<?php

namespace App\Helpers;

session_start();

class Session
{

    private function __construct()
    {

    }

    public static function set(string $key, mixed $value) : void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key) : mixed
    {
        return $_SESSION[$key];
    }

    public static function exists(string $key) : bool
    {
        return isset($_SESSION[$key]);
    }

    public static function unset(string $key) : void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy() : void
    {
        session_unset();
    }
}