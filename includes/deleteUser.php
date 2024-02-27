<?php
$id = $_GET['id'];

    try {
        require_once "connection.php";

        $query = "DELETE FROM users WHERE id = :id;";
        $excute = $pdo->prepare($query);

        $excute->bindParam(":id", $id);        
        $excute->execute();

        $pdo = null;
        $excute = null;

        $_SESSION["message"] = "Successfuly Deleted";
        $_SESSION["statut"] = "User is deleted successfuly!";
        header("Location: ../pages/home.php");
    
    } catch (PDOException $e) {
        die("Suppression impossible: " . $e->getMessage());
    }