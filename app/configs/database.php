<?php

namespace App\Configs;

use PDO;

class Database
{
    private static null | PDO $connection;

    /**
     * Private constructor prevent instantiation of the object or class
     */
    private function __construct()
    {

    }

    /**
     * This will create connection with database
     *
     * @return PDO
     */
    public static function connect() : PDO
    {
        if(!isset(self::$connection))
        {
            $servername = 'db';
            $dbname = 'bhouse';
            $username = 'root';
            $password = 'secret';

            self::$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$connection;
    }

    /**
     * Instead of calling the connect function this is the alternative to get connection
     * But if the connection is not yet set it will call the connect function to create connection with database
     *
     * @return PDO
     */
    public static function getConnection() : PDO
    {
        if(!isset(self::$connection))
        {
            self::connect();
        }

        return self::$connection;
    }

    /**
     * This will nullify the connection and disconnect to the database
     *
     * @return void
     */
    public static function disconnect() : void
    {
        self::$connection = null;
    }
}