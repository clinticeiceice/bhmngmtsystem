<?php

namespace App\Helpers;

class Hashing
{
    /**
     * Hash the string based on sha256 algorithm and the key
     * You can change the hashing algorithm
     * For more info about hashing algorithm: https://en.wikipedia.org/wiki/List_of_hash_functions#Keyed_cryptographic_hash_functions
     *
     * @param string $text
     * @return string
     */
    public static function hashString(string $text) : string
    {
        return hash_hmac('sha256', $text, 'bhouse');
    }
}