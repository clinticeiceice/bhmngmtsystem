<?php

namespace App\Databases\Seeders;

use PDO;
use App\Helpers\Hashing;

class UserSeeder
{
    private PDO $connection;
    
    public function __construct(PDO $databaseConnection)
    {
        $this->connection = $databaseConnection;
    }

    public function up() : void
    {
        $sql = "
                INSERT INTO users (name, username, password, is_admin)
                SELECT :name, :username, :password, :isAdmin
                WHERE NOT EXISTS (SELECT username FROM users WHERE username = :username)
                LIMIT 1
                ";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':isAdmin', $isAdmin);

        /**
         * List of users to be added to the table
         * Sequence should be: name, username, password, is_admin
         */ 
        $users = [
            ['Admin', 'admin', '1234', true],
        ];

        foreach($users as $user) {
            $name = $user[0];
            $username = $user[1];
            $password = Hashing::hashString($user[2]);
            $isAdmin = $user[3];
            $stmt->execute();
        }
    }
}