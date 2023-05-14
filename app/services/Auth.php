<?php

namespace App\Services;

use PDO;
use App\Helpers\Hashing;
use App\Configs\Database;
use App\Helpers\Session;

class Auth
{
    public static function attempt(string $username, string $password) : bool
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $uname);
        $stmt->bindParam(':password', $pass);

        $uname = $username;
        $pass = Hashing::hashString($password);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        
        if(count($result) > 0) {
            Session::set('user', $result[0]);
            return true;
        } else {
            return false;
        }
    }

    public static function isAuthenticated() : bool
    {
        return Session::exists('user');
    }
}