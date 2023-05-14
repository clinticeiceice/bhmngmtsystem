<?php

namespace App\Databases;

use PDO;

class Migration
{
    private PDO $connection;
    
    public function __construct(PDO $databaseConnection)
    {
        $this->connection = $databaseConnection;
    }

    /**
     * Create table based on database connection provided
     *
     * @return void
     */
    public function up() : void
    {
        $migrations = [
            "CREATE TABLE IF NOT EXISTS 
                users 
                (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(50) NOT NULL,
                    username VARCHAR(50) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    is_admin BOOLEAN NOT NULL,
                    tenant_id INT(6) UNSIGNED NULL,
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
            ",
            "CREATE TABLE IF NOT EXISTS
                tenants
                (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    address VARCHAR(155) NOT NULL,
                    birth_date DATE NOT NULL,
                    contact_number VARCHAR(15) NOT NULL,
                    guardian_name VARCHAR(50) NOT NULL,
                    guardian_number VARCHAR(15) NOT NULL,
                    guardian_address VARCHAR(150) NOT NULL,
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
            ",
            "CREATE TABLE IF NOT EXISTS
                transactions
                (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    tenant_id INT(6) UNSIGNED NOT NULL,
                    trans_date DATE NOT NULL,
                    amount FLOAT(4) NOT NULL,
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
            ",
        ];
        
        foreach($migrations as $migration) {
            $this->connection->exec($migration);
        }
    }
}