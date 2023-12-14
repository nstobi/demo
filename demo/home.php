<?php
include 'db.php';

// Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);

    $stmt->execute();
}

// Read
$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Example</title>
</head>

<body>
    <h1>CRUD Example</h1>

    <!-- Create -->
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <button type="submit" name="create">Create</button>
    </form>

    <!-- Read -->
    <h2>Users</h2>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li>
                <?= $user["name"]; ?> -
                <?= $user["email"]; ?>
                <a href="?delete=<?= $user["id"]; ?>">Delete</a>
                <a href="?edit=<?= $user["id"]; ?>">Edit</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>