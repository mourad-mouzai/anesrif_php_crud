<?php

session_start();

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        require_once "connection.php";

        $query = "SELECT password FROM users WHERE email = :email;";
        $excute = $pdo->prepare($query);
        $excute->bindParam(":email", $email);
        $excute->execute();
        $resultat = $excute->fetch(PDO::FETCH_ASSOC);

        $cryptOption = [ 'cost' => 12];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $cryptOption);

        if (password_verify($password, $resultat['password'])){
            $_SESSION["message"] = "Successfuly logged";
            $_SESSION["statut"] = "You are logged successfuly!";
            header("Location: ../pages/home.php");
        }else{
            header("Location: ../index.php");
        }        

        $pdo = null;
        $excute = null;
        
    
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
 } else {
    header("Location: ../index.php");
}