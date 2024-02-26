<?php
$dns="mysql:host=localhost;dbname=tpphp_db";
$db_user="root";
$db_password="";

try {
    $pdo = new PDO($dns, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Pas de connexion: " . $e->getMessage();
}