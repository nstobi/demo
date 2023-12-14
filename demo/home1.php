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
$users = $stmt->fetchAll();

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);

    $stmt->execute();
}

// Delete
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);

    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
</head>

<body>
    <h1>CRUD System</h1>

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

    <!-- Update -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["edit"])) : ?>
        <?php
        $id = $_GET["edit"];
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <h2>Edit User</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?= $user["id"]; ?>">
            <label for="name">Name:</label>

            <input type="text" name="name" value="<?= $user["name"]; ?>" required>
            <label for="email">Email:</label>

            <input type="email" name="email" value="<?= $user["email"]; ?>" required>
            <button type="submit" name="update">Update</button>
        </form>
    <?php endif; ?>
</body>

</html>