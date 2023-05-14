<?php

/**
 * Call autoload to automatically import the classes in app directory
 * This will lessen the time and avoid keep on using the require or include
 */ 
require_once __DIR__ . '/../vendor/autoload.php';

// Import namespace
use App\Configs\Database;
use App\Databases\Migration;
use App\Databases\Seeders\UserSeeder;
use App\Databases\Database as CreateDatabase;

// Create variable and assign the database connection
$conn = Database::getConnection();

// Create instantiation of Migration class
$migration = new Migration($conn);
// Call up function of Migration class to start creating tables
$migration->up();

// Create instantiation of UserSeeder class
$userSeeder = new UserSeeder($conn);
// Call up function of UserSeeder class to start seeding data
$userSeeder->up();