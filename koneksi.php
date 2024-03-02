<?php

$database = 'pdo5';
$username = 'root';
$password = '';
$host = 'localhost';

try {
    $pdo = new PDO(dsn: 'mysql:host='.$host.';dbname='.$database, username: $username, password: $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db_ok = 1;
} catch (\Exception $e) {
    exit($e->getMessage());
}
