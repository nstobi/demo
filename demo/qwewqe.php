<?php
include 'db.php';


// create 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);

    $stmt->execute();
}

// read
$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetchAll();

//update

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");

    $stmt->bindParam("id", $id);
    $stmt->bindParam("name", $name);
    $stmt->bindParam("email", $email);

    $stmt->execute();

}

// delete



?>