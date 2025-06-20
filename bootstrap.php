<?php

use Doctrine\DBAL\DriverManager;
use \Dotenv\Dotenv;

require_once __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . '/', '.env.local');
$dotenv->load();

$app_config = require __DIR__ . "/config/app.php";
$database_config = require __DIR__ . "/config/database.php";
$mysql = $database_config['mysql'];


$connectionParams = [
    'dbname' => $mysql['database'],
    'user' => $mysql['user'],
    'password' => $mysql['password'],
    'host' => $mysql['host'],
    'driver' => $database_config['driver'] ?? 'pdo_mysql',
];
$conn = DriverManager::getConnection($connectionParams);

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");

$result = $stmt->bindValue(':id', 1);
$result = $stmt->executeQuery();

var_dump($result->fetchAssociative());
