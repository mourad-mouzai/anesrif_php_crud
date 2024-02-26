<?php

session_start();

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_r = $_POST["password_r"];

    try {
        require_once "connection.php";

        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password);";

        $excute = $pdo->prepare($query);
        if ($password !== $password_r){
            header("Location: ../pages/home.php");  
            return;                 
        }

        $cryptOption = [ 'cost' => 12];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $cryptOption);

        $excute->bindParam(":name", $name);
        $excute->bindParam(":email", $email);
        $excute->bindParam(":password", $hashedPassword);

        $excute->execute();

        $pdo = null;
        $excute = null;

        $_SESSION["message"] = "Successfuly added";
        $_SESSION["statut"] = "User $name added successfuly!";
        header("Location: ../pages/home.php");
    
    } catch (PDOException $e) {
        die("Ajout impossible: " . $e->getMessage());
    }
 } else {
    header("Location: ../pages/home.php");
}