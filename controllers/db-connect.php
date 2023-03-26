<?php

$dbName = 'my-pokedex';
$port = 3306;
$username = 'root';
$password = '';

try {
    $this->db = new PDO("mysql:host=localhost;dbname=$dbName;port=$port, $username, $password");
} catch (PDOException $e) {
    echo $e->getMessage();
}
