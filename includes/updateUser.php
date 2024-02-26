<?php

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        require_once "connection.php";

        $query = "UPDATE users SET name= :name, email= :email, password = :password WHERE id = :id;";

        $excute = $pdo->prepare($query);

        $cryptOption = [ 'cost' => 12];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $cryptOption);

        $excute->bindParam(":id", $id);
        $excute->bindParam(":name", $name);
        $excute->bindParam(":email", $email);
        $excute->bindParam(":password", $hashedPassword);
        
        $excute->execute();

        $pdo = null;
        $excute = null;

        $_SESSION["message"] = "Successfuly updated";
        $_SESSION["statut"] = "User $name updated successfuly!";
        header("Location: ../pages/home.php");
    
    } catch (PDOException $e) {
        die("Ajout impossible: " . $e->getMessage());
    }
 } else {
    header("Location: ../pages/home.php");
}